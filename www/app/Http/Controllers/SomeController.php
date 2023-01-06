<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class SomeController extends Controller
{
    public function create(Request $request)
    {

        return response('Что-то создано', 201);
    }
}
