@extends('layouts.simple.master')
@section('title', 'Programmer UZ')


@section('style')
@endsection

@section('breadcrumb-title')
    <h3>File</h3>
@endsection

@section('breadcrumb-items')
    <div class="py-3">
        <div class="justify-content-between row mx-2">
            <a  href="{{route('file.create')}}" class="btn btn-success font-weight-bold"><i class="fa fa-plus"></i></a>
        </div>
    </div>
@endsection

@section('content')
    @if(session()->has('message'))
        <div class="alert {{session('error') ? 'alert-danger' : 'alert-success'}}">
            {{ session('message') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>File</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
								<th scope='col'>Name Uz</th>
								<th scope='col'>Name Ru</th>
								<th scope='col'>Name En</th>
								<th scope='col'>Excerpt Uz</th>
								<th scope='col'>Excerpt Ru</th>
								<th scope='col'>Excerpt En</th>
								<th scope='col'>Keywords</th>
								<th scope='col'>Url</th>
								<th scope='col'>Image</th>
								<th scope='col'>User Id</th>
								<th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($models as $model)
                            <tr>
                                <td>{{$model->id}}</td>
								<td>{{$model->name_uz}}</td>
								<td>{{$model->name_ru}}</td>
								<td>{{$model->name_en}}</td>
								<td>{{$model->excerpt_uz}}</td>
								<td>{{$model->excerpt_ru}}</td>
								<td>{{$model->excerpt_en}}</td>
								<td>{{$model->keywords}}</td>
								<td><img src='{{$model->url}}' width='100' alt=''></td>
								<td>{{$model->image}}</td>
								<td>{{$model->user_id}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('file.edit', ['file' => $model->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('file.show', ['file' => $model->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
