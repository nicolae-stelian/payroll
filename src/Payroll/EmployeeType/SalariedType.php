<?php


namespace Payroll\EmployeeType;


class SalariedType implements EmployeeType
{

    public function getSalary(\Payroll\Employee $e)
    {
        return 1000;
    }
}