<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $suppliers = Supplier::all();

        return response()->json([
            'success' => true,
            'message' => 'A list of all suppliers',
            'data' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        // return the create-a-supplier page
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ],
            [
                'name.required' => 'Enter name of the supplier',
            ]
        );

        // Return validation message
        if($validator->fails())
        {
            return response()->json([
                'success' => false,
                'message' => 'Fill in the name',
                'data'    => $validator->errors()
            ],400);
        }

        $supplier = Supplier::create([
            'name' => $request->input('name')
        ]);

        // Check creation of supplier
        if ($supplier)
        {
            return response()->json([
                'success' => true,
                'message' => 'Supplier saved successfully',
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Supplier not saved. Try again',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function show(Supplier $supplier): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Supplier found',
            'data' => $supplier
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function edit(Supplier $supplier): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function update(Request $request, Supplier $supplier): JsonResponse
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ],
            [
                'name.required' => 'Enter name of the supplier',
            ]
        );

        // Return validation message
        if($validator->fails())
        {
            return response()->json([
                'success' => false,
                'message' => 'Fill in the name',
                'data'    => $validator->errors()
            ],400);
        }

        $supplier = $supplier->update([
            'name' => $request->input('name')
        ]);

        // Check if update worked
        if ($supplier)
        {
            return response()->json([
                'success' => true,
                'message' => 'Supplier details updated successfully',
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Supplier details not updated. Try again',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        try
        {
            $supplier->delete();

            return response()->json([
                'success' => true,
                'message' => 'Supplier successfully deleted',
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting supplier',
            ], 400);
        }

    }
}
