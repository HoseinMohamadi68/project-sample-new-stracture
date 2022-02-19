<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * The Eloquent builder.
     *
     * @var Builder
     */
    protected Builder $builder;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [];

    /**
     * @var array
     */
    protected array $attributes = [];

    /**
     * Create a new ThreadFilters instance.
     *
     * @param Request $request BaseRequest.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters.
     *
     * @param  Builder $builder Builder.
     *
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $type = $this->attributes[$filter];
                settype($value, $type);
                $this->$filter($value);
            }
        }

        if ($this->request->filled('orderBy')) {
            $this->orderBy($this->request->orderBy);
        }

        return $this->builder;
    }

    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    public function getFilters()
    {
        return array_filter($this->request->only($this->filters), function ($item) {
            return !is_null($item);
        });
    }

    /**
     * Order the query by givens orders
     *
     * @param array|string $orders Orders.
     *
     * @return Builder
     */
    protected function orderBy($orders)
    {
        if (! is_array($orders)) {
            $orders = json_decode($orders, true);
        }
        return $this->builder->when(! empty($orders), function ($query) use ($orders) {
            foreach ($orders as $key => $order) {
                $query->orderBy($key, $order);
            }
        });
    }
}
