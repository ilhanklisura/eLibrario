<?php

require_once __DIR__ . '/rest/services/EmployeeService.class.php';

$employee_service = new EmployeeService();

$employee = $employee_service->get_all_employees();

header('Content-Type: application/json');
echo json_encode(array("data" => $employees));
