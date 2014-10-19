<?php


namespace Payroll;


class Employee
{
    /** @var  SalariedType */
    protected $type;

    protected $name;
    protected $address;
    protected $rate;

    public function __construct($name, $address, $rate)
    {
        $this->name = $name;
        $this->address = $address;
        $this->rate = $rate;
    }

    public function setType(EmployeeType $type)
    {
        $this->type = $type;
        $type->setRate($this->rate);
    }

    public function isPayDate($date)
    {
        return $this->type->isPayDate($date);
    }

    public function makePayment()
    {
        $payment = $this->type->makePayment();
        $payment->setEmployee($this);

        return $payment;
    }
}
