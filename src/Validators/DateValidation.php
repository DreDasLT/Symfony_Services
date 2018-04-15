<?php
/**
 * Created by PhpStorm.
 * User: t0000654
 * Date: 4/15/18
 * Time: 10:09 PM
 */

namespace App\Validators;


/**
 * Class DateValidation
 * @package App\Validators
 */
class DateValidation
{
    private $error_message = array(
        "old_date" => "Įveskite datą, kuri nebūtų senesnė už šiandienos.",
        "too_far" => "Įveskite datą, kuri neviršytų 2 mėnesių laikotarpio",
        "bad_format" => "Įveskite teisingą datos formatą [Metai-Mėnuo-diena]"
    );

    /**
     * @param string $input
     * @return null|string
     */
    public function ValidateDate(string $input): ?string {
        try {
            $date = new \DateTime($input);
            if($this->CompareDates($date, new \DateTime()) === -1) return $this->error_message["old_date"];
            if($this->CompareDates($date, new \DateTime('now +2 months')) === 1) return $this->error_message['too_far'];
            return null;
        } catch (\Exception $exception) {
            return $this->error_message['bad_format'];
        }

    }

    /**
     * @param \DateTime $date
     * @param \DateTime $date1
     * @return int
     */
    private function CompareDates(\DateTime $date, \DateTime $date1) {
        return $date->format('Y-m-d') <=> $date1->format('Y-m-d');
    }
}