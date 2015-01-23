<?php
// Copyright (c) 2014 Promotouch S.L. All rights reserved. See LICENSE.TXT for details.


namespace Payroll;

use Datetime;

class HourlyType implements EmployeeType
{
    protected $hiringDate;
    protected $rate;

    public function __construct($hiringDate, $timeCards)
    {
        $this->hiringDate = DateTime::createFromFormat('Y-m-d', $hiringDate);
    }

    public function setRate($rate)
    {
        // TODO: Implement setRate() method.
    }

    public function isPayDate(\DateTime $date)
    {
        // TODO: Implement isPayDate() method.
    }

    public function makePayment()
    {
        // TODO: Implement makePayment() method.
    }
}