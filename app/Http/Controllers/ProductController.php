<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
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
            return response()->json([
                'success' => true,
                'data' => $products,
                'msg' => "ok"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => [],
                'msg' => "Error"
            ]);
        }
    }

    public function store(ProductStoreRequest $request)
    {
        $product = $request->validated();
        $product = Product::create($product);

        if ($product) {
            return response()->json([
                'success' => true,
                'data' => $product,
                'msg' => "Muvaffaqiyatliy saqlandi"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => [],
                'msg' => "Error"
            ]);
        }
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {

        if ($product) {

            $params = $request->validated();

            $product->update($params);

            return response()->json([
                'success' => true,
                'data' => $product,
                'msg' => "Muvaffaqiyatliy yangilandi"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => [],
                'msg' => "Error"
            ]);
        }
    }

    public function show(Product $product)
    {

        if ($product) {

            return response()->json([
                'success' => true,
                'data' => $product,
                'msg' => "Muvaffaqiyatliy topildi"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => [],
                'msg' => "Error"
            ]);
        }
    }

    public function destroy(Product $product)
    {

        if ($product) {

            $product->delete();

            return response()->json([
                'success' => true,
                'data' => $product,
                'msg' => "Muvaffaqiyatliy o'chrildi"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => [],
                'msg' => "Error"
            ]);
        }
    }
}
