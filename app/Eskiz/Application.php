<?php

namespace App\Eskiz;
use App\Eskiz\Response;
class Application
{
    public  function run()
    {
        $response = new Response();
        $code = $response->getCode();
        return response()->json(['code' => $code]);
    }

}
