@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Danh sách giải</h2>
        </div>
        <div class="float-right">
            @can('medal-create')
            <a class="btn btn-success" href="{{ route('medals.create') }}"> Tạo mới</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
    <tr>
        <th>Mã</th>
        <th>Tên</th>
        <th>Số lượng</th>
        <th class="fit">Thao tác</th>
    </tr>
    @foreach ($medals as $medal)
    <tr>
        <td class="align-middle">{{ $medal->id }}</td>
        <td class="align-middle">{{ $medal->name }}</td>
        <td class="align-middle text-center">{{ $medal->researchs_count }}</td>
        <td class="align-middle fit">
            <form action="{{ route('medals.destroy',$medal->id) }}" method="POST" class="mb-0 btn-group">
                <a class="btn btn-info" href="{{ route('medals.show',$medal->id) }}">Xem</a>
                @can('medal-edit')
                <a class="btn btn-primary" href="{{ route('medals.edit',$medal->id) }}">Sửa</a>
                @endcan


                @csrf
                @method('DELETE')
                @can('medal-delete')
                <button type="submit" class="btn btn-danger">Xóa</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
</table>


{!! $medals->links() !!}


<style>
    .table td.fit,
    .table th.fit {
        white-space: nowrap;
        width: 1%;
    }

    .table td.fit a {
        white-space: nowrap;
    }
</style>
@endsection