<?php

require_once __DIR__ . '/../dao/BaseDao.class.php';

class EmployeeDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct('employees');
  }
  public function add_employee($employee)
  {
    $stmt = $this->connection->prepare("INSERT INTO employees (first_name, last_name, email, date_of_birth, department_id, position, hire_date) VALUES (:first_name, :last_name, :email, :date_of_birth, :department_id, :position, :hire_date)");
    $stmt->execute($employee);
    $employee['id'] = $this->connection->lastInsertId();
    return $employee;
  }
  public function get_all_employees()
  {
    $stmt = $this->connection->prepare("SELECT * FROM employees");
    $stmt->execute();
    return $stmt->fetchAll();
  }
}