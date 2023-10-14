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
                                <h5>Add File Join Subject</h5>
                            </div>
                            <div class="card-body">
                                <form class="form theme-form" action="{{route('file_join_subject.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label' for="file">File</label>
                                        <div class='col-sm-9'>
                                            <select name="file_id" id="file" class="form-control">
                                                <option value disabled selected>Select this one</option>
                                                @foreach($files as $file)
                                                    <option value="{{$file->id}}">{{$file->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('file_id')
                                            <p class='text-danger'>{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class='mb-3 row'>
                                        <label class='col-sm-3 col-form-label'>Subject</label>
                                        <div class='col-sm-9'>
                                            <select name="subject_id" id="file" class="form-control" required>
                                                <option value disabled selected>Select this one</option>
                                                @foreach($subjects as $subject)
                                                    <option value="{{$subject->id}}">{{$subject->title}}</option>
                                                @endforeach
                                            </select>
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
