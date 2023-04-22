<?php
require_once(__DIR__ . "/Database.php");
require_once(__DIR__ . "/types/Message.php");

class MessageModel {
    public static function postMessage(Message $message): bool {
        $sql = "INSERT INTO tblMessagesPLAYPAL (senderId, recipientId, text, timestamp) VALUES (?, ?, ?, ?)";
        Database::executeSql($sql, "iiss", array($message->senderId, $message->recipientId, $message->text, $message->timestamp->format('Y-m-d H:i:s')));
        return ! isset(Database::$lastError);
    }

    public static function getMessages(int $userId): array {
        $sql = "SELECT * FROM tblMessagesPLAYPAL WHERE senderId = ? OR recipientId = ? ORDER BY timestamp";
        return Database::executeSql($sql, "ii", array($userId, $userId));
    }

    public static function deleteMessage(int $messageId): bool {
        $sql = "DELETE FROM tblMessagesPLAYPAL WHERE messageId = ?";
        Database::executeSql($sql, "i", array($messageId));
        return ! isset(Database::$lastError);
    }

}