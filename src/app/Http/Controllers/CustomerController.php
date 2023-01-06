<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Reading;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard');
    } 

    public function billDetails(CustomerRequest $request)
    {
        $customerAccountNumber = $request->customer_account_number;

        $readingsQuery = Reading::where('customer_account_number',$customerAccountNumber);
            

        $lastReadingDate = $readingsQuery->latest()->first()->reading_date;

            // dd($lastReadingDate);
        return view('customer.bill-details')
        ->with([
            'customerAccountNumber' => $customerAccountNumber,
            'lastReadingDate'=> $lastReadingDate
        ]);
    }
}