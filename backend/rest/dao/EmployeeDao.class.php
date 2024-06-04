<?php
require_once __DIR__ . '/BaseDao.class.php';

class EmployeeDao extends BaseDao {
    public function __construct() {
        parent::__construct('employees');
    }
}