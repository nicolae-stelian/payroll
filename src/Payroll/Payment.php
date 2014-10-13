<?php


namespace Payroll;

class Payment
{
    protected $employee;
    protected $money;

    public function __construct($money)
    {
        $this->money = $money;
    }

    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }

    public function getEmployee()
    {
        return $this->employee;
    }

    public function getMoney()
    {
        return $this->money;
    }
}
