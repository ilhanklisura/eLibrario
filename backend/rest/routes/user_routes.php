<?php

require_once __DIR__ . '/../services/UserService.class.php';

Flight::group('/users', function() {

    /**
     * @OA\Get(
     *      path="/users",
     *      tags={"users"},
     *      summary="Get all users",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Get all users"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="start", example="0", description="Start index"),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="length", example="0", description="End index"),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="draw", example="1", description="Draw")
     * )
     */
    Flight::route('GET /', function () {
        $body = Flight::request()->query;
        $params = [
            "start" => (int)$body['start'],
            "search" => "",
            "draw" => $body['draw'],
            "limit" => (int)$body['length'],
            "order_column" => $body['order'][0]['name'],
            "order_direction" => $body['order'][0]['dir'],
        ];

        $user_service = new UserService();

        $count = $user_service->count_users($params['search']);
        $users = $user_service->get_users(
            $params['start'],
            $params['limit'],
            $params['search'],
            $params['order_column'],
            $params['order_direction']
        );

        foreach ($users as $id => $user) {
            $patients[$id]['action'] = '<div class="btn-group" role="group" aria-label="Actions">' .
                                            '<button type="button" class="btn btn-warning" onclick="UserService.open_edit_user_modal('. $user['id'] .')">Edit</button>' .
                                            '<button type="button" class="btn btn-danger" onclick="UserService.delete_user('. $user['id'] .')">Delete</button>' .
                                    '</div>';
        }
        Flight::json([
            'draw' => $params['draw'],
            'data' => $users,
            'recordsFiltered' => $count['count'],
            'recordsTotal' => $count['count'],
            'end' => $count['count']
        ], 200);
    });

    /**
     * @OA\Get(
     *      path="/users/all",
     *      tags={"users"},
     *      summary="Get all users",
     *      @OA\Response(
     *           response=200,
     *           description="Get all users"
     *      )
     * )
     */
    Flight::route('GET /all', function () {
        $user_service = new UserService();
        $user = $user_service->get_all_users();
        Flight::json($user, 200);
    });

    /**
     * @OA\Get(
     *      path="/users/user",
     *      tags={"users"},
     *      summary="Get user by ID",
     *      @OA\Response(
     *           response=200,
     *           description="Get user by ID"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="user_id", example="1", description="User ID")
     * )
     */
    Flight::route('GET /user', function () {
        $body = Flight::request()->query;

        $user_service = new UserService();
        $user = $user_service->get_user_by_id($body['id']);
        Flight::json($user, 200);
    });

    /**
     * @OA\Post(
     *      path="/users/add",
     *      tags={"users"},
     *      summary="Add user",
     *      @OA\Response(
     *           response=200,
     *           description="Logged user"
     *      ),
     *      @OA\RequestBody(
     *          description="Food ID",
     *          @OA\JsonContent(
     *             required={"first_name", "last_name", "email"},
     *             @OA\Property(property="first_name", required=true, type="string", example="Ilhan"),
     *             @OA\Property(property="last_name", required=true, type="string", example="Klisura"),
     *             @OA\Property(property="email", required=true, type="string", example="ilhan.klisura@stu.ibu.edu.ba"),
     *             @OA\Property(property="password", required=true, type="string", example="strong")
     *           )
     *      ),
     * )
     */
    Flight::route('POST /add', function () {
        $payload = Flight::request()->data->getData();
        if($payload['first_name'] == NULL || $payload['last_name'] == NULL || $payload['email'] == NULL) {
            Flight::halt(500, "Required parameters are missing!");
        }
        unset($payload['id']);
        $user_service = new UserService();
        $user = $user_service->add_user($payload);
        Flight::json(['data' => $user, 'message' => "You have successfully added the user"]);
    });

    /**
     * @OA\Delete(
     *      path="/delete/{id}",
     *      tags={"user"},
     *      summary="Delete user by id",
     *      @OA\Response(
     *           response=200,
     *           description="Status message"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="id", example="1", description="User id")
     * )
     */
    Flight::route('DELETE /delete/@id', function ($user_id) {
        if($user_id == NULL || $user_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $user_service = new UserService();
        $user_service->delete_user_by_id($user_id);
        
        Flight::json(['data' => NULL, 'message' => "You have successfully deleted the user"]);
    });
});