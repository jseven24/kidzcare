<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class TestApiController extends Controller
{
    public function index()
    {
        //return response()->json(Child::get(), 200);
        return ['success' => true];
    }
}
