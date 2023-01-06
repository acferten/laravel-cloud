<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function create(Request $request)
    {
        $folder = Folder::create(['name' => $request['name'], 'folder_id' => $request['folder_id']]);

        $response = [
            'id' => $folder->id,
            'message' => 'Folder created',
            'folder_id' => $folder->folder_id
        ];

        return response($response, 201);
    }
}
