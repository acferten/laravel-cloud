<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function create(ApiRequest $request)
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
            'parent_id' => $folder->parent_id
        ];

        return response($response, 201);
    }

    public function list(ApiRequest $request)
    {
        $folders = Folder::where(['author_id' => $request->user()->id, 'parent_id' => null])->get();
        foreach ($folders as $folder) {
            $response[] = [
                'type' => 'folder',
                'folder_id' => $folder->id,
                'name' => $folder->name,
                'url' => 'ссылка', // TODO: Написать ссылку (папка)
                'accesses' => $folder->coauthor_id
            ];
        }
        $files = File::where(['author_id' => $request->user()->id, 'folder_id' => null])->get();
        foreach ($files as $file) {
            $response[] = [
                'type' => 'file',
                'file_id' => $file->id,
                'name' => $file->name,
                'url' => 'ссылка', // TODO: Написать ссылку (файл)
            ];
        }
        return response($response, 201);
    }

    public function delete($id)
    {
        return Folder::destroy($id);
    }
}
