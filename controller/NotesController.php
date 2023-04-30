<?php
require_once(__DIR__ . "/../model/types/Request.php");
require_once(__DIR__ . "/../model/types/Response.php");
require_once(__DIR__ . "/../model/types/Note.php");
require_once(__DIR__ . "/../model/NoteModel.php");

class NotesController {
    static public function post(Request $request): Response {
        $note = new Note($request->data);
        $note->timestamp = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $response = new Response();

        if (NoteModel::postNote($note)) {
            $response->status = 0;
        } else {
            $response->status = 1;
        }

        return $response;
    }

    static public function get(Request $request): Response {
        $response = new Response();
        $response->data = NoteModel::getNotes($request->id);
        return $response;
    }

    static public function put(Request $request): Response {
        $note = new Note($request->data);
        $note->timestamp = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $response = new Response();

        if (NoteModel::updateNote($note, $request->id)) {
            $response->status = 0;
        } else {
            $response->status = 1;
        }

        return $response;
    }

    static public function delete(Request $request): Response {
        $response = new Response();

        if (NoteModel::deleteNote($request->id)) {
            $response->status = 0;
        } else {
            $response->status = 1;
        }

        return $response;
    }
}