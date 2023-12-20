<?php

class FormChecker {

    protected array $errors = [];
    protected array $data = [];
    protected array $fields;
    protected bool $validated = false;

    public function __construct() {
        $this->data = $_POST;
    }

    public function validate(array &$fields) {
        $this->fields = &$fields;
        return $this->validated;
    }
}


?>