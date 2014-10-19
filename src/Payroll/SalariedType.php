<?php


namespace Payroll;


class SalariedType implements EmployeeType
{
    protected $hiringDate;
    protected $rate;

    public function __construct($hiringDate)
    {
        $this->hiringDate = \DateTime::createFromFormat('Y-m-d', $hiringDate);
    }

    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    public function isPayDate(\DateTime $date)
    {
        // if is last month day return true
        return true;
    }

    public function makePayment()
    {
        return new Payment($this->rate);
    }
}
