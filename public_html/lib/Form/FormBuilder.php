<?php

class FormBuilder {
    protected array $attribute;
    protected array $fields;
    protected string $htmlCode = "";

    public function build(array $attribute, array $fields): string {
        $this->attribute = $attribute;
        $this->fields = $fields;

        $this->startForm()->buildFields()->endForm();

        return $this->htmlCode;
    }

    protected function startForm(): FormBuilder {
        $fa = $this->attribute;
        //var_dump($fa);
        $this->htmlCode .= <<<FORM
        %result%
        <form action="{$fa['action']}" name="{$fa['name']}" method="{$fa['method']}">
        FORM;
        return $this;
    }

    protected function buildFields(): FormBuilder {
        foreach ($this->fields as $key => $value) {
            switch ($value['attribute']['type']) {
                case 'text':
                case 'email':
                case 'password':
                    $this->htmlCode .= $this->inputField($key, $value);
                    break;
                default:
                    break;
            }
        }
        return $this;

    }

    protected function endForm(): FormBuilder {
        $this->htmlCode .= <<<FORM
        <div>
            <input type="submit" value="Invia form">
        </div>
        </form>
        FORM;
        return $this;

    }

    protected function inputField(string $key, array $value): string {
        $fa = &$value['attribute'];
        return <<<INPUT
        <div>
            <input type="{$fa['type']}" name="{$fa['name']}" placeholder="{$fa['placeholder']}" value="{$fa['value']}">
        </div>

        INPUT;
    }

}




?>

