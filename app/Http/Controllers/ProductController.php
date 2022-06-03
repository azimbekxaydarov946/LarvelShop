<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $request=request();
        $page = request('page') ?? 1;
        $rows = request('rows') ?? 100000;



        $products = Product::query()->with('category');
        if ($request->pagination) {
            $products = $products->paginate($rows, ['*'], 'page name', $page);
        }
        if ($request->active) {
            $products = $products->where('active', 'like', '%' . $request->active . '%');
        } else {
            $products = $products->where('active', true);
        }
        $products = $products->get();
        if ($products) {
            return response()->successJson($products);
        } else {
            return response()->errorJson(500,"error");
        }
    }

    public function store(ProductStoreRequest $request)
    {
        $product = $request->validated();
        $product = Product::create($product);

        if ($product) {
            return response()->successJson($product);
        } else {
            return response()->errorJson(500,"error");
        }
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {

        if ($product) {

            $params = $request->validated();

            $product->update($params);

            return response()->successJson($product);
        } else {
            return response()->errorJson(500,"error");
        }
    }

    public function show(Product $product)
    {

        if ($product) {
            return response()->successJson($product);
        } else {
            return response()->errorJson(500,"error");
        }
    }

    public function destroy(Product $product)
    {

        if ($product) {

            $product->delete();
            return response()->successJson($product, 402);
        } else {
            return response()->errorJson(500,"error");
        }
    }
}
