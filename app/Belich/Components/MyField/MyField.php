<?php

declare(strict_types=1);

namespace App\Belich\Components\MyField;

use Daguilarm\Belich\Contracts\CustomFieldContract;
use Daguilarm\Belich\Fields\Types\CustomField;

class MyField extends CustomField implements CustomFieldContract
{
    /**
     * Resolve value for index
     */
    public function index(object $field, ?object $data = null): ?object
    {
        return view()->exists('index')
            ? view('index', compact('field', 'data'))
            : null;
    }

    /**
     * Resolve value for create
     */
    public function create(object $field, ?object $data = null): ?object
    {
        return view()->exists('create')
            ? view('create', compact('field', 'data'))
            : null;
    }

    /**
     * Resolve value for edit
     */
    public function edit(object $field, ?object $data = null): ?object
    {
        return view()->exists('edit')
            ? view('edit', compact('field', 'data'))
            : null;
    }

    /**
     * Resolve value for show
     */
    public function show(object $field, ?object $data = null): ?object
    {
        return view()->exists('show')
            ? view('show', compact('field', 'data'))
            : null;
    }
}
