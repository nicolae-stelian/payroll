<?php


namespace Payroll;

use DateTime;

class SalariedType implements EmployeeType
{
    protected $hiringDate;
    protected $salary;

    public function __construct($hiringDate)
    {
        $this->hiringDate = DateTime::createFromFormat('Y-m-d', $hiringDate);
    }

    public function setRate($rate)
    {
        $this->salary = $rate;
    }

    public function isPayDate(DateTime $date)
    {
        // if is last month day return true
        if ($this->lastMonthWorkingDay($date) == $date->format("d")) {
            return true;
        }

        return false;
    }

    public function makePayment()
    {
        return new Payment($this->salary);
    }

    /**
     * @param \DateTime $date
     * @return int|string
     */
    protected function lastMonthWorkingDay(DateTime $date)
    {
        $lastDay = $date->format("t");
        $lastMonthlyDay = DateTime::createFromFormat("d-m-Y", $lastDay . $date->format("-m-Y"));

        if ($this->isSaturday($lastMonthlyDay)) {
            $lastDay -= 1;
        }

        if ($this->isSunday($lastMonthlyDay)) {
            $lastDay -= 2;
        }

        return $lastDay;
    }

    protected function isSaturday(DateTime $date)
    {
        $dayOfWeek = $date->format("N");
        if ($dayOfWeek == 6) {
            return true;
        }
        return false;
    }

    protected function isSunday(DateTime $date)
    {
        $dayOfWeek = $date->format("N");
        if ($dayOfWeek == 7) {
            return true;
        }
        return false;
    }
}
