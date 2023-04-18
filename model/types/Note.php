<?php
require_once(__DIR__ . "/Base.php");

class Note extends Base {
    public $noteId, $userId, $lineNumber, $color, $content;

    public function __construct($sourceObject)
    {
        parent::__construct($sourceObject);
    }
}