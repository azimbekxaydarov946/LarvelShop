<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $products = Category::query();
        if ($request->pagination) {
            $products = $products->limit($request->pagination);
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

    public function store(CategoryStoreRequest $request)
    {
        $category = $request->validated();
        $category = Category::create($category);

        if ($category) {
            return response()->json([
                'success' => true,
                'data' => $category,
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

    public function update(CategoryUpdateRequest $request, Category $category)
    {

        if ($category) {

            $params = $request->validated();

            $category->update($params);

            return response()->json([
                'success' => true,
                'data' => $category,
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

    public function show(Category $category)
    {

        if ($category) {

            return response()->json([
                'success' => true,
                'data' => $category,
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

    public function destroy(Category $category)
    {

        if ($category) {

            $category->delete();

            return response()->json([
                'success' => true,
                'data' => $category,
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
