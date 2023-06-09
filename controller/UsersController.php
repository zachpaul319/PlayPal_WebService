<?php
require_once(__DIR__ . "/../model/types/Request.php");
require_once(__DIR__ . "/../model/types/Response.php");
require_once(__DIR__ . "/../model/types/User.php");
require_once(__DIR__ . "/../model/UserModel.php");
require_once(__DIR__ . "/../lib/Security.php");

class UsersController {
    static public function post(Request $request): Response {
        $user = new User($request->data);
        $user->password = getHashedPassword($user->password);
        $response = new Response();

        if (UserModel::createUser($user)) {
            $response->status = 0;
        } else {
            $response->status = 1;
        }

        return $response;
    }

    static public function get(Request $request): Response {
        $username = $request->data;
        $response = new Response();

        if ($request->id == -1) {
            $response->data = UserModel::getAllUsers();
        } else if ($request->id == 0) {
            $response->data = UserModel::getUserByUsername($username);
        } else {
            $response->data = UserModel::getUserById($request->id);
        }
        return $response;
    }

    static public function put(Request $request): Response {
        $user = new User($request->data);
        $response = new Response();

        if (UserModel::updateUserProductions($user, $request->id)) {
            $response->status = 0;
        } else {
            $response->status = 1;
        }

        return $response;

    }

    static public function delete(Request $request): Response {
        $response = new Response();

        if (UserModel::deleteUser($request->id)) {
            $response->status = 0;
        } else {
            $response->status = 1;
        }

        return $response;
    }
}