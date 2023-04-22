<?php
require_once(__DIR__ . "/Base.php");

class Message extends Base {
    public $messageId, $senderId, $recipientId, $text, $timestamp;

    public function __construct($sourceObject)
    {
        parent::__construct($sourceObject);
    }
}