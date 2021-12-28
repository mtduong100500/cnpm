@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Danh sách đề tài đạt giải</h2>
        </div>
    </div>
</div>

<form action="/reports/medal/download" method="GET">
    @csrf
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Nhóm lĩnh vực:</strong>
                {!! Form::select('group_id', $groups??[], 0, array('placeholder' => 'Chọn nhóm lĩnh vực...', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Giải:</strong>
                {!! Form::select('medal_id', $medals??[], 0, array('placeholder' => 'Chọn giải...', 'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Tải xuống</button>
            <a class="btn btn-danger" href="/reports/medal/download">Danh sách tổng</a>
        </div>
    </div>
</form>


@endsection