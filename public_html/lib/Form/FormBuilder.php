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
        <form action="{$fa['action']}" name="{$fa['name']}" method="{$fa['method']}" novalidate>
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
        $btnText = $this->attribute['submitButtonText'];
        $this->htmlCode .= <<<FORM
        <div>
            <input type="submit" value="$btnText">
        </div>
        </form>
        FORM;
        return $this;

    }

    protected function inputField(string $key, array $value): string {
        $fa = &$value['attribute'];
        //var_dump($this->fields); exit;
        $err = $this->fields[$key]['error'] ?? '';
        return <<<INPUT
        <div>
            $err <br>
            <input type="{$fa['type']}" name="{$fa['name']}" placeholder="{$fa['placeholder']}" value="{$fa['value']}">
        </div>

        INPUT;
    }

}




?>

