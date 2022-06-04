<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Servies\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $serviceClass=CategoryService::class;
    protected $storeRequestClass=CategoryStoreRequest::class;
    protected $updateRequestClass=CategoryUpdateRequest::class;
}
