<?php

require_once __DIR__ . '/../dao/EmployeeDao.class.php';

class EmployeeService
{
  private $employee_dao;

  public function __construct()
  {
    $this->employee_dao = new EmployeeDao();
  }
  public function add_employee($employee)
  {
    $employee['hire_date'] = date('Y-m-d');
    return $this->employee_dao->add_employee($employee);
  }
  public function get_all_employees()
  {
    return $this->employee_dao->get_all_employees();
  }
}