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
    $employee['password'] = password_hash($employee['password'], PASSWORD_BCRYPT);
    return $this->employee_dao->add_employee($employee);
  }
  public function get_employee_paginated($offset, $limit, $search, $order_column, $order_direction)
  {
    $count = $this->employee_dao->count_employee_paginated($search)['count'];
    $rows = $this->employee_dao->get_employee_paginated($offset, $limit, $search, $order_column, $order_direction);

    return [
      'count' => $count,
      'data' => $rows
    ];
  }
  public function delete_employee_by_id($employee_id)
  {
    $this->employee_dao->delete_employee_by_id($employee_id);
  }

  public function get_employee_by_id($employee_id)
  {
    return $this->employee_dao->get_employee_by_id($employee_id);
  }

  public function edit_employee($employee)
  {
    $id = $employee['id'];
    unset($employee['id']);

    $this->employee_dao->edit_employee($id, $employee);
  }

  public function get_all_employees()
  {
    return $this->employee_dao->get_all_employees();
  }
}