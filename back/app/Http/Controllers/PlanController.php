<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    protected $filters = [
        'today' => ['today'],
        'equals' => ['date'],
    ];

    protected $resources = [
        'default' => PlanResource::class,
    ];

    public function index(Request $request)
    {
        $query = Plan::orderByRaw(<<<SQL
            is_finished asc,
            if (`time` is null, '23:59:59', `time`) asc,
            if (`penalty` is null, 0, `penalty`) desc
        SQL);
        $this->filter($request, $query);
        return $this->handleIndexRequest($request, $query);
    }

    public function store(PlanRequest $request)
    {
        $plan = auth()->user()->plans()->create($request->all());
        return new PlanResource($plan);
    }

    public function update(Plan $plan, PlanRequest $request)
    {
        $plan->update($request->all());
        return new PlanResource($plan);
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
    }

    public function events()
    {
        return Plan::query()
            ->selectRaw(<<<SQL
                `date`,
                cast(sum(if(is_finished = 0, 1, 0)) as unsigned) as unfinished
            SQL)
            ->groupBy('date')
            ->pluck('unfinished', 'date');
    }

    protected function filterToday(&$query)
    {
        // test
        // return $query->whereRaw(<<<SQL
        //     `date` between '2023-08-16' and '2023-08-31'
        // SQL);

        // last_day(now()) – конец месяца
        // DATE(NOW() + INTERVAL (6 - WEEKDAY(NOW())) DAY) – конец недели
        // бывает такое, что конец недели больше, чем конец месяца
        $query->whereRaw(<<<SQL
            `date` between date(now()) and greatest(
                last_day(now()),
                DATE(NOW() + INTERVAL (6 - WEEKDAY(NOW())) DAY)
            )
        SQL);
    }
}
