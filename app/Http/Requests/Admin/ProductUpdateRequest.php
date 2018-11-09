<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\IsCategory;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','between:2,10','unique:products,name,'.$this->id],
            'product_img' => ['required','url'],
            'category' => ['required','integer',new IsCategory],
            'description' => ['required'],
            'skus.new1' => ['required','array'],
            'skus.new1.name' => ['required','between:2,10'],
            'skus.new1.skuImg' => ['required','url'],
            'skus.new1.description' => ['required','between:2,10'],
            'skus.new1.stock' => ['required','integer','min:1'],
            'skus.new2' => ['required','array'],
            'skus.new2.name' => ['required','between:2,10'],
            'skus.new2.skuImg' => ['required','url'],
            'skus.new2.description' => ['required','between:2,10'],
            'skus.new2.stock' => ['required','integer','min:1'],

        ];
    }

    public function attributes()
    {
        return [
            'name' => '商品名',
            'product_img' => '商品照片',
            'category' => '分类',
            'description' => '商品描述',
            'skus' => '商品SKU',
        ];
    }

    public function messages()
    {
        return [
            'product_img.url' => '商品图片不符合规则',
            'product_img.required'=>'商品照片必须存在',
            'product_img.url.required'=>'商品照片必须符合规则',
            'category.integer' => '分类参数不符合规则',
            'skus.new1.name.required' => '必须存在一个sku名',
            'skus.new1.stock.integer' => '库存必须选择整型',
            'skus.new1.stock.min' => '库存最小为一个',
            'skus.new1.skuImg.required' => '必须存在一个sku图片',
            'skus.new1.description.required' => '必须存在一个sku描述',
            'skus.new1.stock.required' => '必须存在一个sku库存',
            'skus.new2.name.required' => 'SKU2名称必须存在',
            'skus.new2.stock.integer' => 'SKU2库存必须选择整型',
            'skus.new2.stock.min' => 'SKU2库存最小为一个',
            'skus.new2.skuImg.required' => 'SKU2必须存在一个图片',
            'skus.new2.description.required' => 'SKU2必须存在一个描述',
            'skus.new2.stock.required' => 'SKU2必须存在一个库存',
        ];
    }
}
