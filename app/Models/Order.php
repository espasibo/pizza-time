<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Order extends Model
{
    use HasJsonRelationships;

    public $timestamps = false;

    protected $fillable = ['products', 'address', 'user_id'];

    protected $appends = ['total'];

    protected $casts = [
        'products' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function productsFull()
    {
        return $this->hasManyJson('App\Models\Product', 'products', 'id');
    }

    public function getTotalAttribute()
    {
        $total = [];
        foreach ($this->productsFull as $product) {
            foreach ($product->prices as $price) {
                if (empty($total[$price->currency->slug])) {
                    $total[$price->currency->slug] = $price->value;
                } else {
                    $total[$price->currency->slug] += $price->value;
                }
            }
        }
        return $total;
    }
}