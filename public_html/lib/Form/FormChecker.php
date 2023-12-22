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
            $this->fields[$key]['attribute']['value'] = $this->data[$key] ;
            foreach ($value['rule'] as $ruleType => $ruleValue) {
                $this->checkField($key, $ruleType, $ruleValue);

            }
        }
        return $this->validated;
    }

    protected function checkField($fieldName, $ruleType, $rule) {
        switch ($ruleType) {
            case 'required':
                if(mb_strlen(trim($this->data[$fieldName])) === 0) {
                    $this->setError($fieldName, "Campo richiesto");
                }
                break;
            case 'email':
                if (!filter_var($this->data[$fieldName], FILTER_VALIDATE_EMAIL)) {
                    $this->setError($fieldName, "Inserire una email valida");
                }
                break;
            case 'min':
                if(mb_strlen(trim($this->data[$fieldName])) < $rule) {
                    $this->setError($fieldName, "Il campo deve contenere almeno $rule caratteri");
                }
                break;
        }
    }

    protected function setError(string $fieldName, string $msg) {
        $this->validated = false;
        $this->fields[$fieldName]['error'] = $msg;
    }
}


?>