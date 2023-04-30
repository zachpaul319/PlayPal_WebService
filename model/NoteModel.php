<?php
require_once(__DIR__ . "/Database.php");
require_once(__DIR__ . "/types/Note.php");

class NoteModel {
    static public function postNote(Note $note) {
        $sql = "INSERT INTO tblNotesPLAYPAL (userId, title, content, timestamp) VALUES (?, ?, ?, ?)";
        Database::executeSql($sql, "isss", array($note->userId, $note->title, $note->content, $note->timestamp->format('Y-m-d H:i:s')));
        return ! isset(Database::$lastError);
    }

    static public function getNotes(int $userId) {
        $sql = "SELECT * FROM tblNotesPLAYPAL WHERE userId = ? ORDER BY timestamp DESC";
        return Database::executeSql($sql, "i", array($userId));
    }

    static public function updateNote(Note $note, int $noteId) {
        $sql = "UPDATE tblNotesPLAYPAL SET title = ?, content = ?, timestamp = ? WHERE noteId = ?";
        Database::executeSql($sql, "sssi", array($note->title, $note->content, $note->timestamp->format('Y-m-d H:i:s'), $noteId));
        return ! isset(Database::$lastError);
    }

    static public function deleteNote(int $noteId) {
        $sql = "DELETE FROM tblNotesPLAYPAL WHERE noteId = ?";
        Database::executeSql($sql, "i", array($noteId));
        return ! isset(Database::$lastError);
    }
}