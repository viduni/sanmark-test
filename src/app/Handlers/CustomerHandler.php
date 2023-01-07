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
        $billAmount = $unitsCount * BillingRangeConstants::FIRST_RANGE_PER_UNIT_CHARGE;

        if($unitsCount > $dateRange) {
            $billAmount = $dateRange * BillingRangeConstants::FIRST_RANGE_PER_UNIT_CHARGE;
        }
        
        return $billAmount;
    }

    public function getSecondRangeBilledAmount($unitsCount,$dateRange)
    {
        $billAmount = ($unitsCount - $dateRange) * BillingRangeConstants::SECOND_RANGE_PER_UNIT_CHARGE;

        if($unitsCount > $dateRange * 2) {
            $billAmount = $dateRange * 2 * BillingRangeConstants::SECOND_RANGE_PER_UNIT_CHARGE;
        }

        return $billAmount;
    }

    public function getThirdRangeBilledAmount($unitsCount,$dateRange)
    {
        $firstRangeUnitsCount = $dateRange;
        $secondRangeUnitsCount = $dateRange*2;
        $unitsOfThirdRange = $unitsCount - ($firstRangeUnitsCount + $secondRangeUnitsCount);
        $startAmount = BillingRangeConstants::THIRD_RANGE_PER_UNIT_CHARGE;

        $billAmount = ($unitsOfThirdRange/2) * ($startAmount * 2 + ($unitsOfThirdRange-1));
        
        // for ($count=0; $count <= $unitsOfThirdRange-1; $count++){
        //     $billAmount = $startAmount;
        //     if ($count > 0){
        //         $billAmount = $billAmount + $startAmount + $count;
        //     }
        // }
        
        return $billAmount;
    }

    public function getDateRange($lastReadingDate, $previousReadingDate)
    {
        $dateRange = date_diff(date_create($previousReadingDate),date_create($lastReadingDate))->days;
        return $dateRange;
    }
}