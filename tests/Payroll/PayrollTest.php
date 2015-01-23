<?php

namespace Tests;


use Payroll\Employee;
use Payroll\HourlyType;
use Payroll\Payment;
use Payroll\Payroll;
use Payroll\Collection;
use Payroll\SalariedType;
use Payroll\TimeCard;
use PHPUnit_Framework_TestCase as TestCase;
use DateTime;

class PayrollTest extends TestCase
{
    /** @var  Collection */
    protected $employees;
    /** @var  Payroll */
    protected $payroll;

    public function setUp()
    {
        $this->employees = $this->createEmployeesList();
        $this->payroll = new Payroll($this->employees);
    }

    protected function createEmployeesList()
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

    public function testWhenDoNotExistsEmployeesShouldReturnEmptyPaymentCollection()
    {
        $payroll = new Payroll(new Collection());
        $payDate = \DateTime::createFromFormat('Y-m-d', '2014-12-31');
        $payments = $payroll->payEmployees($payDate);
        $this->assertEquals(0, $payments->count());
    }

    /** @test */
    public function testPayFlatSalaryEveryMonth()
    {
        $payDate = DateTime::createFromFormat('Y-m-d', '2015-01-30');
        $paymentsList = $this->payroll->payEmployees($payDate);
        $this->assertEquals(2, $paymentsList->count());

        /** @var Payment $payment */
        $payment = $paymentsList->current();
        $this->assertEquals(1000, $payment->getMoney());
        $this->assertEquals($this->employees->current(), $payment->getEmployee());

        $paymentsList->next();
        $this->employees->next();
        $payment = $paymentsList->current();
        $this->assertEquals(1200, $payment->getMoney());
        $this->assertEquals($this->employees->current(), $payment->getEmployee());
    }

    /** @test */
    public function doNotPayFlatSalaryIfIsNotLastWorkingDayOfTheMonth()
    {
        $payDate = DateTime::createFromFormat('Y-m-d', '2015-01-08');
        $paymentsList = $this->payroll->payEmployees($payDate);
        $this->assertEquals(0, $paymentsList->count());
    }

    /** @test */
    public function doNotPayFlatSalaryIfIsSaturday()
    {
        $payDate = DateTime::createFromFormat('Y-m-d', '2015-01-31');
        $paymentsList = $this->payroll->payEmployees($payDate);
        $this->assertEquals(0, $paymentsList->count());
    }

    /** @test */
    public function doNotPayFlatSalaryIfIsSunday()
    {
        $payDate = DateTime::createFromFormat('Y-m-d', '2014-11-30');
        $paymentsList = $this->payroll->payEmployees($payDate);
        $this->assertEquals(0, $paymentsList->count());
    }

    public function addHourlyEmployee()
    {
        $employeeList = new Collection();
        $bob = new Employee("Bob", "Home", 15.25);

        $timeCards = new Collection();
        $timeCards->add(new TimeCard('2014-11-30', 8));
        $bob->setType(new HourlyType('2014-07-01', $timeCards));

        $employeeList->add($bob);
        $payDate = DateTime::createFromFormat('Y-m-d', '2015-01-30');
        $payroll = new Payroll($employeeList);
        $paymentsList = $payroll->payEmployees($payDate);

    }
}
