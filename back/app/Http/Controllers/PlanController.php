<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    protected $resources = [
        'default' => PlanResource::class,
    ];

    public function index(Request $request)
    {
        $query = Plan::orderBy('id', 'desc');
        return $this->handleIndexRequest($request, $query);
    }

    public function store(PlanRequest $request)
    {
        $plan = auth()->user()->plans()->create($request->all());
        return $plan;
    }
}
