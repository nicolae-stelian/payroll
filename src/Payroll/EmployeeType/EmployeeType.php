<?php


namespace Payroll\EmployeeType;


interface EmployeeType
{
    public function getSalary(\Payroll\Employee $e);
}
