<?php
require_once(__DIR__ . "/Base.php");

class Note extends Base {
    public $noteId, $userId, $title, $content, $timestamp;

    public function __construct($sourceObject)
    {
        parent::__construct($sourceObject);
    }
}