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
        $query = Plan::orderBy('id', 'desc');
        $this->filter($request, $query);
        return $this->handleIndexRequest($request, $query);
    }

    public function store(PlanRequest $request)
    {
        $plan = auth()->user()->plans()->create($request->all());
        return new PlanResource($plan);
    }

    protected function filterToday(&$query)
    {
        $query->whereRaw(<<<SQL
            `date` between date(now()) and last_day(now())
        SQL);
    }
}
