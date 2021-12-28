@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h3> Nhóm lĩnh vực: {{ $group->name }}</h3>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('groups.index') }}"> Quay lại</a>
        </div>
    </div>
</div>


@include('researchs.items.list')
@endsection