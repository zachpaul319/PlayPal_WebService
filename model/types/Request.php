<?php

class Request {
    public $id, $id2, $id3, $data, $param;

    public function __construct($data = null, int $id = null, int $id2 = null, int $id3 = null, string $param = null) {
        $this->id = $id;
        $this->id2 = $id2;
        $this->id3 = $id3;
        $this->data = $data;
        $this->param = $param;
    }
}