<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lang = app()->getLocale();
        $models = Subject::select('id', "title_$lang as title")->orderByDesc('id')->get();

        return view('subject.subject', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subject.add-subject');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title_uz' => 'required|string|max:255',
			'title_ru' => 'required|string|max:255',
			'title_en' => 'required|string|max:255',
        ]);

        $subject = new Subject();
        $subject->title_uz = $request->title_uz;
		$subject->title_ru = $request->title_ru;
		$subject->title_en = $request->title_en;
		$subject->type = 'aniq';
        $subject->save();

        return redirect()->route('subject.index')->with(['message' => "Subject create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::find($id);
        return view('subject.delete-subject', ['id' => $id, 'model' => $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::find($id);
        if(!$subject){
            abort(404);
        }
        return view('subject.edit-subject', ['model' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title_uz' => 'required|string|max:255',
			'title_ru' => 'required|string|max:255',
			'title_en' => 'required|string|max:255',
        ]);

        $subject = Subject::find($id);
        if (!$subject) {
            abort(404);
        }
        $subject->title_uz = $request->title_uz;
		$subject->title_ru = $request->title_ru;
		$subject->title_en = $request->title_en;
        $subject->update();

        return redirect()->route('subject.index')->with(['message' => "Subject update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::find($id);
        if(!$subject){
            abort(404);
        }

        $subject->delete();

        return redirect()->route('subject.index')->with(['message' => 'Subject delete successfully']);
    }
}
