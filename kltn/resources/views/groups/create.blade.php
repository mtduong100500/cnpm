@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Tạo nhóm lĩnh vực</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('groups.index') }}">Quay lại</a>
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


<form action="{{ route('groups.store') }}" method="POST">
    @csrf
    @include('groups.form')
</form>



@endsection