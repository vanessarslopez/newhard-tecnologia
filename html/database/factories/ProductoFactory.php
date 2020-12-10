<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'rubro_id' => $this->faker->rubro_id,
            //'SKU' => $this->faker->SKU->unique(),
            'nombre' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'imagen' => $this->faker->image,
            //'precio' => $this->faker->number,
           // 'disponibilidad' => $this->faker->number,
        ];
    }
}
