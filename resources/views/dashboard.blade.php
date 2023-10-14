@extends('layouts.simple.master')

@section('title', 'Programmer UZ')

@section('style')

@endsection

@section('breadcrumb-title')

    <h3>Dashboard</h3>

@endsection

@section('breadcrumb-items')

@endsection

@section('content')
    <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('user.index')}}">
                        <h4>User</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('subject.index')}}">
                        <h4>Subject</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('file.index')}}">
                        <h4>File</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class='col-3 p-3'>
            <div class='card'>
                <div class='card-body'>
                    <a href="{{route('file_join_subject.index')}}">
                        <h4>FileJoinSubject</h4>
                    </a>
                </div>
            </div>
        </div>
        <!-- ADD_ITEM -->
@endsection
@section('script')
@endsection
