<?php

namespace App\Http\Controllers;

use App\Constants\BillingRangeConstants;
use App\Handlers\CustomerHandler;
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

        $lastReadingRecord = $readingsQuery->latest()->first();
        
        $previousReadingRecord = $readingsQuery
            ->where('id', '<', $lastReadingRecord->id)
            ->orderBy('id','desc')
            ->first();

        $billedRange = $this->getCustomerHandler()
            ->getBilledRange($lastReadingRecord->reading_date,$previousReadingRecord->reading_date,$lastReadingRecord->reading_value);
        
        $fixedChargeAmount = 0;

        if ($billedRange == BillingRangeConstants::FIRST_RANGE) {
            $fixedChargeAmount = BillingRangeConstants::FIRST_RANGE_FIXED_CHARGE;
        } elseif($billedRange == BillingRangeConstants::SECOND_RANGE) {
            $fixedChargeAmount = BillingRangeConstants::SECOND_RANGE_FIXED_CHARGE;
        } else {
            $fixedChargeAmount = BillingRangeConstants::THIRD_RANGE_FIXED_CHARGE;
        }

            // dd($previousReading,$previousReadingDate);
        return view('customer.bill-details')
        ->with([
            'customerAccountNumber' => $customerAccountNumber,
            'lastReadingRecord'=> $lastReadingRecord,
            'previousReadingRecord' => $previousReadingRecord,
            'fixedChargeAmount' => $fixedChargeAmount
        ]);
    }

    private function getCustomerHandler(): CustomerHandler
    {
        return app(CustomerHandler::class);
    }
}