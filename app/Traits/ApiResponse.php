<?php
namespace App\Traits;

trait ApiResponse{
    protected function response  ($status,$msg,$data=null){
        $response=[
            'status'=>$status,
            'msg'=>$msg, 
            'data'=>$data
            
          ];
          return  $response;
    }
}