<?php

namespace App\Http\Controllers;

use App\Models\FileJoinSubject;
use Illuminate\Http\Request;

class FileJoinSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = FileJoinSubject::orderByDesc('id')->get();

        return view('file_join_subject.file_join_subject', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('file_join_subject.add-file_join_subject');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'file_id' => 'required|integer',
			'subject_id' => 'required|integer'
        ]);

        $file_join_subject = new FileJoinSubject();
        $file_join_subject->file_id = $request->file_id;
		$file_join_subject->subject_id = $request->subject_id;
        $file_join_subject->save();

        return redirect()->route('file_join_subject.index')->with(['message' => "FileJoinSubject create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file_join_subject = FileJoinSubject::find($id);
        return view('file_join_subject.delete-file_join_subject', ['id' => $id, 'model' => $file_join_subject]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $file_join_subject = FileJoinSubject::find($id);
        if(!$file_join_subject){
            abort(404);
        }
        return view('file_join_subject.edit-file_join_subject', ['model' => $file_join_subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'file_id' => 'required|integer',
			'subject_id' => 'required|integer'
        ]);

        $file_join_subject = FileJoinSubject::find($id);
        if (!$file_join_subject) {
            abort(404);
        }
        $file_join_subject->file_id = $request->file_id;
		$file_join_subject->subject_id = $request->subject_id;
        $file_join_subject->update();

        return redirect()->route('file_join_subject.index')->with(['message' => "FileJoinSubject update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file_join_subject = FileJoinSubject::find($id);
        if(!$file_join_subject){
            abort(404);
        }
        
        $file_join_subject->delete();

        return redirect()->route('file_join_subject.index')->with(['message' => 'FileJoinSubject delete successfully']);
    }
}
