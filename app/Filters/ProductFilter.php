<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ProductFilter extends ApiFilter
{
    protected $safeParams = [
        'id' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'name' => ['eq', 'like'],
        'description' => ['eq', 'like'],
        'price' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'stock' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];
    protected $columnMap = [];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
        'like' => 'LIKE',
    ];
}
