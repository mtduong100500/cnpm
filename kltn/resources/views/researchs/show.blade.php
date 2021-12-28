@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Đề tài
                @include('researchs.items.status')
            </h2>
        </div>
        <div class="float-right btn-group">
            @can('research-edit')
            <a class="btn btn-danger" href="{{ route('researchs.edit', $research->id) }}"> Chỉnh sửa</a>
            @endcan
            @can ('file-edit')
            @if($research->group_id)
            <a class="btn btn-info" href="{{ route('groups.show', $research->group_id) }}"> Quay lại</a>
            @endif
            @else
            <a class="btn btn-info" href="{{ route('researchs.index') }}"> Quay lại</a>
            @endcan
        </div>
    </div>
</div>
@if($research->status == 0)
@php
$f_s = $files->pluck('type', 'id')->countBy()->all();
@endphp
<div class="alert alert-danger">
    <strong>Thiếu các tệp tin sau:</strong>
    <ul class="mb-0">
        @if (!($f_s['1']??0))
        <li>Tóm tắt đề tài</li>
        @endif
        @if (!($f_s['2']??0))
        <li>Phụ lục I</li>
        @endif
        @if (!($f_s['3']??0))
        <li>Phụ lục II</li>
        @endif
        @if (!($f_s['0']??0))
        <li>Thiếu ảnh</li>
        @endif
    </ul>
</div>
@endif
<form class="mb-0">
    <fieldset disabled>
        @include('researchs.form', compact('research', 'fields', 'fieldsEn', 'provinces', 'schools'))
    </fieldset>
</form>
@include('files.items.files', ['id'=>$research->id, 'files'=>$files ])
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <!-- <button type="submit" class="btn btn-primary">Xác nhận</button> -->
        @if ($research->status == 0 || $research->status == 3)
        <a class="btn btn-primary" id="alert_error">Xác nhận nộp đề tài</a>
        @else
        @can ('file-edit')
        @if($research->group_id)
        <a class="btn btn-success" href="{{ route('groups.show', $research->group_id) }}">HOÀN THÀNH PHÊ DUYỆT</a>
        @endif
        @else
        <a class="btn btn-success" href="{{ route('researchs.index') }}">Đã nộp đề tài</a>
        @endcan
        @endif
    </div>
</div>
<script>
    $("#alert_error").click(function() {
        alert("Thiếu tệp đính kèm.");
    });
</script>
@endsection