@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Danh sách nhóm lĩnh vực</h2>
        </div>
        <div class="float-right">
            @can('group-create')
            <a class="btn btn-success" href="{{ route('groups.create') }}"> Tạo mới</a>
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
        <th>Mã nhóm</th>
        <th>Tên nhóm</th>
        <th>CV phụ trách</th>
        <th>SL đề tài</th>
        <th class="fit">Thao tác</th>
    </tr>
    @foreach ($groups as $group)
    <tr>
        <td class="align-middle">{{ $group->key }}</td>
        <td class="align-middle">{{ $group->name }}</td>
        <td class="align-middle">{{ $group->user->name??'' }}</td>
        @php
        $total = 0;
        foreach ($group->fields as $field)
        $total += count($field->researchs);
        @endphp
        <td class="align-middle text-center">{{ $total }}</td>
        @if($type==1)
        <td class="align-middle fit">
            <a class="btn btn-warning" href="{{ route('groups.show',$group->id) }}">Phê duyệt</a>
        </td>
        @endif

        @if($type==3)
        <td class="align-middle fit">
            <a class="btn btn-warning" href="{{ 'medal-award/'.$group->id.'?round=1' }}">Vòng 1</a>
            <a class="btn btn-warning" href="{{ 'medal-award/'.$group->id.'?round=2' }}">Vòng 2</a>
            <a class="btn btn-success" href="{{ 'medal-award/'.$group->id }}">Xếp giải</a>
        </td>
        @endif

        @if($type==2)
        <td class="align-middle fit">
            @can('examiner-setup')
            <a class="btn btn-success" href="{{ '/groups/'.$group->id .'/setup' }}">Xếp giám khảo</a>
            @endcan
            @can('group-edit')
            <a class="btn btn-primary" href="{{ route('groups.edit',$group->id) }}">Xếp lĩnh vực</a>
            @endcan
        </td>
        @endif

        @if(!$type)
        <td class="align-middle fit">
            <form action="{{ route('groups.destroy',$group->id) }}" method="POST" class="mb-0 btn-group">
                <a class="btn btn-warning" href="{{ route('groups.show',$group->id) }}">Phê duyệt</a>
                @can('examiner-setup')
                <a class="btn btn-success" href="{{ '/groups/'.$group->id .'/setup' }}">Xếp giám khảo</a>
                @endcan
                @can('group-edit')
                <a class="btn btn-primary" href="{{ route('groups.edit',$group->id) }}">Sửa</a>
                @endcan
                @csrf
                @method('DELETE')
                @can('group-delete')
                <button type="submit" class="btn btn-danger">Xóa</button>
                @endcan
            </form>
        </td>
        @endif
    </tr>
    @endforeach
</table>


{!! $groups->links() !!}



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