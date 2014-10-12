<?php


namespace Payroll\Transactions;


use Payroll\Employee;

class AddHourlyEmployee
{
    protected $id;
    protected $name;
    protected $address;
    protected $salary;

    public function __construct($name, $address, $salary)
    {
        $this->name = $name;
        $this->address = $address;
        $this->salary = $salary;
    }

    public function execute()
    {
        $employee = new Employee($this->name, $this->address);

        return $employee;
    }
}
