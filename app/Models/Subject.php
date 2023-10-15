<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [

        'id',
        'title_uz',
        'title_ru',
        'title_en',
        'image',
        'type',
    ];

    public function lang($data)
    {
        return $data . '_' . app()->getLocale();
    }

    public function files()
    {
        return $this->hasManyThrough(
            File::class,
            FileJoinSubject::class,
            'subject_id',
            'id',
            'id',
            'file_id'
        );
    }

    public function views()
    {
        try {
        $student = auth('student')->user();
        if(!$student){
            return 0;
        }
        return $this->files()->join('view_files', 'view_files.file_id', 'file_join_subjects.file_id')
            ->where('view_files.student_id', $student->id)->get()->count();
        }catch (\Exception $exception){
            return 0;
        }

    }
}
