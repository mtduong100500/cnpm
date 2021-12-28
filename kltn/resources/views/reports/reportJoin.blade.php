@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Giấy chứng nhận tham gia cuộc thi</h2>
        </div>
    </div>
</div>

<form action="/reports/join" method="GET">
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <tr>
                <th>Mã</th>
                <th>Đơn vị dự thi</th>
                <th>Số lượng đề tài</th>
                <th class="fit">Thao tác</th>
            </tr>
            @foreach ($users as $key => $u)
            <tr>
                <td>{{$u->id}}</td>
                <td class="text-left">{{$u->name}}</td>
                <td>{{$u->researchs_count}}</td>
                <td>
                    @if(!is_array($cs[$u->id]??''))
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="input[{{$u->id}}]">
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</form>

{!! $users->links() !!}

@endsection