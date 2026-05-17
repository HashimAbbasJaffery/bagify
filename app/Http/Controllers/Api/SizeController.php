<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SizeResource;
use App\Models\Size;

class SizeController extends Controller
{
    public function get(){
        $sizes = Size::all();
        return SizeResource::collection($sizes);
    }
}
