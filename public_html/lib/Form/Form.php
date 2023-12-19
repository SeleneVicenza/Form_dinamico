<?php

class Form {
    protected string $formConfig;



    public function __construct(string $config) {
        $this->formConfig = $config;
    }

    public function render() {
        return "renderizzare form " . $this->formConfig . "<br>";
    }
}


?>