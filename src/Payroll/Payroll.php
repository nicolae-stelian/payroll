<?php


namespace Payroll;


class Payroll
{
    /** @var Collection  */
    protected $employees;

    public function __construct(Collection $employees)
    {
        $this->employees = $employees;
        $this->employees->rewind();
    }

    public function payEmployees(\DateTime $date)
    {
        $payments = new Collection();
        /** @var Employee $employee */
        foreach ($this->employees as $employee) {
            if ($employee->isPayDate($date)) {
                $payments->add($employee->makePayment());
            }
        }
        $payments->rewind();
        $this->employees->rewind();
        return $payments;
    }
}
