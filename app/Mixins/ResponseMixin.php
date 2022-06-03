<?php


namespace App\Mixins;


class ResponseMixin {

public function successJson(){

    return function($data,$code=200){
        return [
            'success' => true,
            'data' => $data,
            'code' => $code,
            'msg' => "ok"
        ];
    };
}

public function errorJson(){

    return function($msg, $code=500){
        return [
            'success' => true,
            'data' => [],
            'code' => $code,
            'msg' => $msg
        ];
    };
}


}
