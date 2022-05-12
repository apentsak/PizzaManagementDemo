<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\ModelFilters\Base\Filterer;
use App\Models\Order;
use App\ValidationRules\FilterStringRule;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    public function list(Request $request, Filterer $filterer): AnonymousResourceCollection
    {
        $request->validate([
            'filter' => new FilterStringRule(),
        ]);

        $query = Order::query();

        if ($filterSetup = $request->get('filter')) {
            $filterer->apply($query, [
                'status'     => 'list',
                'street'     => 'list',
                'city'       => 'list',
                'date'       => 'dateRange',
                'totalPrice' => 'range',
            ], $filterSetup);
        }

        $orders = $query
            ->orderByDesc('date')
            ->get();

        return OrderResource::collection($orders);
    }
}
