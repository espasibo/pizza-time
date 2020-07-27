<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order extends Model
{

    protected $fillable = ['products', 'address', 'user_id', 'total', 'currency'];

    protected $appends = ['products_full'];

    protected $casts = [
        'products' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function currencyObj()
    {
        return $this->hasOne('App\Models\Currency', 'slug', 'currency');
    }

    public function getProductsFullAttribute() {

        $cur = $this->currency;
        $prods = Product::with(['prices' => function ($q) use ($cur) {
            $q->where('currency', '=', $cur);
        }])->whereIn('id', $this->products)->get()->toArray();
        $quant = array_count_values($this->products);
        foreach ($prods as $i=>$prod) {
            $prods[$i]['quantity'] = $quant[$prod['id']];
        }
        return $prods;
    }
}