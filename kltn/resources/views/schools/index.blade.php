@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Danh sách trường</h2>
        </div>
        <div class="float-right">
            @can('school-create')
            <a class="btn btn-success" href="{{ route('schools.create') }}"> Tạo mới</a>
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
            <th>Mã trường</th>
            <th>Tên</th>
            <th>Cấp</th>
            <th>Tỉnh/Thành phố</th>
            <th>Thao tác</th>
        </tr>
        @foreach ($schools as $school)
        <tr>
            <td class="align-middle">{{ $school->key }}</td>
            <td class="align-middle">{{ $school->name }}</td>
            <td class="align-middle">{{ $school->level }}</td>
            <td class="align-middle">{{ $provinces[$school->province_id] }}</td>
            <td>
                <form action="{{ route('schools.destroy',$school->key) }}" method="POST" class="mb-0 btn-group">
                    <a class="btn btn-info" href="{{ route('schools.show',$school->key) }}">Xem</a>
                    @can('school-edit')
                    <a class="btn btn-primary" href="{{ route('schools.edit',$school->key) }}">Sửa</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('school-delete')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>



{!! $schools->render() !!}



@endsection