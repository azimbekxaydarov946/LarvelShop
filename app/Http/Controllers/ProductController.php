<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   protected $storeRequestClass=ProductStoreRequest::class;
   protected $updateRequestClass=ProductUpdateRequest::class;
   public function __construct()
   {
     $this->model=new Product;
   }

   public function index()
   {
       $item = $this->model::get();
       return $item;
   }

   public function store()
   {
       $item = $this->create();
       return $item;
   }

   public function show($id)
   {
       $item = $this->find($id);
       return $item;
   }

   public function update($id)
   {
       $item = $this->find($id);
       $this->edit($item);
       return $item;
   }

   public function destroy($id)
   {
       return $this->delete($id);
   }
}
