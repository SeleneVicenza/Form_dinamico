<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);



class Form {
    protected string $formConfig;
    protected array $formAttribute = [];
    protected array $fields = [];
    protected string $statusMsg = '';
    protected FormBuilder $builder;
    protected FormChecker $checker;

    /* public function __construct(string $config, FormBuider $builder, FormCheker $formChecker) {
        $this->formConfig = $config;
        $this->builder = $builder;
        $this->checker = $checker;
        $this->builder = new FormBuilder();
        $this->checker = new FormChecker();
        $this->init();
    }
 */

public function __construct(string $config) {
    $this->formConfig = $config;
    /* $this->builder = $builder;
    $this->checker = $checker; */
    $this->builder = new FormBuilder();
    $this->checker = new FormChecker();
    $this->init()->checkSubmit();
}

    private function init() : Form {
        $configArray = require $this->formConfig;

        $this->formAttribute = $configArray['formAttribute'];
        $this->fields = is_array($configArray['fields']) ? $configArray['fields'] : [];


        return $this;
    }

    private function checkSubmit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //echo "FORM INVIATO <br>";
            $this->handleSubmit();
        }else {
            echo "Compilare i campi e premere invio <br>";
        }
    }

    private function handleSubmit() {
        //FormChecker
        if ($this->checker->validate($this->fields)) {
            $this->cleanField();
            $this->statusMsg = "Form inviato <br>";
        }
    }

    public function render(): string {
        //FormBuilder
        $form = $this->builder->build($this->formAttribute, $this->fields);
        return str_replace("%result%", $this->statusMsg, $form);
    }


    private function cleanField(): void {
        foreach ($this->fields as &$fields) {
            $fields['attribute']['value'] = '';
        }
    }
}





?>