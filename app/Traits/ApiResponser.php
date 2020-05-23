<?php
/**
 * Created by PhpStorm.
 * User: Sin
 * Date: 1/4/2020
 * Time: 12:07 μμ
 */
namespace App\Traits;
use Illuminate\Http\Response;

trait ApiResponser {

    /**
     * Returns the payload of a successful response
     * @param $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK){
        return response()->json(['data'=>$data],$code);
    }

    /**
     * Returns the payload of an error response
     * @param $data
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($data,$code){
        return response()->json(['data'=>$data,'code'=>$code],$code);
    }
}
