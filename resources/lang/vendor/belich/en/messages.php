<?php

return [
    'crud' => [
        'success' => [
            'title' => 'Congrats!',
            'text'  => 'The resource has been successfully :action.'
        ],
        'fail' => [
            'title' => 'Error detected..',
            'text'  => [
                'An error occurred during the :action process, and the operation can not be carried out successfully.',
                'If the error persists, please contact the system administrator: :email',
            ],
        ],
    ],
    'delete' => [
        'selected' => [
            'title'    => 'Delete selection',
            'confirm'  => 'Are you sure you want to delete all the selected fields?',
        ],
    ],
    'options' => [
        'success' => 'Your setting configuration has been stored!',
        'fail' => [
            'class' => 'The Class :value does not exist',
        ],
    ],
    'resources' => [
        'no_results' => 'No results found for the resource' . ': ' . ':resource.',
    ],
];
