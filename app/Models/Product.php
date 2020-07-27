<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'type'];

    protected $appends = ['img'];

    public function type_obj()
    {
        return $this->belongsTo('App\Models\Type', 'type', 'slug');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Price', 'product_id', 'id');
    }

    public function getImgAttribute()
    {
        return '/images/' . $this->name . '.png';
    }
}