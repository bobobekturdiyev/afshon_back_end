<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = File::orderByDesc('id')->get();

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
			'url' => 'required|mimes:255',
			'image' => 'required|string|max:255',
			'user_id' => 'required|integer'
        ]);

        $file = new File();
        $file->name_uz = $request->name_uz;
		$file->name_ru = $request->name_ru;
		$file->name_en = $request->name_en;
		$file->excerpt_uz = $request->excerpt_uz;
		$file->excerpt_ru = $request->excerpt_ru;
		$file->excerpt_en = $request->excerpt_en;
		$file->keywords = $request->keywords;
		if ($request->hasFile("url")) {
            $file = $request->file("url");
            $filename = time(). "_" . $file->getClientOriginalName();
            if ($file->url) {
                $oldFilePath = 'uploads/url/'.basename($file->url);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/url", $filename);
            $file->url = asset("uploads/url/$filename");
        }
		$file->image = $request->image;
		$file->user_id = $request->user_id;
        $file->save();

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
			'url' => 'required|mimes:255',
			'image' => 'required|string|max:255',
			'user_id' => 'required|integer'
        ]);

        $file = File::find($id);
        if (!$file) {
            abort(404);
        }
        $file->name_uz = $request->name_uz;
		$file->name_ru = $request->name_ru;
		$file->name_en = $request->name_en;
		$file->excerpt_uz = $request->excerpt_uz;
		$file->excerpt_ru = $request->excerpt_ru;
		$file->excerpt_en = $request->excerpt_en;
		$file->keywords = $request->keywords;
		if ($request->hasFile("url")) {
            $file = $request->file("url");
            $filename = time(). "_" . $file->getClientOriginalName();
            if ($file->url) {
                $oldFilePath = 'uploads/url/'.basename($file->url);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/url", $filename);
            $file->url = asset("uploads/url/$filename");
        }
		$file->image = $request->image;
		$file->user_id = $request->user_id;
        $file->update();

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
            $oldFilePath = 'uploads/url/'.basename($file->url);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        $file->delete();

        return redirect()->route('file.index')->with(['message' => 'File delete successfully']);
    }
}
