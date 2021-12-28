@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Danh sách tỉnh</h2>
        </div>
        <div class="float-right">
            @can('province-create')
            <a class="btn btn-success" href="{{ route('provinces.create') }}"> Tạo mới</a>
            @endcan
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
        <tr>
            <th>Mã tỉnh</th>
            <th>Tên</th>
            <th  width="200px">Số lượng đề tài</th>
            <th width="200px">Thao tác</th>
        </tr>
        @foreach ($provinces as $province)
        <tr>
            <td class="align-middle">{{ $province->id }}</td>
            <td class="align-middle">{{ $province->name }}</td>
            <td class="align-middle">{{ $province->researchs_count }}</td>
            <td>
                <form action="{{ route('provinces.destroy',$province->id) }}" method="POST" class="mb-0 btn-group">
                    <a class="btn btn-info" href="{{ route('provinces.show',$province->id) }}">Xem</a>
                    @can('province-edit')
                    <a class="btn btn-primary" href="{{ route('provinces.edit',$province->id) }}">Sửa</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('province-delete')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

{!! $provinces->links() !!}

@endsection