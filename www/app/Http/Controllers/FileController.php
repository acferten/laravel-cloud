<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'folder_id' => 'required',
            'files'=>'required',
        ]);


        if ($request['folder_id'] == '0') {
            $request['folder_id'] = null;
        }
        $response = [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $newfile = File::create([
                    'name' => $file->getClientOriginalName(),
                    'folder_id' => $request['folder_id'],
                ]);
                $path = $file->storeAs(
                    'uploads', $newfile->id
                );
                $response = [
                    'id' => $newfile->id,
                    'message' => 'Folder created',
                    'parent_id' => $newfile->folder_id
                ];
            }
        }


        return response([$response, dd($request->allFiles())], 201);
    }
}
