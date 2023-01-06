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

        $billedDateDifference = $this->getCustomerHandler()
            ->getDateRange($lastReadingRecord->reading_date,$previousReadingRecord->reading_date);
        
        $fixedChargeAmount = 0;
        $firstRangeBilledAmmount = 0;
        $secondRangeBilledAmount = 0;
        $thirdRangeBilledAmount = 0;

        if ($billedRange == BillingRangeConstants::FIRST_RANGE) {
            $fixedChargeAmount = BillingRangeConstants::FIRST_RANGE_FIXED_CHARGE;
            $firstRangeBilledAmmount = $this->getCustomerHandler()->getFirstRangeBilledAmount($lastReadingRecord->reading_value,$billedDateDifference);

        } elseif($billedRange == BillingRangeConstants::SECOND_RANGE) {
            $fixedChargeAmount = BillingRangeConstants::SECOND_RANGE_FIXED_CHARGE;
            $firstRangeBilledAmmount = $this->getCustomerHandler()->getFirstRangeBilledAmount($lastReadingRecord->reading_value,$billedDateDifference);
            $secondRangeBilledAmount = $this->getCustomerHandler()->getSecondRangeBilledAmount($lastReadingRecord->reading_value,$billedDateDifference);

        } else {
            $fixedChargeAmount = BillingRangeConstants::THIRD_RANGE_FIXED_CHARGE;
            $firstRangeBilledAmmount = $this->getCustomerHandler()->getFirstRangeBilledAmount($lastReadingRecord->reading_value,$billedDateDifference);
            $secondRangeBilledAmount = $this->getCustomerHandler()->getSecondRangeBilledAmount($lastReadingRecord->reading_value,$billedDateDifference);
            $thirdRangeBilledAmount = $this->getCustomerHandler()->getThirdRangeBilledAmount($lastReadingRecord->reading_value,$billedDateDifference);
        }

        $totalBillAmount = $fixedChargeAmount + $firstRangeBilledAmmount + $secondRangeBilledAmount + $thirdRangeBilledAmount;

            // dd($previousReading,$previousReadingDate);
        return view('customer.bill-details')
            ->with([
                'customerAccountNumber' => $customerAccountNumber,
                'lastReadingRecord'=> $lastReadingRecord,
                'previousReadingRecord' => $previousReadingRecord,
                'fixedChargeAmount' => $fixedChargeAmount,
                'firstRangeBilledAmmount' => $firstRangeBilledAmmount,
                'secondRangeBilledAmount' => $secondRangeBilledAmount,
                'thirdRangeBilledAmount' => $thirdRangeBilledAmount,
                'totalBillAmount' => $totalBillAmount
            ]);
    }

    private function getCustomerHandler(): CustomerHandler
    {
        return app(CustomerHandler::class);
    }
}