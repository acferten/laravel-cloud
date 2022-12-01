<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function create(Request $request)
    {
        if ($request['parent_id'] == '0') {
            $request['parent_id'] = null;
        }

        $folder = Folder::create([
            'name' => $request['name'],
            'parent_id' => $request['parent_id'],
            'author_id' => $request->user()->id
        ]);

        $response = [
            'id' => $folder->id,
            'message' => 'Folder created',
            'parent_id' => $folder->folder_id
        ];

        return response($response, 201);
    }
}
