<?php


namespace Payroll;


class PayrollDatabase
{
    protected $sqlDns;
    protected $sqlUser;
    protected $sqlPasword;

    public function __construct()
    {
        $this->sqlDns = 'mysql:host=localhost;port=3306;dbname=payroll';
        $this->sqlUser = 'user';
        $this->sqlPasword = 'password';

    }

    public function clean()
    {
        try {
            $dbh = new \PDO($this->sqlDns, $this->sqlUser, $this->sqlPasword, array(\PDO::ATTR_PERSISTENT => false));
            $dbh->exec("DELETE FROM employees");
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getEmployee($employeeId)
    {
        try {
            $dbh = new \PDO($this->sqlDns, $this->sqlUser, $this->sqlPasword, array(\PDO::ATTR_PERSISTENT => false));
            $query = "SELECT * FROM employees WHERE id = ?";
            $stm = $dbh->prepare($query);
            $stm->execute(array($employeeId));
            $result = $stm->fetch(\PDO::FETCH_ASSOC);
            return $this->createEmployeeFromArray($result);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        throw new \Exception("Employee with id = " . $employeeId . " don't exists in database");
    }


    public function save(Employee $employee)
    {
        try {
            $dbh = new \PDO($this->sqlDns, $this->sqlUser, $this->sqlPasword, array(\PDO::ATTR_PERSISTENT => false));
            $bind = $employee->toArray();
            $query = "INSERT INTO employees(name, address, paymentMethod, schedule, type) VALUES (?, ?, ?, ?, ?)";
            $stm = $dbh->prepare($query);
            if ($stm->execute($bind)) {
                $employee->setId($dbh->lastInsertId());
                return true;
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        throw new \Exception("Cannot save employee en database");
    }

    protected function createEmployeeFromArray(array $data)
    {
        $employee = new Employee($data['name'], $data['address']);
        $employee->setId($data['id']);

        // verification if this classes exists
        $employee->setPaymentMethod(new $data['paymentMethod']);
        $employee->setSchedule(new $data['schedule']);
        $employee->setType(new $data['type']);

        return $employee;
    }
}
