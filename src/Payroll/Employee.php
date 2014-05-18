<?php


namespace Payroll;


class Employee
{
    /** @var  EmployeeType\EmployeeType $type */
    protected $type;
    /** @var  Schedule\Schedule $schedule */
    protected $schedule;
    /** @var  PaymentMethod\PaymentMethod $paymentMethod */
    protected $paymentMethod;

    protected $name;
    protected $address;
    protected $id;

    public function __construct($name, $address) {
        $this->name = $name;
        $this->address = $address;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setType(EmployeeType\EmployeeType $type)
    {
        $this->type = $type;
    }

    public function setSchedule(Schedule\Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function setPaymentMethod(PaymentMethod\PaymentMethod $method)
    {
        $this->paymentMethod = $method;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSalary()
    {
        return $this->type->getSalary($this);
    }

    public function GetType()
    {
        return $this->type;
    }

    public function GetSchedule()
    {
        return $this->schedule;
    }

    public function GetMethod()
    {
        return $this->paymentMethod;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function toArray()
    {
        $array[] = $this->name;
        $array[] = $this->address;
        $array[] = get_class($this->paymentMethod);
        $array[] = get_class($this->schedule);
        $array[] = get_class($this->type);

        return $array;
    }
}