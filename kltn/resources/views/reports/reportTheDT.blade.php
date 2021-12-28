@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>In thẻ dự thi</h2>
        </div>
    </div>
</div>

<form action="/reports/pdfTheDT" method="GET">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Đơn vị dự thi:</strong>
                {!! Form::select('user_id', $users??[], 0, array('placeholder' => 'Chọn đơn vị dự thi...', 'class' => 'form-control', (($user->role??1)>2)?'disabled':'')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Lĩnh vực:</strong>
                {!! Form::select('field_id', $fields??[], 0, array('placeholder' => 'Chọn lĩnh vực...', 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Nhóm lĩnh vực:</strong>
                {!! Form::select('group_id', $groups??[], 0, array('placeholder' => 'Chọn nhóm lĩnh vực...', 'class' => 'form-control')) !!}
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
            <a class="btn btn-primary" href="/reports">Quay lại</a>
        </div>
    </div>
</form>


@endsection