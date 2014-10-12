<?php

namespace Tests;



use \Payroll\PayrollDatabase;
use Payroll\Transactions\AddHourlyEmployee;
use \Payroll\Transactions\AddSalariedEmployee;

class PayrollTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $db = new PayrollDatabase();
        $db->clean();
    }


    public function testAddSalariedEmployee()
    {
        $this->markTestIncomplete("TODO this test to work");
        $transaction = new AddSalariedEmployee("Bob", "Home", 1000);
        $employee = $transaction->execute();

        $db = new PayrollDatabase();
        $emp = $db->getEmployee($employee->getId());

        $this->assertEquals("Bob", $emp->getName());
        $this->assertEquals(1000, $emp->getSalary());
        $this->assertInstanceOf('Payroll\EmployeeType\SalariedType', $emp->getType());
        $this->assertInstanceOf('Payroll\Schedule\MonthlySchedule', $emp->getSchedule());
        $this->assertInstanceOf('Payroll\PaymentMethod\HoldMethod', $emp->getMethod());

    }

    public function testAddHourlyEmployee()
    {
        $this->markTestIncomplete("TODO this test to work");

        $transaction = new AddHourlyEmployee("Bill", "Home", 15.25);
        $employee = $transaction->execute();

        $db = new PayrollDatabase();
        $emp = $db->getEmployee($employee->getId());

        $this->assertEquals("Bill", $emp->getName());

        /** @var \Payroll\EmployeeType\HourlyType $hourlyType */
        $hourlyType = $emp->getType();
        $this->assertEquals(15.25, $hourlyType->getRate());
        $this->assertInstanceOf('Payroll\EmployeeType\HourlyType', $emp->GetType());
        $this->assertInstanceOf('Payroll\Schedule\WeeklySchedule', $emp->GetSchedule());
        $this->assertInstanceOf('Payroll\PaymentMethod\HoldMethod', $emp->GetMethod());

    }
}
