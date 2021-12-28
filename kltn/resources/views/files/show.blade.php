@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>{{ $file->name }}</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('files.index') }}"> Trờ về</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên:</strong>
                {{ $file->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $file->detail }}
            </div>
        </div>
    </div>
@endsection
