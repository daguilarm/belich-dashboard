<?php

namespace \App\Belich\Components\MyField;

use Daguilarm\Belich\Fields\Types\CustomField;

class MyField extends CustomField
{
    /**
     * Init custom field
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke()
    {
        ddd($this->view);
        return $this->view;
    }
}
