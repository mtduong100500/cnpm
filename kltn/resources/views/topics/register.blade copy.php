@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Đăng ký đề tài</h2>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr class="table-info">
            <th>STT</th>
            <th>Tên đề tài</th>
            <th width="100px">Bộ môn</th>
            <!-- <th>Số lượng SV</th>
            <th>Ghi chú</th> -->
            <th width="250px">GVHD</th>
            <th>Trạng thái</th>
            <th width="100px">Thao tác</th>
        </tr>
        
        @foreach ($topics as $key => $topic)
        <tr>
            <td class="text-align-center">{{ ++$i }}</td>
            @if($topic->status == '1')
                <td class="align-middle"><a href="{{ route('topic-register-confirm', ['topic_id' => $topic->id]) }}" rel="noopener noreferrer">{{ $topic->name }}</a></td>
            @else
                <td class="align-middle"><a rel="noopener noreferrer">{{ $topic->name }}</a></td>   
            @endif 
            
            <td class="text-align-center">{{ $topic->department }}</td>
            <td class="align-middle">{{ $topic->instructor_name }}</td>
            <td class="align-middle">
                @if($topic->status == '1')
                <div class="badge badge-success">Có thể đăng ký</div>   
                @else
                <div class="badge badge-danger">Đã đủ SV</div>   
                @endif               
            </td>
            <td class="align-middle" style="text-align: center;">
                @if($topic->status == '1')
                    @can('topic-register')
                        <a href="{{ route('topic-register-confirm', ['topic_id' => $topic->id]) }}" class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i></a>
                    @endcan  
                @else
                    <input type="hidden" name="topic_id" value="{{$topic->id}}">
                    <button class="btn btn-primary" disabled><i class="fa fa-check-square-o"></i></button>
                @endif
                
            </td>
        </tr>
        @endforeach
    </table>
</div>

{!! $topics->render() !!}
@endsection