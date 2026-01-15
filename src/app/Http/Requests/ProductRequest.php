<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["nullable", "string", "max:255"],
            "in_stock" => ["nullable", "boolean"],
            "category_id" => ["nullable", "integer", "exists:categories,id"],
            "price_from" => [
                'nullable',
                'numeric',
                'gte:0',
                Rule::when(
                    $this->price_to !== null && is_numeric($this->price_to),
                    ['lte:' . $this->price_to]
                ),
            ],
            "price_to" => ["nullable", "numeric", "gte:0"],
            "rating" => ["nullable", "numeric", "gte:0"],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'название',
            'in_stock' => 'в наличии',
            'category_id' => 'категория',
            'price_from' => 'минимальная цена',
            'price_to' => 'максимальная цена',
            'rating' => 'рейтинг',
        ];
    }

    public function messages(): array
    {
        return [
            // name
            'name.string' => 'Название должно быть строкой.',
            'name.max' => 'Название не должно превышать :max символов.',

            // in_stock
            'in_stock.boolean' => 'Поле "в наличии" должно быть логическим значением (1/0).',

            // category_id
            'category_id.integer' => 'Категория должна быть целым числом.',
            'category_id.exists' => 'Выбранная категория не существует.',

            // price_from
            'price_from.numeric' => 'Минимальная цена должна быть числом.',
            'price_from.gte' => 'Минимальная цена не может быть меньше 0.',
            'price_from.lte' => 'Минимальная цена не может быть больше максимальной цены.',

            // price_to
            'price_to.numeric' => 'Максимальная цена должна быть числом.',
            'price_to.gte' => 'Максимальная цена не может быть меньше 0.',

            // rating
            'rating.numeric' => 'Рейтинг должен быть числом.',
            'rating.gte' => 'Рейтинг не может быть меньше 0.',
        ];
    }
}
