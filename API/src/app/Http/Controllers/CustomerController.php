<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
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

        $validation = $this->makeValidation($data);

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

    /**
     * Makes a customer validator.
     * 
     * @param array $customerArray 
     * @return ValidationValidator 
     */
    private function makeValidation(array $customerArray)
    {
        return Validator::make($customerArray,  [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'phone' => 'required',
            'address.number' => 'required|integer|min:1',
            'address.street' => 'required|min:1',
            'address.city' => 'required|min:2',
            'address.state' => 'required|min:2',
            'address.country' => 'required|min:2',
        ]);
    }
}
