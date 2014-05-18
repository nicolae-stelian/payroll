<?php

namespace Tests;



use \Payroll\PayrollDatabase;
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
        $transaction = new AddSalariedEmployee("Bob", "Home", 1000);
        $employee = $transaction->execute();

        $db = new PayrollDatabase();
        $emp = $db->getEmployee($employee->getId());

        $this->assertEquals("Bob", $emp->getName());
        $this->assertEquals(1000, $emp->GetSalary());
        $this->assertInstanceOf('Payroll\EmployeeType\SalariedType', $emp->GetType());
        $this->assertInstanceOf('Payroll\Schedule\MonthlySchedule', $emp->GetSchedule());
        $this->assertInstanceOf('Payroll\PaymentMethod\HoldMethod', $emp->GetMethod());

    }


}
 