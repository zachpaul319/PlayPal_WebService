<?php
require_once(__DIR__ . "/Base.php");

class Conversation extends Base {
    public $conversationId, $userId, $contactId;

    public function __construct($sourceObject)
    {
        parent::__construct($sourceObject);
    }
}