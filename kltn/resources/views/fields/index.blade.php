@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Danh sách lĩnh vực</h2>
        </div>
        <div class="float-right">
            @can('field-create')
            <a class="btn btn-success" href="{{ route('fields.create') }}"> Tạo mới</a>
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
        <th>Name</th>
        <th>SL đề tài</th>
        <th width="200px">Thao tác</th>
    </tr>
    @foreach ($fields as $field)
    <tr>
        <td class="align-middle">{{ $field->id }}</td>
        <td class="align-middle">{{ $field->name }}</td>
        <td class="align-middle">{{ $field->nameEn }}</td>
        <td class="align-middle text-center">{{ $field->researchs_count }}</td>
        <td class="align-middle">
            <form action="{{ route('fields.destroy',$field->id) }}" method="POST" class="mb-0 btn-group">
                <a class="btn btn-info" href="{{ route('fields.show',$field->id) }}">Xem</a>
                @can('field-edit')
                <a class="btn btn-primary" href="{{ route('fields.edit',$field->id) }}">Sửa</a>
                @endcan


                @csrf
                @method('DELETE')
                @can('field-delete')
                <button type="submit" class="btn btn-danger">Xóa</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
</table>


{!! $fields->links() !!}



@endsection