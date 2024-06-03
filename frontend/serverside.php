<?php

/**
 * @OA\Post(
 *      path="/sample/users",
 *      tags={"sample"},
 *      summary="Add sample user",
 *      @OA\Response(
 *           response=200,
 *           description="Appropriate message"
 *      ),
 *      @OA\RequestBody(
 *          description="Request data",
 *          @OA\JsonContent(
 *             required={"name", "created_at"},
 *             @OA\Property(property="name", required=true, type="string", example="Ilhan Klisura"),
 *             @OA\Property(property="created_at", required=true, type="string", "2024-04-01")
 *           )
 *      ),
 * )
 */
Flight::route('POST /sample/users', function () {
  $body = json_decode(Flight::request()->getBody(), TRUE);
  Flight::json(["message"=> "You have successfully added a user", "data" => $body]);
});

/**
 * @OA\Get(
 *      path="/sample/users",
 *      tags={"sample"},
 *      summary="Get users",
 *      @OA\Response(
 *           response=200,
 *           description="Users list"
 *      )
 * )
 */
Flight::route('GET /sample/users', function () {
  $params = [
      "st" => (int)Flight::request()->query['start'],
      "s" => Flight::request()->query['search']['value'],
      "e" => (int)Flight::request()->query['draw'],
      "o" => Flight::request()->query['start'],
      "l" => (int)Flight::request()->query['length'],
      "or" => Flight::request()->query['order'],
  ];

  $users = array(
      array('user' => 'CJ87JKL9', 'created_at' => '2023-07-15'),
      array('user' => '2DGH54AL', 'created_at' => '2023-05-20'),
      array('user' => '9LZ68QWX', 'created_at' => '2023-10-03'),
      array('user' => 'K1PQ7VZ3', 'created_at' => '2023-01-25'),
      array('user' => 'T90J6E2F', 'created_at' => '2023-11-18'),
      array('user' => 'R2W71H6X', 'created_at' => '2023-02-09'),
      array('user' => '8K4P3NDM', 'created_at' => '2023-09-27'),
      array('user' => 'QNG98B27', 'created_at' => '2023-04-05'),
      array('user' => '7XFL6WY9', 'created_at' => '2023-08-13'),
      array('user' => 'MZD3K8N1', 'created_at' => '2023-03-30'),
      array('user' => 'P5BC7AWY', 'created_at' => '2023-12-22'),
      array('user' => 'B28J1W5Z', 'created_at' => '2023-06-10'),
      array('user' => 'HW3YQK7D', 'created_at' => '2023-01-03'),
      array('user' => 'Y8VCN9M1', 'created_at' => '2023-11-28'),
      array('user' => '5DLJK9BQ', 'created_at' => '2023-05-14'),
      array('user' => '9W4G1ZPC', 'created_at' => '2023-10-08'),
      array('user' => 'U0D78ZPL', 'created_at' => '2023-07-02'),
      array('user' => 'J29WU5YH', 'created_at' => '2023-02-15'),
      array('user' => '3R6L8CJG', 'created_at' => '2023-09-17'),
      array('user' => 'N6KQDWL4', 'created_at' => '2023-04-25'),
      array('user' => '7QG54XE8', 'created_at' => '2023-08-08'),
      array('user' => 'C89YVZB6', 'created_at' => '2023-03-03'),
      array('user' => 'W45HJVYN', 'created_at' => '2023-12-26'),
      array('user' => 'K6V3G4A8', 'created_at' => '2023-06-18'),
      array('user' => 'D1ZQF5TL', 'created_at' => '2023-01-11')
  );
  $end = $params['st'] + $params['l'];
  $temp = [];

  if($params['st'] + $params['l'] > count($users)){
    $end = count($users) - 1;
  }

  for($i = $params['st']; $i <= $end; $i++){
    $temp[] = $users[$i];
  }

  Flight::json(
      [
          'draw' => $params['e'],
          'data' => $temp,
          'recordsFiltered' => count($users),
          'recordsTotal' => count($users),
          'end' => $end
      ]
  );
});