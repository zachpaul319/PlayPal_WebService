<?php
require_once(__DIR__ . "/Database.php");

class ContactModel {
    public static function getContacts(int $userId) {
        $sql = "(SELECT u.userId, u.username, m.text
FROM tblUsersPLAYPAL u
JOIN (
  SELECT 
    CASE
      WHEN senderId = '$userId' THEN recipientId
      ELSE senderId
    END AS contactId,
    MAX(timestamp) AS lastMessageTime
  FROM tblMessagesPLAYPAL
  WHERE senderId = '$userId' OR recipientId = '$userId'
  GROUP BY CASE
      WHEN senderId = '$userId' THEN recipientId
      ELSE senderId
    END
) lastMessages ON u.userId = lastMessages.contactId
JOIN tblMessagesPLAYPAL m ON (
  m.senderId = '$userId' AND m.recipientId = lastMessages.contactId 
  OR m.senderId = lastMessages.contactId AND m.recipientId = '$userId'
) AND m.timestamp = lastMessages.lastMessageTime)";
        $results = Database::executeSql($sql);
        return $results;
    }

    public static function deleteContact(int $messenger_1_Id, int $messenger_2_Id): bool {
        $sql = "(DELETE FROM tblMessagesPLAYPAL WHERE (senderId = ? AND recipientId = ?) OR (senderId = ? AND recipientId = ?))";
        Database::executeSql($sql, "iiii", array($messenger_1_Id, $messenger_2_Id, $messenger_2_Id, $messenger_1_Id));
        return ! isset(Database::$lastError);
    }


}