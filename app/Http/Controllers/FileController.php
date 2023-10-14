<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lang = app()->getLocale();

        $models = File::select("name_$lang as name", "excerpt_$lang as excerpt","id","keywords","image")->orderByDesc('id')->get();

        return view('file.file', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('file.add-file');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name_uz' => 'required|string|max:255',
			'name_ru' => 'required|string|max:255',
			'name_en' => 'required|string|max:255',
			'excerpt_uz' => 'required|string|max:255',
			'excerpt_ru' => 'required|string|max:255',
			'excerpt_en' => 'required|string|max:255',
			'keywords' => 'required|string|max:255',
			'url' => 'required',
			'image' => 'required|mimes:jpg,png,jpeg',
        ]);

        $model = new File();
        $model->name_uz = $request->name_uz;
        $model->name_ru = $request->name_ru;
        $model->name_en = $request->name_en;
        $model->excerpt_uz = $request->excerpt_uz;
        $model->excerpt_ru = $request->excerpt_ru;
        $model->excerpt_en = $request->excerpt_en;
        $model->keywords = $request->keywords;
		if ($request->hasFile("url")) {
            $file = $request->file("url");
            $filename = time(). "_" . $file->getClientOriginalName();
            $file->move("uploads/files", $filename);
            $model->url = asset("uploads/files/$filename");
        }
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $filename = time(). "_" . $file->getClientOriginalName();
            $file->move("uploads/files", $filename);
            $model->image = asset("uploads/files/$filename");
        }
        $model->user_id = User::first()->id;
        $model->save();

        return redirect()->route('file.index')->with(['message' => "File create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file = File::find($id);
        return view('file.delete-file', ['id' => $id, 'model' => $file]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $file = File::find($id);
        if(!$file){
            abort(404);
        }
        return view('file.edit-file', ['model' => $file]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name_uz' => 'required|string|max:255',
			'name_ru' => 'required|string|max:255',
			'name_en' => 'required|string|max:255',
			'excerpt_uz' => 'required|string|max:255',
			'excerpt_ru' => 'required|string|max:255',
			'excerpt_en' => 'required|string|max:255',
			'keywords' => 'required|string|max:255',
        ]);

        $model = File::find($id);
        if (!$model) {
            abort(404);
        }
        $model->name_uz = $request->name_uz;
        $model->name_ru = $request->name_ru;
        $model->name_en = $request->name_en;
        $model->excerpt_uz = $request->excerpt_uz;
        $model->excerpt_ru = $request->excerpt_ru;
        $model->excerpt_en = $request->excerpt_en;
        $model->keywords = $request->keywords;
		if ($request->hasFile("url")) {
            $file = $request->file("url");
            $filename = time(). "_" . $file->getClientOriginalName();
            if ($model->url) {
                $oldFilePath = 'uploads/files/'.basename($model->url);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/files", $filename);
            $model->url = asset("uploads/files/$filename");
        }
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $filename = time(). "_" . $file->getClientOriginalName();
            if ($file->image) {
                $oldFilePath = 'uploads/files/'.basename($file->image);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/files", $filename);
            $model->image = asset("uploads/files/$filename");
        }
        $model->update();
        return redirect()->route('file.index')->with(['message' => "File update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = File::find($id);
        if(!$file){
            abort(404);
        }
        if ($file->url) {
            $oldFilePath = 'uploads/files/'.basename($file->url);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        $file->delete();

        return redirect()->route('file.index')->with(['message' => 'File delete successfully']);
    }
}
