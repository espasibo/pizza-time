<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Type;

class ProductsController extends Controller
{

    public function get_menu()
    {

        $prods = Product::select('products.*')
            ->with('type_obj')->with('prices')
            ->get();

        $result = [];

        foreach ($prods as $prod) {

            if (empty($result[$prod->type_obj->slug])) {
                $result[$prod->type_obj->slug] = [$prod];
            } else {
                $result[$prod->type_obj->slug][] = $prod;
            }
        }

        return response()->json($result);
    }

    public function get_service() {

        $prod = Product::with('prices')
            ->where(['type' => 'service'])->first();

        return response()->json($prod);
    }

    public function get_types()
    {

        $types = Type::where('slug', '<>', 'service')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json($types);
    }
}