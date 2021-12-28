@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Danh sách giám khảo</h2>
        </div>
        <div class="float-right">
            
        </div>
    </div>
    @if(count($examiners??[]))

</div>
<form class="form-inline mb-0">
                {!! Form::select('group_id', $groups??[], 0, array('placeholder' => 'Chọn nhóm lĩnh vực...', 'class' => 'form-control')) !!}
                {!! Form::select('round', ['1'=>1, '2'=>2], 1, array('placeholder' => 'Chọn vòng thi...', 'class' => 'form-control')) !!}
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
<form action="/examiners/updateName" method="POST" class="mb-0">
    @csrf
    <table class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Mã phiếu chấm</th>
            <th>Họ và tên</th>
            <th class="fit">Chữ kí</th>
        </tr>
        @php $i = 0; @endphp
        @foreach ($examiners as $key => $examiner)
        @php $i++; @endphp
        <tr>
            <td class="align-middle">{{ $i }}</td>
            <td class="align-middle">0{{$round??''}}-{{ $examiner->key }}</td>
            <td class="align-middle p-0">
                <input type="text" name="input[{{$examiner->key}}][name]" value="{{$examiner->name}}" />
            </td>
            <td class="align-middle p-0">
                <!-- <input type="text" name="input[{{$examiner->id}}][comment]" value="" /> -->
            </td>
        </tr>
        @endforeach
    </table>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </div>
    </div>
</form>
@endif

@endsection