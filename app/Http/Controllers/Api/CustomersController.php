<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customers\DestroyRequest;
use App\Http\Requests\Api\Customers\IndexRequest;
use App\Http\Requests\Api\Customers\ShowRequest;
use App\Http\Requests\Api\Customers\StoreRequest;
use App\Http\Requests\Api\Customers\UpdateRequest;
use App\Mail\Customers\Created;
use App\Models\Customer;
use Cassandra\Index;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $customer = Customer::query()->create([
           "name" => $request->input("name"),
           "tax" => $request->input("tax"),
           "email" => $request->input("email"),
        ]);
        Mail::to($request->user())->send(new Created($customer));
        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowRequest $request, Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Customer $customer)
    {
        $customer->update([
            "name" => $request->input("name"),
            "tax" => $request->input("tax"),
            "email" => $request->input("email"),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request, Customer $customer)
    {
        $customer->delete();
        return response()->json();
    }
}
