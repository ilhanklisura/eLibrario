<?php

require_once __DIR__ . '/path/to/your/DepartmentService.class.php';

$departmentService = new DepartmentService();
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
  $result = $departmentService->add_department([
    "department_name" => $data['department_name'],
    "manager_id" => $data['manager_id']
  ]);

  if ($result) {
    echo json_encode(["success" => "Department added successfully."]);
  } else {
    http_response_code(500);
    echo json_encode(["error" => "Failed to add department."]);
  }
} else {
  http_response_code(400);
  echo json_encode(["error" => "Invalid input data."]);
}
