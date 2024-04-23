<?php

require_once __DIR__ . '/../dao/BaseDao.class.php';

class DepartmentDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct('departments');
  }
  public function get_departments()
  {
    $stmt = $this->connection->prepare("SELECT * FROM departments");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function add_department($department)
  {
    $stmt = $this->connection->prepare("INSERT INTO departments (department_name, manager_id) VALUES (:department_name, :manager_id)");
    $stmt->execute($department);
    $department['department_id'] = $this->connection->lastInsertId();
    return $department;
  }

}
