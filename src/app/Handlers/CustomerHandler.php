<?php

namespace App\Handlers;

use App\Constants\BillingRangeConstants;

class CustomerHandler 
{
    public function getBilledRange($lastReadingDate, $previousReadingDate, $unitsCount)
    {
        $dateRange = date_diff(date_create($previousReadingDate),date_create($lastReadingDate))->days;
        
        if($unitsCount <= $dateRange) {
            return BillingRangeConstants::FIRST_RANGE;
        }

        if($unitsCount <= $dateRange*2) {
            return BillingRangeConstants::SECOND_RANGE;
        }

        if($unitsCount > $dateRange*2) {
            return BillingRangeConstants::THIRD_RANGE;
        }

    }
}