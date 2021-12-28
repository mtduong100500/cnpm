@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Chỉnh sửa đề tài
                @include('researchs.items.status')
            </h2>
        </div>
        <div class="float-right">
            @if ($research['id'])
            @can('file-list')
            <a class="btn btn-success" href="/files?research_id={{ $research['id'] }}">Danh sách tệp đính kèm</a>
            @endcan
            @endif
            <a class="btn btn-primary" href="{{ route('researchs.index') }}"> Quay lại</a>
        </div>
    </div>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <strong>Lỗi!</strong> Xảy ra lỗi nhập dữ liệu.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('researchs.update',$research->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('researchs.form', compact('research', 'fields', 'fieldsEn', 'provinces', 'schools'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            @if ($research['id'])
            @can('file-list')
            <a class="btn btn-success" href="/files?research_id={{ $research['id'] }}">Danh sách tệp đính kèm</a>
            @endcan
            @endif
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </div>
    </div>
</form>

@endsection