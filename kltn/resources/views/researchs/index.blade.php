@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Danh sách đề tài</h2>
        </div>
        <div class="float-right">

            @can('research-create')
            <a class="btn btn-success" href="{{ route('researchs.create') }}"> Tạo mới</a>
            @endcan
            @can('research-report')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#search">
                Tìm kiếm
            </button>
            @endcan
        </div>
    </div>
</div>
@include('researchs.items.list')
@include('researchs.items.search')

@endsection