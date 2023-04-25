<?php
require_once(__DIR__ . "/../model/types/Request.php");
require_once(__DIR__ . "/../model/types/Response.php");
require_once(__DIR__ . "/../model/types/User.php");
require_once(__DIR__ . "/../model/ContactModel.php");

class ContactsController {
    static public function get(Request $request): Response {
        $response = new Response();
        $response->data = ContactModel::getContacts($request->id);
        return $response;
    }

    static public function delete(Request $request): Response {
        $response = new Response();

        if (ContactModel::deleteContact($request->id, $request->other_id)) {
            $response->status = 0;
        } else {
            $response->status = 1;
        }

        return $response;
    }
}