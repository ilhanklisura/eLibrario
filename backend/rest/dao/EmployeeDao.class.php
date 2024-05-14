<?php

require_once __DIR__ . '/BaseDao.class.php';

class EmployeeDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct('employees');
  }
  public function add_employee($employee)
  {
    /* 
    $query = "INSERT INTO patients (first_name, last_name, created_at, email)
              VALUES(:first_name, :last_name, :created_at, :email)";
    $statement = $this->connection->prepare($query);
    $statement->execute($patient);
    $patient['id'] = $this->connection->lastInsertId();
    return $patient;
    */
    return $this->insert('employees', $employee);
  }

  public function count_employee_paginated($search)
  {
    $query = "SELECT COUNT(*) AS count
                  FROM employees
                  WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(last_name) LIKE CONCAT('%', :search, '%') OR
                        LOWER(email) LIKE CONCAT('%', :search, '%');";
    return $this->query_unique($query, [
      'search' => $search
    ]);
  }

  public function get_employee_paginated($offset, $limit, $search, $order_column, $order_direction)
  {
    $query = "SELECT *
                  FROM employees
                  WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(last_name) LIKE CONCAT('%', :search, '%') OR
                        LOWER(email) LIKE CONCAT('%', :search, '%')
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
    return $this->query($query, [
      'search' => $search
    ]);
  }

  public function delete_employee_by_id($id)
  {
    $query = "DELETE FROM employees WHERE id = :id";
    $this->execute($query, [
      'id' => $id
    ]);
  }

  public function get_employee_by_id($employee_id)
  {
    return $this->query_unique(
      "SELECT *, DATE(created_at) as created_at FROM employees WHERE id = :id",
      [
        'id' => $employee_id
      ]
    );
  }

  public function edit_employee($id, $employee)
  {
    $query = "UPDATE employees SET first_name = :first_name, last_name = :last_name, created_at = :created_at, email = :email
                  WHERE id = :id";
    $this->execute($query, [
      'first_name' => $employee['first_name'],
      'last_name' => $employee['last_name'],
      'created_at' => $employee['created_at'],
      'email' => $employee['email'],
      'id' => $id
    ]);
  }

  public function get_all_employees()
  {
    $query = "SELECT *
                  FROM employees;";
    return $this->query($query, []);
  }
}