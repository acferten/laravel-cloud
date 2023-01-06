<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function create(Request $request)
    {

        return response('Что-то создано2', 201);
    }
}
