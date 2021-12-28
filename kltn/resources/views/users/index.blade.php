@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Quản lý tài khoản</h2>
        </div>
        @can('user-create')
        <div class="float-right">
            <a class="btn btn-success" href="{{ route('users.create') }}">Tạo tài khoản</a>
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
            <th>Họ và tên</th>
            <th>Tên đăng nhập</th>
            <th>Vai trò</th>
            <th>SL đề tài</th>
            <th width="200px">Thao tác</th>
        </tr>
        
        @foreach ($users as $key => $user)
        <tr>
            <td class="align-middle">{{ ++$i }}</td>
            <td class="align-middle">{{ $user->name }}</td>
            <td class="align-middle">{{ $user->username }}</td>
            <td class="align-middle">
                @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                <div class="badge badge-success">{{ $v }}</div>
                @endforeach
                @endif
            </td>
            <td class="text-center align-middle">{{$user->topics_count}}</td>
            <td class="align-middle">
                <a class="btn btn-info" href="{{ route('users.show', $user) }}">Xem</a>
                @can('user-edit')
                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Sửa</a>
                @endcan

                @can('user-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline'])!!}
                {!! Form::submit('Xóa', ['onclick' => 'myFunction', 'class' => 'btn btn-danger confirm']) !!}
                {!! Form::close() !!}
                @endcan
            </td>
        </tr>
        @endforeach
    </table>
</div>

{!! $users->render() !!}
@endsection



