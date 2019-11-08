<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'test_string',
        'test_language',
        'test_name',
        'test_lastname',
        'test_email',
        'test_telephone',
        'test_zip',
        'test_country',
        'test_file',
        'test_file_mime',
        'test_file_name',
        'test_file_size',
        'test_mask',
        'test_html',
        'test_creditcard_type',
        'test_creditcard',
        'test_creditcard_expiration',
        'test_creditcard_json',
        'test_json',
        'test_address',
        'test_description',
        'test_enum',
        'test_decimal',
        'lat_test_coordenate',
        'lng_test_coordenate',
        'test_integer',
        'test_number',
        'test_ip',
        'test_boolean',
        'test_date',
        'test_year',
        'test_point',
        'test_polygon',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->BelongsTo(\App\User::class);
    }
}
