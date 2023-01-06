<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function create(Request $request)
    {
        return response('Файл создан', 201);
    }
}
