@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h3> Lĩnh vực: {{ $field->name }}</h3>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('fields.index') }}"> Quay lại</a>
        </div>
    </div>
</div>


@include('researchs.items.list')
@endsection