<?php


namespace Payroll;


use SebastianBergmann\Comparator\ExceptionComparatorTest;

class PayrollDatabase
{


    public function clean()
    {
        try {
            $dbh = new \PDO("sqlite:" . __DIR__ . "/../../sqlitedb/payroll.db");
            $dbh->exec("DELETE FROM employees");
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getEmployee($employeeId)
    {
        try {
            $dbh = new \PDO('mysql:host=localhost;port=3306;dbname=payroll', 'user', 'password', array( \PDO::ATTR_PERSISTENT => false));
            $query = "SELECT * FROM employees WHERE id = ?";
            $stm = $dbh->prepare($query);
            $stm->execute(array($employeeId));
            $result = $stm->fetch(\PDO::FETCH_ASSOC);
            return $this->createEmployee($result);

        } catch(\PDOException $e) {
            echo $e->getMessage();
        }

       throw new \Exception("Employee with id = " . $employeeId . " don't exists in database");
    }

    protected function createEmployee(array $data)
    {
        $employee = new Employee($data['name'], $data['address']);
        // verification if this classes exists
        $employee->setPaymentMethod(new $data['paymentMethod']);
        $employee->setSchedule(new $data['schedule']);
        $employee->setType(new $data['type']);

        return $employee;
    }
}