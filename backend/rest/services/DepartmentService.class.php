<?php

require_once __DIR__ . '/../dao/DepartmentDao.class.php';

class DepartmentService
{
  private $department_dao;

  public function __construct()
  {
    $this->department_dao = new DepartmentDao();
  }

  public function get_departments()
  {
    return $this->department_dao->get_departments();
  }

  public function add_department($department)
  {
    return $this->department_dao->add_department($department);
  }

}
