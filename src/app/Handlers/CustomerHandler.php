<?php

namespace App\Handlers;

use App\Constants\BillingRangeConstants;

class CustomerHandler 
{
    public function getBilledRange($lastReadingDate, $previousReadingDate, $unitsCount)
    {
        $dateRange = $this->getDateRange($lastReadingDate, $previousReadingDate);
        
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

    public function getFirstRangeBilledAmount($unitsCount,$dateRange)
    {
        if($unitsCount > $dateRange) {
            $billAmount = $dateRange * BillingRangeConstants::FIRST_RANGE_PER_UNIT_CHARGE;
        } else {
            $billAmount = $unitsCount * BillingRangeConstants::FIRST_RANGE_PER_UNIT_CHARGE;
        }

        return $billAmount;
    }

    public function getSecondRangeBilledAmount($unitsCount,$dateRange)
    {
        if($unitsCount > $dateRange*2) {
            $billAmount = $dateRange * 2 * BillingRangeConstants::SECOND_RANGE_PER_UNIT_CHARGE;
        } else {
            $billAmount = $unitsCount * BillingRangeConstants::SECOND_RANGE_PER_UNIT_CHARGE;
        }

        return $billAmount;
    }

    public function getThirdRangeBilledAmount($unitsCount,$dateRange)
    {
        $firstRangeUnitsCount = $dateRange;
        $secondRangeUnitsCount = $dateRange*2;
        $unitsOfThirdRange = $unitsCount - ($firstRangeUnitsCount + $secondRangeUnitsCount);
        $startAmount = 40;
        $billAmount = 0;
        
        for ($count=0; $count <= $unitsOfThirdRange-1; $count++){
            $billAmount = $startAmount;
            if ($count > 0){
                $billAmount = $billAmount + $startAmount + $count;
            }
            return $billAmount;
        }
        

        return $billAmount;
    }

    public function getDateRange($lastReadingDate, $previousReadingDate)
    {
        $dateRange = date_diff(date_create($previousReadingDate),date_create($lastReadingDate))->days;
        return $dateRange;
    }
}