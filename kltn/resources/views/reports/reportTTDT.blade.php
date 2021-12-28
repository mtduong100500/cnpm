@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Phiếu xác nhận thông tin đăng ký dự thi</h2>
        </div>
    </div>
</div>

<form action="/reports/TTDT/download" method="GET">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Đơn vị dự thi:</strong>
                {!! Form::select('user_id', $users??[], 0, array('placeholder' => 'Chọn đơn vị dự thi...', 'class' => 'form-control', (($user->role??1)>2)?'disabled':'')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Tải xuống</button>
            <a class="btn btn-danger" href="/reports/TTDT/download">Danh sách tổng</a>
        </div>
    </div>
</form>


@endsection