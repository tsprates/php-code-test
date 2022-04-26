<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *P
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($data, (new StoreCustomerRequest())->rules());

        if (!$validation->fails()) {
            Storage::disk('public')->append('customers.txt', json_encode($data));

            return response()->json([
                'success' => true,
                'customer' => $data,
            ], 201);
        }

        return response()->json([
            'success' => false,
            'errors' => $validation->errors(),
        ], 422);
    }
}
