<?php
require_once(__DIR__ . "/Database.php");
require_once(__DIR__ . "/types/Message.php");

class MessageModel {
    public static function postMessage(Message $message) {
        $postSql = "INSERT INTO tblMessagesPLAYPAL (senderId, recipientId, text, timestamp) VALUES (?, ?, ?, ?)";
        return Database::executeSql($postSql, "iiss", array($message->senderId, $message->recipientId, $message->text, $message->timestamp->format('Y-m-d H:i:s')));
    }

    public static function getMessages(int $userId, int $contactId): array {
        $sql = "SELECT * FROM tblMessagesPLAYPAL WHERE (senderId = ? OR recipientId = ?) AND (senderId = ? OR recipientId = ?) ORDER BY timestamp";
        return Database::executeSql($sql, "iiii", array($userId, $userId, $contactId, $contactId));
    }

    public static function getLatestMessage(int $userId, int $contactId): Message {
        $sql = "SELECT * FROM tblMessagesPLAYPAL WHERE (senderId = ? OR recipientId = ?) AND (senderId = ? OR recipientId = ?) ORDER BY timestamp DESC LIMIT 1";
        $results = Database::executeSql($sql, "iiii", array($userId, $userId, $contactId, $contactId));
        return new Message($results[0]);
    }

    public static function deleteMessage(int $messageId): bool {
        $sql = "DELETE FROM tblMessagesPLAYPAL WHERE messageId = ?";
        Database::executeSql($sql, "i", array($messageId));
        return ! isset(Database::$lastError);
    }

}