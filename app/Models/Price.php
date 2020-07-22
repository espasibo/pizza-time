<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{

    public $timestamps = false;

    protected $fillable = ['value', 'product_id', 'currency'];

    public function currencyObj()
    {
        return $this->belongsTo('App\Models\Currency', 'currency', 'slug');
    }
}