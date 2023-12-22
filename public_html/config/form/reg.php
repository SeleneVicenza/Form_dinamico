<?php

$fields = [
    'nome' => [
        'attribute' => [
            'type' => 'text',
            'name' => 'nome',
            'value' => '',
            'placeholder' => 'Nome *',
        ],
        'rule' => [
            'required' => true,
            'min' => 2
        ]
    ],
    'email' => [
        'attribute' => [
            'type' => 'email',
            'name' => 'email',
            'value' => '',
            'placeholder' => 'Email *'
        ],
        'rule' => [
            'required' => true,
            'email' => true
        ]
    ]
];

$formData = [
    'formAttribute' => [
        'name' => 'reg',
        'action' => 'index.php',
        'method' => 'post',
        'submitButtonText' => 'Registrati'
    ],
    'fields' => $fields,

];

return $formData;
?>
