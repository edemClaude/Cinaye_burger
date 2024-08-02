<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers, 200);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);
        $customer = Customer::create($validated);
        return response()->json($customer, 201);
    }


    public function customerOrders($id)
    {
        $customer = Customer::where('id', $id)
            ->with('orders')->first();
        return response()->json($customer, 200);
    }


}
