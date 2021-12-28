@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Xếp giám khảo</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('groups.index') }}">Quay lại</a>
        </div>
    </div>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="/groups/{{ $group->id.'/setup' }}" method="GET">
    <input type="hidden" value="{{$round}}" name="round">
    <div class="card text-dark bg-light border-danger p-3 mb-3">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group mb-0 required">
                    <strong>Mã nhóm lĩnh vực:</strong>
                    {!! Form::text('key', $group->key??'', array( 'disabled', 'placeholder' => 'Nhập mã nhóm lĩnh vực','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="form-group mb-0 required">
                    <strong>Tên nhóm lĩnh vực:</strong>
                    {!! Form::text('name', $group->name??'', array( 'disabled', 'placeholder' => 'Nhập tên nhóm lĩnh vực','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-group mb-0 required">
                    <strong>Số lượng giám khảo:</strong>
                    {!! Form::text('examiner_total', ($group->examiner_total< 5)?5:$group->examiner_total, array( 'placeholder' => 'Nhập số lượng giám khảo','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 text-center">
                <button type="submit" class="btn btn-primary mt-4">Xếp giám khảo</button>
            </div>
        </div>
    </div>
</form>
<div class="text-center">
    <a class="btn btn-{{ ($round??1)==1?'primary':'' }}" href="{{ '/groups/'.$group->id .'/setup?round=1' }}">Vòng 1</a>
    <a class="btn btn-{{ ($round??1)==2?'primary':'' }}" href="{{ '/groups/'.$group->id .'/setup?round=2' }}">Vòng 2</a>

</div>

@if(count($examiners)>=5)
@include('examiners.listExaminers', compact('examiners'))
@endif
@endsection

<style>
    .table td.fit,
    .table th.fit {
        white-space: nowrap;
        width: 1%;
    }
</style>