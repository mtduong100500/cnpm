@extends('layouts.app')
@php
$titles = ['Ảnh đại diện', 'TÓM TẮT ĐỀ TÀI', 'PHỤ LỤC I', 'PHỤ LỤC II'];
$status = ['Chưa xét duyệt', 'Đạt', 'Chưa đạt'];
@endphp

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h3>Phê duyệt tệp đính kèm: <k class="text-blue">{{$titles[$file->type]}}</k>
            </h3>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="/researchs/{{$id}}"> Quay lại</a>
        </div>
    </div>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <strong>Có lỗi xảy ra!</strong> <br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form action="{{ route('files.update',['file'=>$file->id, 'id'=>$id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Tên tệp:</strong>
                <input disabled type="text" name="name" value="{{ $file->filename }}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Loại tệp:</strong>
                <input disabled type="text" name="name" value="{{ $titles[$file->type] }}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="mr-3">Phê duyệt:</strong>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" {{ (($file->status??1)==1?'checked':'') }} value="1">{{$status[1]}}
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" {{ (($file->status??1)==2?'checked':'') }} value="2">{{$status[2]}}
                    </label>
                </div>
                {!! Form::textarea('comment', $file->comment??'', array('rows' => 2, 'style' => 'resize:none','placeholder' => 'Nêu rõ lý do nếu không được','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <iframe src="{{route('files.show', $file->id)}}" width="100%" height='800px'>Your browser isn't compatible</iframe>
    </div>
</div>

@endsection