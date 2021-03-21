<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $orders =  Order::all();

        return response()->json([
            'success' => true,
            'message' => 'A list of all orders',
            'data' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function show(Order $order): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Order found',
            'data' => $order
        ]);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Order $order
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy(Order $order): JsonResponse
    {
        try
        {
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order successfully deleted',
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting order',
            ], 400);
        }
    }
}
