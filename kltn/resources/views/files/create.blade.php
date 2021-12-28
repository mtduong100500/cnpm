@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Tải tệp tin</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('researchs.edit', $id) }}">Quay lại</a>
        </div>
    </div>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="row justify-content-md-center">
    <div class="col-xs-12 col-sm-12 col-md-8">
        @include('files.form')
    </div>
</div>

@endsection