<?php

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Pizza', 'Wrap', 'Drink', 'Service'];
        foreach ($types as $type) {
            $slug = strtolower($type);
            $there = Type::where(['slug' => $slug])->first();
            if (empty($there)) {
                Type::create([
                    'name' => $type,
                    'slug' => $slug
                ]);
            }
        }
    }
}
