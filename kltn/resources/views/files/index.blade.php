@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Danh sách tệp tin</h2>
        </div>
        <div class="float-right btn-group">
            <a class="btn btn-primary" href="/researchs/{{$id}}/edit"> Quay lại</a>
        </div>
    </div>
</div>

@php
$f_s = $files->pluck('type', 'id')->countBy()->all();
@endphp
@if (count($f_s) < 4 )
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

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="card text-dark bg-light border-success mb-3 p-3">
    @include('files.items.file', ['id'=>$id, 'type' => 1 ])
</div>
<div class="card text-dark bg-light border-success mb-3 p-3">
    @include('files.items.file', ['id'=>$id, 'type' => 2 ])
</div>
<div class="card text-dark bg-light border-success mb-3 p-3">
    @include('files.items.file', ['id'=>$id, 'type' => 3 ])
</div>
<div class="card text-dark bg-light border-success mb-3 p-3">
    @include('files.items.file', ['id'=>$id, 'type' => 0 ])
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <!-- <button type="submit" class="btn btn-primary">Xác nhận</button> -->
        @if (count($f_s) == 4)
        <a class="btn btn-success" href="{{ route('researchs.index') }}">Đã nộp đề tài</a>
        @else
        <a class="btn btn-primary" id="alert_error">Xác nhận nộp đề tài</a>
        @endif
    </div>
</div>

<script>
$("#alert_error").click(function(){
  alert("Thiếu tệp đính kèm.");
});
</script>

@endsection