<?php

namespace Tests;


use Payroll\Employee;
use Payroll\Payment;
use Payroll\Payroll;
use Payroll\Collection;
use Payroll\SalariedType;
use PHPUnit_Framework_TestCase as TestCase;
use DateTime;

class PayrollTest extends TestCase
{

    public function testWhenDoNotExistsEmployeesShouldReturnEmptyPaymentCollection()
    {
        $employees = new Collection();
        $payroll = new Payroll($employees);
        $payDate = \DateTime::createFromFormat('Y-m-d', '2014-12-31');
        $payments = $payroll->payEmployees($payDate);
        $this->assertEquals(0, $payments->count());
    }

    /** @test */
    public function testPayFlatSalaryEveryMonth()
    {
        $employeesList = $this->createEmployeesList();
        $payroll = new Payroll($employeesList);
        $payDate = DateTime::createFromFormat('Y-m-d', '2015-01-30');
        $paymentsList = $payroll->payEmployees($payDate);
        $this->assertEquals(2, $paymentsList->count());

        /** @var Payment $payment */
        $payment = $paymentsList->current();
        $this->assertEquals(1000, $payment->getMoney());
        $this->assertEquals($employeesList->current(), $payment->getEmployee());

        $paymentsList->next();
        $employeesList->next();
        $payment = $paymentsList->current();
        $this->assertEquals(1200, $payment->getMoney());
        $this->assertEquals($employeesList->current(), $payment->getEmployee());
    }

    /** @test */
    public function doNotPayFlatSalaryIfIsNotLastWorkingDayOfTheMonth()
    {
        $employeesList = $this->createEmployeesList();
        $payroll = new Payroll($employeesList);
        $payDate = DateTime::createFromFormat('Y-m-d', '2015-01-08');
        $paymentsList = $payroll->payEmployees($payDate);
        $this->assertEquals(0, $paymentsList->count());
    }

    /** @test */
    public function doNotPayFlatSalaryIfIsSaturday()
    {
        $employeesList = $this->createEmployeesList();
        $payroll = new Payroll($employeesList);
        $payDate = DateTime::createFromFormat('Y-m-d', '2015-01-31');
        $paymentsList = $payroll->payEmployees($payDate);
        $this->assertEquals(0, $paymentsList->count());
    }

    /** @test */
    public function doNotPayFlatSalaryIfIsSunday()
    {
        $employeesList = $this->createEmployeesList();
        $payroll = new Payroll($employeesList);
        $payDate = DateTime::createFromFormat('Y-m-d', '2014-11-30');
        $paymentsList = $payroll->payEmployees($payDate);
        $this->assertEquals(0, $paymentsList->count());
    }


    public function createEmployeesList()
    {
        $employeesList = new Collection();
        $bob = new Employee("Bob", "Home", 1000);
        $bob->setType(new SalariedType('2014-01-01'));
        $employeesList->add($bob);

        $stelu = new Employee("Stelu", "Spain", 1200);
        $stelu->setType(new SalariedType('2014-07-01'));
        $employeesList->add($stelu);

        return $employeesList;
    }
}
