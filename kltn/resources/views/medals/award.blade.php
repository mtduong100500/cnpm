@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h3> Nhóm lĩnh vực: {{ $group->name }}</h3>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ '/groups?type=3' }}"> Quay lại</a>
        </div>
    </div>
</div>

@include('medals.formAward', compact('medals'))
<form action="/researchs/medal" method="POST" class="mb-0">
    @csrf
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-2">
            <tr class="text-center">
                <th>Mã</th>
                <th>Tên</th>
                <th>P1</th>
                <th>P2</th>
                <th>TB</th>
                <th>Giải</th>
            </tr>
            @foreach ($researchs as $research)
            <tr title="{{ $research->name }}">
                <td class="align-middle">{{ $research->key }}</td>
                <td class="align-middle">
                    <k class="text-truncate-2" style="min-width: 200px; max-width: 700px">{{ $research->name }}</k>
                </td>
                <td class="align-middle text-center">{{ $research->p1 }}</td>
                <td class="align-middle text-center">{{ $research->p2 }}</td>
                @if($research->point)
                <td class="align-middle text-center table-success">{{ $research->point }}</td>
                @else
                <td></td>
                @endif
                @if($edit)
                <td class="align-middle">
                    {!! Form::select('medal_id['.$research->id.']', $medals??[], $research->medal_id??0, array( 'placeholder' => 'Xét giải...', 'class' => 'form-control')) !!}
                </td>
                @else
                <td class="align-middle">
                    {!! Form::select('medal_id['.$research->id.']', $medals??[], $research->medal_id??0, array( 'placeholder' => 'Xét giải...', 'class' => 'form-control', 'disabled')) !!}
                </td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
    @if($edit)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
        </div>
    </div>
    @endif
</form>

<div class="text-right mb-2">
    @if(!$edit)
    <a class="btn btn-danger" href="/medal-award/{{$group->id}}?edit=true">Chỉnh sửa</a>
    @else
    <a class="btn btn-warning" href="/medal-award/{{$group->id}}">Tắt chế độ chỉnh sửa</a>
    @endif
    @can('medal-report')
    <a class="btn btn-primary" href="/medal-award/{{$group->id}}/download?all=true">In danh sách chung</a>
    <a class="btn btn-success" href="/medal-award/{{$group->id}}/download">In danh sách đạt giải</a>
    @endcan
</div>
@endsection