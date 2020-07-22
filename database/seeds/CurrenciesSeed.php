<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrenciesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cur = ['$' => 'Dollar', '€' => 'Euro'];
        foreach ($cur as $symbol=>$name) {
            $slug = strtolower($name);
            $there = Currency::where(['slug' => $slug])->first();
            if (empty($there)) {
                Currency::create([
                    'name' => $name,
                    'slug' => $slug,
                    'symbol' => $symbol
                ]);
            }
        }
    }
}
