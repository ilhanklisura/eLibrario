<?php

require_once __DIR__ . '/rest/services/DepartmentService.class.php';

$department_service = new DepartmentService();

$departments = $department_service->get_departments();

header('Content-Type: application/json');
echo json_encode(["data" => $departments]);
