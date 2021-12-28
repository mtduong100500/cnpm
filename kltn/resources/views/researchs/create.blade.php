@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Tạo đề tài</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('researchs.index') }}">Quay lại</a>
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


<form action="{{ route('researchs.store') }}" method="POST">
    @csrf
    @include('researchs.form')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
            <a class="btn btn-primary" href="{{ route('researchs.index') }}">Quay lại</a>
        </div>
    </div>
</form>

@endsection