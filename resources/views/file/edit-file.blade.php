@extends('layouts.simple.master')
@section('title', 'Edit File Table')

@section('css')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>Edit File</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('file.update', ['file' => $model->id])}}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Name Uz</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='name_uz' value='{{$model->name_uz}}' placeholder='Name Uz'>
                                            @error('name_uz')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Name Ru</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='name_ru' value='{{$model->name_ru}}' placeholder='Name Ru'>
                                            @error('name_ru')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Name En</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='name_en' value='{{$model->name_en}}' placeholder='Name En'>
                                            @error('name_en')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Excerpt Uz</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='excerpt_uz' value='{{$model->excerpt_uz}}' placeholder='Excerpt Uz'>
                                            @error('excerpt_uz')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Excerpt Ru</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='excerpt_ru' value='{{$model->excerpt_ru}}' placeholder='Excerpt Ru'>
                                            @error('excerpt_ru')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Excerpt En</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='excerpt_en' value='{{$model->excerpt_en}}' placeholder='Excerpt En'>
                                            @error('excerpt_en')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Keywords</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='keywords' value='{{$model->keywords}}' placeholder='Keywords'>
                                            @error('keywords')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class='mb-3 row'>
                                        <div class='col-3'></div>
                                        <div class='col-sm-7'>
                                                <input class='form-control' name='url' type='file'>
                                                @error('url')
                                                <p class='text-danger'>{{$message}}</p>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Object</label>
                                        <div class='col-2'>
                                            <img src='{{$model->image}}' width='100' alt=''>
                                        </div>
                                    </div>
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Image</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' name='image' type='file'>
                                            @error('image')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <a class="btn btn-secondary" href="{{route('file.index')}}">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
