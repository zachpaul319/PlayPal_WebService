<?php
require_once(__DIR__ . "/Database.php");
require_once(__DIR__ . "/types/User.php");
class UserModel {
    public static function createUser(User $user): bool {
        $sql = "INSERT INTO tblUsersPLAYPAL (username, password, currentProduction, pastProductions) VALUES (?, ?, ?, ?)";
        Database::executeSql($sql, "ssss", array($user->username, $user->password, $user->currentProduction, $user->pastProductions));
        return ! isset(Database::$lastError);
    }

    public static function getUser($username): User {
        $sql = "SELECT * FROM tblUsersPLAYPAL WHERE username = ?";
        $results = Database::executeSql($sql, "s", array($username));
        $user = new User($results[0]);
        return $user;
    }

    public static function updateUserProductions($currentProduction, $pastProductions, int $userId): bool {
        $sql = "UPDATE tblUsersPLAYPAL SET currentProduction = ?, pastProductions = ? WHERE userId = ?";
        Database::executeSql($sql, "ssi", array($currentProduction, $pastProductions, $userId));
        return ! isset(Database::$lastError);
    }

    public static function deleteUser(int $userId) {
        $sql = "DELETE FROM tblUsersPLAYPAL WHERE userId = ?";
        Database::executeSql($sql, "i", array($userId));
        return ! isset(Database::$lastError);
    }
}