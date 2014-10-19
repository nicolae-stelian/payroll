<?php

namespace Tests;


use Payroll\Employee;
use Payroll\Payment;
use Payroll\Payroll;
use Payroll\Collection;
use Payroll\SalariedType;

class PayrollTest extends \PHPUnit_Framework_TestCase
{

    public function testWhenDoNotExistsEmployeesShouldReturnEmptyPaymentCollection()
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
    public function testPayFlatSalaryEveryMonth()
    {
        $employeesList = $this->createEmployeesList();
        $payroll = new Payroll($employeesList);
        $payDate = \DateTime::createFromFormat('Y-m-d', '2014-10-01');
        $paymentsList = $payroll->payEmployees($payDate);
        $this->assertEquals(2, $paymentsList->count());

        $paymentsList->rewind();
        $employeesList->rewind();
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

    public function createEmployeesList()
    {
        $employeesList = new Collection();
        $employeeBob = new Employee("Bob", "Home", 1000);
        $employeeBob->setType(new SalariedType('2014-01-01'));
        $employeesList->add($employeeBob);

        $employeeStelu = new Employee("Bob", "Spain", 1200);
        $employeeStelu->setType(new SalariedType('2014-07-01'));
        $employeesList->add($employeeStelu);


        return $employeesList;
    }
}
