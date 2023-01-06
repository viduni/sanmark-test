<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard');
    } 

    public function billDetails(CustomerRequest $request)
    {
        $customerAccountNumber = $request->customer_account_number;
        
        return view('customer.bill-details')
        ->with([
            'customerAccountNumber' => $customerAccountNumber
        ]);
    }
}