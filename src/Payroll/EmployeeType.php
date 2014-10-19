<?php


namespace Payroll;


interface EmployeeType
{
    public function setRate($rate);

    public function isPayDate(\DateTime $date);

    public function makePayment();
}
