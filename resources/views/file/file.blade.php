@extends('layouts.simple.master')
@section('title', 'Afshon')


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
								<th scope='col'>Name</th>
								<th scope='col'>Excerpt</th>
								<th scope='col'>Keywords</th>
								<th scope='col'>Image</th>
								<th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($models as $model)
                            <tr>
                                <td>{{$model->id}}</td>
								<td>{{$model->name}}</td>
								<td>{{$model->excerpt}}</td>
								<td>{{$model->keywords}}</td>
								<td><img src='{{$model->image}}' width='100' alt=''></td>
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
