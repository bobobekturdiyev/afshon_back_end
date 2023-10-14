<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileJoinSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'file_id',
        'subject_id',
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function lang($data){
        return $data .'_'. app()->getLocale();
    }
}
