<?php
require_once(__DIR__ . "/Base.php");

class Message extends Base {
    public $messageId, $conversationId, $dateSent, $content;

    public function __construct($sourceObject)
    {
        parent::__construct($sourceObject);
    }
}