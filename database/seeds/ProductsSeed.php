<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Price;

class ProductsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            'pizza' => [
                [
                    'name' => 'Margarita',
                    'description' => "A true classic! Basil seasoned tomato sauce topped with sliced mozzarella.",
                    'prices' => [
                        'dollar' => 10,
                        'euro' => 12
                    ]
                ],
                [
                    'name' => 'Funghi',
                    'description' => "A champignon treat! Sliced mushrooms with slightly peppered tomato sauce and mozzarella.",
                    'prices' => [
                        'dollar' => 12,
                        'euro' => 14.5
                    ]
                ],
                [
                    'name' => 'Spinach and Cheese',
                    'description' => "Sour and sweet, just right for an evening outdoors. Chopped spinach, onions and ricotta all mixed together.",
                    'prices' => [
                        'dollar' => 12,
                        'euro' => 14.5
                    ]
                ],
                [
                    'name' => 'Broccoli and Corn',
                    'description' => 'Light on calories and high on fiber. Broccoli and corn slightly seasoned with black pepper and balsamico.',
                    'prices' => [
                        'dollar' => 12,
                        'euro' => 14.5
                    ]
                ],
                [
                    'name' => 'Zucchini',
                    'description' => "Getting fancy in here. Zucchini slices marinated in lime juice.",
                    'prices' => [
                        'dollar' => 14,
                        'euro' => 16.8
                    ]
                ],
                [
                    'name' => 'Green peas',
                    'description' => "Green peas held together with parmajan cheese.",
                    'prices' => [
                        'dollar' => 14,
                        'euro' => 16.8
                    ]
                ],
                [
                    'name' => 'Black beans',
                    'description' => "A lobio-style topping made of black beans and nuts with spicy red pepper.",
                    'prices' => [
                        'dollar' => 15.5,
                        'euro' => 18.6
                    ]
                ],
                [
                    'name' => 'Mexico',
                    'description' => "Avocado and tomato slices and cacti (!) seasoned with lime juice and a mixture of peppers.",
                    'prices' => [
                        'dollar' => 15.5,
                        'euro' => 18.6
                    ]
                ]
            ],
            'service' => [
                [
                    'name' => 'Delivery',
                    'description' => "",
                    'prices' => [
                        'dollar' => 3,
                        'euro' => 3.6
                    ]
                ]
            ],
            'wrap' => [
                [
                    'name' => 'Guacamole',
                    'description' => "Tomatoes and sweet corn wrapped up with fresh guacamole.",
                    'prices' => [
                        'dollar' => 5,
                        'euro' => 6
                    ]
                ],
                [
                    'name' => 'Hummus',
                    'description' => "Falafel and hummus with some salad in a pita.",
                    'prices' => [
                        'dollar' => 6.5,
                        'euro' => 7.8
                    ]
                ]
            ],
            'drink' => [
                [
                    'name' => 'Borsch',
                    'description' => "Borsch as a drink? What kind of madness is this?!",
                    'prices' => [
                        'dollar' => 4.5,
                        'euro' => 5.4
                    ]
                ]
            ]
        ];

        foreach ($products as $type=>$prods) {
            foreach ($prods as $prod) {

                $product = Product::create([
                    'name' => $prod['name'],
                    'description' => $prod['description'],
                    'type' => $type
                ]);
//            $product->fresh();
                foreach ($prod['prices'] as $cur => $price) {
                    Price::create([
                        'currency' => $cur,
                        'product_id' => $product->id,
                        'value' => $price
                    ]);
                }
            }
        }
    }
}
