<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products =  Product::all();

        return response()->json([
            'success' => true,
            'message' => 'A list of all products',
            'data' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function store(Request $request, Supplier $supplier): JsonResponse
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required'
        ]);

        // Return validation message
        if($validator->fails())
        {
            return response()->json([
                'success' => false,
                'message' => 'Fill in the name',
                'data'    => $validator->errors()
            ],400);
        }

        $product =  Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity')
        ]);

        $supplier->products()->sync($product);

        $product = $product->refresh();

        $order = Order::create([
            'order_number' => Str::random()
        ]);

        $product->orders()->sync($order);

        // Check creation
        if ($order->refresh())
        {
            return response()->json([
                'success' => true,
                'message' => ' Product saved successfully',
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => ' Product not saved. Try again',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Product found',
            'data' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function edit(Product $product): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required'
        ]);

        // Return validation message
        if($validator->fails())
        {
            return response()->json([
                'success' => false,
                'message' => 'Fill in the name',
                'data'    => $validator->errors()
            ],400);
        }

        $product =  $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity')
        ]);

        // Check creation of product
        if ($product)
        {
            return response()->json([
                'success' => true,
                'message' => ' Product saved successfully',
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => ' Product not saved. Try again',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        try
        {
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product successfully deleted',
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting product',
            ], 400);
        }
    }
}
