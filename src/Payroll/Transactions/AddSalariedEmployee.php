<?php


namespace Payroll\Transactions;


use Payroll\Employee;

class AddSalariedEmployee
{
    protected $id;
    protected $name;
    protected $address;
    protected $salary;

    public function __construct($id, $name, $address, $salary)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->salary = $salary;
    }

    public function execute()
    {
        $employee = new Employee($this->name, $this->address);

    }
}