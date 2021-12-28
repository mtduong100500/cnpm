@extends('layouts.app')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Đăng ký đề tài</h2>
                </div>          
            </div>
        </div>
        <div class="float-left dp-flex">
            <h3>GVHD: 
                <label class="badge badge-success">{{ $user->name }}</label>
            </h3>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{url('topics-register-list')}}"> Quay lại</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-12 margin-tb">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                        <label for="my-input">Tên đề tài</label>
                        <textarea style="width: 100%;" name="" id="" cols="30" rows="3"  disabled>{{$topic->name}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                        <label for="my-input">Số lượng SV</label>
                        <input id="my-input" class="form-control" type="text" name="" value="{{$topic->number_student}}" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                        <label for="my-input">Ghi chú</label>
                        <input id="my-input" class="form-control" type="text" name="" value="{{$topic->note}}" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                        <label for="my-input">Bộ môn</label>
                        <input id="my-input" class="form-control" type="text" name="" value="{{$topic->department}}" disabled>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                        <label for="my-input">Trạng thái</label>
                        <div class="align-middle">
                            @if($topic->status == '0')                
                                <div class="badge badge-danger">Đã đủ SV</div>                
                            @else
                                <div class="badge badge-success">Có thể đăng ký</div>                
                            @endif
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <label for="my-input">Yêu cầu</label>
                <textarea style="width: 100%;" name="" id="" cols="30" rows="10"  disabled>{{$topic->required}}</textarea>
            </div>
        </div>
        <div class="row" style="margin: 10px;">
            <div class="col-sm-12" style="text-align: center;">
                @if($topic->status == '1')
                    @can('topic-register')
                        <form style="margin: 0;" action="{{url('topics-register')}}" method="post" onsubmit="return confirm('Bạn thực sự muốn đăng ký đề tài: {{$topic->name}}. GVHD: {{$user->name}}?');">
                        @csrf
                            <input type="hidden" name="topic_id" value="{{$topic->id}}">
                            <!-- <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"> </i></button> -->
                            <input class="btn btn-primary" type="submit" value="Xác nhận đăng ký">
                        </form>
                    @endcan  
                @endif 
            </div>
        </div>
    </div>
</div>


@endsection