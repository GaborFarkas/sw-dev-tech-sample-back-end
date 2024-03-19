<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class TestController extends Controller
{
    public function test()
    {
        $userObj = new stdClass();
        $userObj->email = 'test@gmail.com';
        $userObj->fname = 'John';
        $userObj->lname = 'Doe';
        $userObj->phone = '+123456789';

        return response()->json($userObj);
    }
}
