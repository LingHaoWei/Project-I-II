<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;

class HelperController extends Controller
{
    function index(){
        Helper::test('Ling');
    }
}
