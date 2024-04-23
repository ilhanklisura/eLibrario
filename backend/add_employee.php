<?php

require_once __DIR__ . '/rest/services/EmployeeService.class.php';

$employee_service = new EmployeeService();

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);

$result = $employee_service->add_employee([
  "first_name" => $decoded['first_name'],
  "last_name" => $decoded['last_name'],
  "email" => $decoded['email'],
  "date_of_birth" => $decoded['date_of_birth'],
  "department_id" => $decoded['department_id'],
  "position" => $decoded['position'],
  "hire_date" => $decoded['hire_date']
]);

header('Content-Type: application/json');
if ($result) {
  echo json_encode($result);
} else {
  echo json_encode(["error" => "Failed to add employee."]);
}
