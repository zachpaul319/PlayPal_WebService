<?php
require_once(__DIR__ . "/Database.php");

class ContactModel {
    public static function getContacts(int $userId): array {
        $sql1 = "SELECT DISTINCT u.username FROM tblMessagesPLAYPAL m JOIN tblUsersPLAYPAL u ON m.recipientId = u.userId WHERE m.senderId = ?";
        $sql2 = "SELECT DISTINCT u.username FROM tblMessagesPLAYPAL m JOIN tblUsersPLAYPAL u ON m.senderId = u.userId WHERE m.recipientId = ?";
        $sqlFinal = $sql1 . " UNION " . $sql2;
        return Database::executeSql($sqlFinal, "ii", array($userId, $userId));
    }

    public static function deleteContact(int $messenger_1_Id, int $messenger_2_Id): bool {
        $sql = "DELETE FROM tblMessagesPLAYPAL WHERE (senderId = ? AND recipientId = ?) OR (senderId = ? AND recipientId = ?)";
        Database::executeSql($sql, "iiii", array($messenger_1_Id, $messenger_2_Id, $messenger_2_Id, $messenger_1_Id));
        return ! isset(Database::$lastError);
    }
}