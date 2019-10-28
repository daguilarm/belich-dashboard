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
        'test_text',
        'text_bool',
        'billing_nif',
        'billing_telephone',
        'billing_status',
        'billing_date',
        'billing_year',
        'billing_price',
        'billing_country',
        'billing_user',
        'billing_file',
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
