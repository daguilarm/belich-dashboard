<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
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
        'user_id',
        'billing_address',
        'billing_name',
        'billing_nif',
        'billing_telephone',
        'billing_status',
        'billing_date',
        'billing_year',
        'billing_price',
        'billing_country',
        'billing_user',
    ];
}
