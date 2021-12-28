@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Quản lý đề tài</h2>
        </div>
        @can('topic-create')
        <div class="float-right">
            <a class="btn btn-success" href="{{ route('users.create') }}">Tạo đề tài</a>
        </div>
        @endcan
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr>
            <th>STT</th>
            <th>Tên đề tài</th>
            <th>Bộ môn</th>
            <th>Số lượng SV</th>
            <th>Ghi chú</th>
            <th>GVHD</th>
            <th>Trạng thái</th>
            <th width="200px">Thao tác</th>
        </tr>
        
        @foreach ($topics as $key => $topic)
        <tr>
            <td class="align-middle">{{ ++$i }}</td>
            <td class="align-middle">{{ $topic->name }}</td>
            <td class="align-middle">{{ $topic->department }}</td>
            <td class="align-middle">{{ $topic->number_student }}</td>
            <td class="align-middle">{{ $topic->note }}</td>
            <td class="align-middle">{{ $topic->instructor_name }}</td>
            <td class="align-middle">
                @if($topic->status == '0')                
                    <div class="badge badge-danger">Đã đủ SV</div>                
                @else
                    <div class="badge badge-success">Có thể đăng ký</div>                
                @endif
            </td>
            
        </tr>
        @endforeach
    </table>
</div>

{!! $topics->render() !!}
@endsection