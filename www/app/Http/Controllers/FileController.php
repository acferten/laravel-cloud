<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function create(FileRequest $request)
    {

        if ($request['folder_id'] == '0') {
            $request['folder_id'] = null;
        }

        foreach ($request->file('files') as $file) {
            //Создание записи в бд
            $newfile = File::create([
                'name' => $file->getClientOriginalName(),
                'folder_id' => $request['folder_id'],
                'author_id' => $request->user()->id
            ]);

            //Сохранение на сервер
            $path = $file->storeAs('public/uploads/', $newfile->id . '.' . $file->extension());

            $response = [
                'success' => true,
                'message' => 'File created',
                'name' => $newfile->name,
                'url' => Storage::url($newfile->id . '.' . $file->extension()), // TODO: Починить ссылки на файлы
                'id' => $newfile->id
            ];
        }
        return response($response, 201);
    }
}
