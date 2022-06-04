<?php


namespace App\Mixins;


class ResponseMixin {

public function successJson(){

    return function($data,$code=200, $msg="OK"){
        return [
            'message' =>$code,
            'data' => $data,
            'msg' => $msg
        ];
    };
}

public function errorJson(){

    return function($code=500, $msg="ERROR"){
        return [
            'message' =>$code,
            'data' => [],
            'msg' => $msg
        ];
    };
}


}
