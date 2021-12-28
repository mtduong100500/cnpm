@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Bằng khen Trung ương đoàn</h2>
        </div>
    </div>
</div>

<form action="/reports/TWD/download" method="GET">
    <!-- @csrf -->
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <!-- <strong>Giải:</strong> -->
                {!! Form::select('medal_id', $medals??[], 4, array('required', 'placeholder' => 'Chọn giải...', 'class' => 'form-control', 'id'=>'medal-id')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 text-center">
            <!-- <button type="submit" class="btn btn-primary" name='download' value="true">Tải xuống</button> -->
            <button type="submit" class="btn btn-primary">In bằng khen</button>
            <!-- <button type="button" onclick="print(1)" class="btn btn-primary">In chứng nhận</button> -->
            <button type="button" onclick="print(2)" class="btn btn-primary">In danh sách</button>
            <!-- <a class="btn btn-danger" href="/reports/certificate/download">Danh sách tổng</a> -->
        </div>
    </div>
</form>

<script>
    function print(p) {
        id = $("#medal-id").val();
        if (id) {
            $("<iframe class='printpage'>")
                .hide()
                .attr("src", `/reports/TWD/download?medal_id=${id}&print=${p}`)
                .appendTo("body");
        } else {
            alert('Bạn chưa chọn giải.')
        }
    }
</script>

@endsection