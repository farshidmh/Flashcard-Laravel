<?php

namespace App\Actions;

/**
 * This class is responsible for calculating percentage.
 *
 * @author Farshid Mehrtash
 * @version 2.0.0
 */
class CalculatePercentageAction
{

    /**
     * This method is responsible for calculating percentage.
     *
     * @param $NumA
     * @param $NumB
     * @return float
     *
     * @author Farshid Mehrtash
     * @version 2.0.0
     */
    public function execute($NumA, $NumB): float
    {
        if ($NumA > 0) {
            $completionPercentage = round($NumB / $NumA * 100, 2);
        } else {
            $completionPercentage = 0;
        }

        return $completionPercentage;
    }
}
