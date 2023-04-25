<?php
require_once(__DIR__ . "/../model/types/Request.php");
require_once(__DIR__ . "/../model/types/Response.php");
require_once(__DIR__ . "/../model/types/Message.php");
require_once(__DIR__ . "/../model/MessageModel.php");

class MessagesController {
    static public function post(Request $request): Response {
        $message = new Message($request->data);
        $message->timestamp = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

        $response = new Response();
        $response->data = MessageModel::postMessage($message);
        return $response;
    }

    static public function get(Request $request): Response {
        $response = new Response();
        $response->data = MessageModel::getMessages($request->id, $request->other_id);
        return $response;
    }

    static public function delete(Request $request): Response {
        $response = new Response();

        if (MessageModel::deleteMessage($request->id)) {
            $response->status = 0;
        } else {
            $response->status = 1;
        }

        return $response;
    }

}