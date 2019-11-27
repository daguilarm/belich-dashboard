<?php

namespace App\Belich\Components\MyField;

use Daguilarm\Belich\Contracts\CrudContract;
use Daguilarm\Belich\Fields\Types\CustomField;

class MyField extends CustomField implements CrudContract
{
    /**
     * Resolve value for index
     *
     * @param  object $field
     * @param  object $data
     *
     * @return string|null
     */
    public function index(object $field, ?object $data = null): ?string
    {
        return view()->exists('index')
            ? view('index', compact('field', 'data'))
            : null;
    }

    /**
     * Resolve value for create
     *
     * @param  object $data
     *
     * @return string|null
     */
    public function create(object $field, ?object $data = null): ?string
    {
        return view()->exists('create')
            ? view('create', compact('field', 'data'))
            : null;
    }

    /**
     * Resolve value for edit
     *
     * @param  object $data
     *
     * @return string|null
     */
    public function edit(object $field, ?object $data = null): ?string
    {
        return view()->exists('edit')
            ? view('edit', compact('field', 'data'))
            : null;
    }

    /**
     * Resolve value for show
     *
     * @param  object $field
     * @param  object|null $data
     *
     * @return object
     */
    public function show(object $field, ?object $data = null): ?string
    {
        return view()->exists('show')
            ? view('show', compact('field', 'data'))
            : null;
    }
}
