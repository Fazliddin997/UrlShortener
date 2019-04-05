@extends('layouts.app')

@section('content')
    <div class="container">
        {{--@if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
        @endif--}}

        <div class="row">
            <a href="{{url('/create/url')}}" class="btn btn-success">Create Url</a>
            <a href="{{url('/urls')}}" class="btn btn-default">All Urls</a>
        </div>
    </div>
@endsection
