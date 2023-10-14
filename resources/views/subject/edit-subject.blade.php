@extends('layouts.simple.master')
@section('title', 'Edit Subject Table')

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
                                <h5>Edit Subject</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('subject.update', ['subject' => $model->id])}}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Title Uz</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='title_uz' value='{{$model->title_uz}}' placeholder='Title Uz'>
                                            @error('title_uz')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Title Ru</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='title_ru' value='{{$model->title_ru}}' placeholder='Title Ru'>
                                            @error('title_ru')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Title En</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='title_en' value='{{$model->title_en}}' placeholder='Title En'>
                                            @error('title_en')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Type</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='type' value='{{$model->type}}' placeholder='Type'>
                                            @error('type')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <a class="btn btn-secondary" href="{{route('subject.index')}}">Cancel</a>
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
