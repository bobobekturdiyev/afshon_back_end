@extends('layouts.simple.master')
@section('title', 'Edit FileJoinSubject Table')

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
                                <h5>Edit FileJoinSubject</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('file_join_subject.update', ['file_join_subject' => $model->id])}}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>File Id</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='file_id' value='{{$model->file_id}}' placeholder='File Id'>
                                            @error('file_id')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
									<div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Subject Id</label>
                                        <div class='col-sm-9'>
                                            <input class='form-control'  type='text' name='subject_id' value='{{$model->subject_id}}' placeholder='Subject Id'>
                                            @error('subject_id')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <a class="btn btn-secondary" href="{{route('file_join_subject.index')}}">Cancel</a>
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
