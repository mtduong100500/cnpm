@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Phiếu chấm</h2>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Nhóm lĩnh vực:</strong>
            {!! Form::select('group_id', $groups??[], 0, array('placeholder' => 'Chọn nhóm lĩnh vực...', 'class' => 'form-control', 'id'=>'group-id')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Vòng thi:</strong>
            {!! Form::select('round', ['1'=>1, '2'=>2], 0, array('placeholder' => 'Chọn vòng thi...', 'class' => 'form-control', 'id'=>'round')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button onclick="print()" class="btn btn-primary">In danh sách</button>
        <!-- <a class="btn btn-danger" href="/reports/certificate/download">Danh sách tổng</a> -->
    </div>
</div>

<script>
    function print() {
        id = $("#group-id").val();
        round = $("#round").val();

        $("<iframe class='printpage'>")
            .hide()
            .attr("src", `/prints/examiners/preview?id=${id}&round=${round}`)
            .appendTo("body");
    }
</script>

@endsection