<?php


namespace Payroll\EmployeeType;


class HourlyType implements EmployeeType
{

    public function getSalary(\Payroll\Employee $e)
    {
        return 0;
    }

    public function getRate()
    {
        return 0;
    }
}
