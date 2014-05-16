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
        $employeeId = 1;
        $transaction = new AddSalariedEmployee(1, "Bob", "Home", 1000);
        $transaction->execute();

        $db = new PayrollDatabase();
        $emp = $db->getEmployee($employeeId);

        $this->assertEquals("Bob", $emp->getName());
//        $this->assertEquals(1000, $emp->GetSalary());
//        $this->assertInstanceOf("SalariedType", $emp->GetType());
//        $this->assertInstanceOf("MonthlySchedule", $emp->GetSchedule());
//        $this->assertInstanceOf("HoldMethod", $emp->GetMethod());

    }


}
 