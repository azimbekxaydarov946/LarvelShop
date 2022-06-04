<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $model;
    protected $storeRequestClass;
    protected $updateRequestClass;

    public function index()
    {
        return $this->model->index();
    }

    public function find($id)
    {
        $item = $this->model->find($id);
        return $item;
    }

    public function create()
    {
        $request = app($this->storeRequestClass);
        $data = $request->validated();
        $item = $this->model->create($data);

        return response()->successJson($item);
    }
    public function edit($id)
    {
        $request = app($this->updateRequestClass);
        $data = $request->validated();
        $item = $id->update($data);

        return response()->successJson($item);
    }
    public function delete($id)
    {
        $id = $this->find($id);
        $id=$id->delete();

        return response()->successJson($id,422);
    }
}
