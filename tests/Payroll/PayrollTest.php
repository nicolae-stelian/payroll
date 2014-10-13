<?php

namespace Tests;


use Payroll\Employee;
use Payroll\Payment;
use Payroll\Payroll;
use Payroll\Collection;
use Payroll\SalariedType;

class PayrollTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function it_should_return_empty_payments_when_do_not_exists_employees()
    {
        $employees = new Collection();
        $payroll = new Payroll($employees);
        $payDate = \DateTime::createFromFormat('Y-m-d', '2014-10-01');
        $payments = $payroll->payEmployees($payDate);
        $this->assertEquals(0, $payments->count());
    }

    /**
     * @test
     */
    public function it_should_pay_flat_salary_every_month()
    {
        $employeesList = new Collection();
        $employee = new Employee("Bob", "Home", 1000);
        $employee->setType(new SalariedType('2014-01-01'));

        $employeesList->add($employee);
        $payroll = new Payroll($employeesList);
        $payDate = \DateTime::createFromFormat('Y-m-d', '2014-10-01');
        $payments = $payroll->payEmployees($payDate);

        $this->assertEquals(1, $payments->count());
        /** @var Payment $payment */
        $payment = $payments->current();
        $this->assertEquals(1000, $payment->getMoney());
        $this->assertEquals($employee, $payment->getEmployee());
    }
}
