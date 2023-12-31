@extends('layouts.simple.master')
@section('title', 'Add File Join Subject Table')

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
                                <h5>Delete File Join Subject</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('file_join_subject.destroy',['file_join_subject' => $id])}}" method="POST" enctype="multipart/form-data">
                                    @method('delete')
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>File</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='file_id' value='{{$model->file->name_uz}}' placeholder='File Id'>
                                            @error('file_id')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Subject</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control' disabled  type='text' name='subject_id' value='{{$model->subject->title_en}}' placeholder='Subject Id'>
                                            @error('subject_id')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                            <a class="btn btn-primary" href="{{route('file_join_subject.index')}}">Cancel</a>
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
