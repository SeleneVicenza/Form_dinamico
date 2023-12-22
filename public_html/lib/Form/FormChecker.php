<?php

class FormChecker {

    //protected array $errors = [];
    protected array $data = [];
    protected array $fields;
    protected bool $validated = true;

    public function __construct() {
        $this->data = $_POST;
    }

    public function validate(array &$fields): bool {
        $this->fields = &$fields;
        //var_dump($this->data, $this->fields);
        foreach ($this->fields as $key => $value) {
            foreach ($value['rule'] as $ruleType => $ruleValue) {
                switch ($ruleType) {
                    case 'required':
                        $this->checkRequire($key, $ruleValue);
                        break;
                    case 'email':
                        $this->checkEmail($key, $ruleValue);
                        break;
                    case 'min':
                        $this->checkMin($key, $ruleValue);
                        break;
                }
            }
        }
        return $this->validated;
    }


    protected function checkRequire(string $fieldName, $rule) {
        if(mb_strlen(trim($this->data[$fieldName])) === 0) {
            $this->setError($fieldName, "Campo richiesto");
        }
    }

    protected function checkEmail(string $fieldName, $rule) {
        if (!filter_var($this->data[$fieldName], FILTER_VALIDATE_EMAIL)) {
            $this->setError($fieldName, "Inserire una email valida");
        }
    }

    protected function checkMin(string $fieldName, $rule) {
        if(mb_strlen(trim($this->data[$fieldName])) < $rule) {
            $this->setError($fieldName, "Il campo deve contenere almeno $rule caratteri");
        }
    }

    protected function setError(string $fieldName, string $msg) {
        $this->validated = false;
        $this->fields[$fieldName]['error'] = $msg;
    }
}


?>