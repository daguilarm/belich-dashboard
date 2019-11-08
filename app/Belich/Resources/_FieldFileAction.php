<?php

namespace App\Belich\Resources;

use Daguilarm\Belich\Core\Resources;
use Daguilarm\Belich\Fields\Types\File;
use Daguilarm\Belich\Fields\Types\ID;
use Illuminate\Http\Request;

class _FieldFileAction extends Resources {

    /** @var string [Model path] */
    public static $model = '\App\Test';

    /** @var array */
    public static $relationships = ['user'];

    /** @var string */
    public static $group = 'Testing';

    /** @var string */
    public static $icon = 'vial';

    /** @var string */
    public static $label = 'Field File Action';

    /** @var string */
    public static $pluralLabel = 'Fields File Action';

    /**
     * Build the query for the given resource.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function indexQuery() {
        return $this->model();
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public function fields(Request $request): array
    {
        return [
            Id::make('ID', 'id')
                ->sortable(),
            File::make('File url', 'test_file')
                ->storeName('test_file_name')
                ->storeMime('test_file_mime')
                ->storeSize('test_file_size'),
            File::make('Testing disk', 'test_name')
                ->id('store_disk')
                ->disabled(),
            File::make('Testing disk and store name', 'test_name')
                ->id('store_name')
                ->disabled()
                ->storeName('test_store_name'),
            File::make('Testing disk, store name and mime', 'test_name')
                ->id('store_name_mime')
                ->disabled()
                ->storeMime('test_file_mime')
                ->storeName('test_store_name_and_mime'),
            File::make('Testing disk, store name, mime and size', 'test_name')
                ->id('store_name_mime_size')
                ->disabled()
                ->storeMime('test_file_mime')
                ->storeSize('test_file_size')
                ->storeName('test_store_name_and_mime_and_size'),
        ];
    }

    /**
     * Set the custom metric cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function metrics(Request $request): array
    {
        return [];
    }

    /**
     * Set the custom cards
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Collection
     */
    public static function cards(Request $request): array
    {
        return [];
    }
}
