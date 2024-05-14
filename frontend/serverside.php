<?php

/**
 * @OA\Post(
 *      path="/sample/customers",
 *      tags={"sample"},
 *      summary="Add sample customer",
 *      @OA\Response(
 *           response=200,
 *           description="Appropriate message"
 *      ),
 *      @OA\RequestBody(
 *          description="Request data",
 *          @OA\JsonContent(
 *             required={"name", "created_at"},
 *             @OA\Property(property="name", required=true, type="string", example="Becir Isakovic"),
 *             @OA\Property(property="created_at", required=true, type="string", "2024-04-01")
 *           )
 *      ),
 * )
 */
Flight::route('POST /sample/customers', function () {
  $body = json_decode(Flight::request()->getBody(), TRUE);
  Flight::json(["message" => "You have successfully addedd a customer", "data" => $body]);
});

/**
 * @OA\Get(
 *      path="/sample/customers",
 *      tags={"sample"},
 *      summary="Get customers",
 *      @OA\Response(
 *           response=200,
 *           description="Customers list"
 *      )
 * )
 */
Flight::route('GET /sample/employees', function () {
  $params = [
    "st" => (int) Flight::request()->query['start'],
    "s" => Flight::request()->query['search']['value'],
    "e" => (int) Flight::request()->query['draw'],
    "o" => Flight::request()->query['start'],
    "l" => (int) Flight::request()->query['length'],
    "or" => Flight::request()->query['order'],
  ];

  $employees = array (
    array ('employee' => 'CJ87JKL9', 'created_at' => '2023-07-15'),
    array ('employee' => '2DGH54AL', 'created_at' => '2023-05-20'),
    array ('employee' => '9LZ68QWX', 'created_at' => '2023-10-03'),
    array ('employee' => 'K1PQ7VZ3', 'created_at' => '2023-01-25'),
    array ('employee' => 'T90J6E2F', 'created_at' => '2023-11-18'),
    array ('employee' => 'R2W71H6X', 'created_at' => '2023-02-09'),
    array ('employee' => '8K4P3NDM', 'created_at' => '2023-09-27'),
    array ('employee' => 'QNG98B27', 'created_at' => '2023-04-05'),
    array ('employee' => '7XFL6WY9', 'created_at' => '2023-08-13'),
    array ('employee' => 'MZD3K8N1', 'created_at' => '2023-03-30'),
    array ('employee' => 'P5BC7AWY', 'created_at' => '2023-12-22'),
    array ('employee' => 'B28J1W5Z', 'created_at' => '2023-06-10'),
    array ('employee' => 'HW3YQK7D', 'created_at' => '2023-01-03'),
    array ('employee' => 'Y8VCN9M1', 'created_at' => '2023-11-28'),
    array ('employee' => '5DLJK9BQ', 'created_at' => '2023-05-14'),
    array ('employee' => '9W4G1ZPC', 'created_at' => '2023-10-08'),
    array ('employee' => 'U0D78ZPL', 'created_at' => '2023-07-02'),
    array ('employee' => 'J29WU5YH', 'created_at' => '2023-02-15'),
    array ('employee' => '3R6L8CJG', 'created_at' => '2023-09-17'),
    array ('employee' => 'N6KQDWL4', 'created_at' => '2023-04-25'),
    array ('employee' => '7QG54XE8', 'created_at' => '2023-08-08'),
    array ('employee' => 'C89YVZB6', 'created_at' => '2023-03-03'),
    array ('employee' => 'W45HJVYN', 'created_at' => '2023-12-26'),
    array ('employee' => 'K6V3G4A8', 'created_at' => '2023-06-18'),
    array ('employee' => 'D1ZQF5TL', 'created_at' => '2023-01-11')
  );
  $end = $params['st'] + $params['l'];
  $temp = [];

  if ($params['st'] + $params['l'] > count($employees)) {
    $end = count($employees) - 1;
  }

  for ($i = $params['st']; $i <= $end; $i++) {
    $temp[] = $employees[$i];
  }

  Flight::json(
    [
      'draw' => $params['e'],
      'data' => $temp,
      'recordsFiltered' => count($employees),
      'recordsTotal' => count($employees),
      'end' => $end
    ]
  );
});