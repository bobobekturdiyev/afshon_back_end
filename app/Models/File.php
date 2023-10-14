<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [

	'id',
	'name_uz',
	'name_ru',
	'name_en',
	'excerpt_uz',
	'excerpt_ru',
	'excerpt_en',
	'keywords',
	'url',
	'image',
	'user_id',
    ];

    public function lang($data){
        return $data .'_'. app()->getLocale();
    }
}
