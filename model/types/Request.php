<?php

class Request {
    public $id, $other_id, $data, $param;

    public function __construct($data = null, int $id = null, int $other_id = null, string $param = null) {
        $this->id = $id;
        $this->other_id = $other_id;
        $this->data = $data;
        $this->param = $param;
    }
}