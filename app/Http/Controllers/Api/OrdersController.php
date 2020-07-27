<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Price;
use App\Models\Order;
use App\User;

class OrdersController extends Controller
{

    public function save(OrderRequest $request)
    {

        $data = $request->validated();

        $cookie = null;
        $user_id = $request->cookie('user_id', null);
        if (!empty($user_id)) {
            \Auth::loginUsingId($user_id);
        }

        $user = \Auth::user();

        if (empty($user)) {
            $user = User::create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'email' => $data['email'],
                'password' => \Hash::make($data['password']),
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
            $user->fresh();
            $cookie = cookie('user_id', $user->id, 0, null, null, null, false);
        }

        $currency = $data['currency'];
        $products = $data['products'];
        $total = 0;
        $quant = array_count_values($data['products']);
        $prices = Price::selectRaw('prices.*, products.type')
            ->join('products', 'products.id', '=', 'prices.product_id')
            ->where(['currency' => $currency])
            ->where(function ($q) use ($products) {
                $q->whereIn('products.id', $products)
                    ->orWhere(['products.type' => 'service']);
            })
            ->get();
        foreach ($prices as $price) {
            $mult = $price->type == 'service' ? 1 : $quant[$price->product_id];
            $total += ($price->value * 100) * $mult;
        }
        $total /= 100;

        Order::create([
            'user_id' => $user->id,
            'currency' => $data['currency'],
            'address' => $data['address'],
            'products' => $data['products'],
            'total' => $total
        ]);

        $response = response()->json(['success' => true]);
        if (!empty($cookie)) {
            $response->withCookie($cookie);
        }
        return $response;
    }

    public function orders_list(Request $request) {

        $user_id = $request->cookie('user_id', null);
        if (empty($user_id))
            abort(401);
        \Auth::loginUsingId($user_id);
        if (!\Auth::check())
            abort(401);

        $orders = Order::with('currencyObj')->where(['user_id' => $user_id])->get();

        return response()->json($orders);
    }

    public function user(Request $request) {

        $user_id = $request->cookie('user_id', null);
        if (empty($user_id))
            abort(401);
        \Auth::loginUsingId($user_id);
        $user = \Auth::user();
        if (empty($user))
            abort(401);
        return response()->json($user);
    }
}