<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Servies\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   protected $serviceClass=ProductService::class;
   protected $storeRequestClass=ProductStoreRequest::class;
   protected $updateRequestClass=ProductUpdateRequest::class;
}
