@extends('layouts.app')
@section('content')
<style>
    a:hover {
        text-decoration: none;
    }
</style>
<div class="row">
    @can('examiner-setup')
    <div class="col-md-12">
        <div class="card text-dark bg-light border-success p-3 mb-3">
            <form action="/examiners/config" class="mb-0" method="GET">
                <!-- @csrf -->
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-8">
                        <div class="form-group mb-0">
                            <!-- <strong>Chọn vòng thi hiện tại:</strong> -->
                            {!! Form::select('role', ['51'=>'Vòng 1', '52'=>'Vòng 2'], 0, array( 'placeholder' => 'Chọn vòng thi hiện tại...', 'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-4 text-center">
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @endcan
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2><a href="/examiners">{{$round?(($examiner??''&&$examiner->key)?'NHẬP ĐIỂM':'Mã phiếu chấm'):'Chọn vòng thi'}}</a></h2>
        </div>
        @if ($round &&!($examiner->id??0))
        <div class="float-right">
            <form class="form-inline mb-0" action="/examiners" method="GET">
                <div class="form-group mx-sm-3 mb-0">
                    <input type="text" class="form-control" name="key" placeholder="Nhập mã phiếu chấm">
                </div>
                <!-- <input type="" name="round" value="{{$round}}" /> OK -->
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
        @endif
    </div>
</div>
@if(!$round??'')
<div class="row justify-content-center">
    @include('home.item', ['name'=>'Nhập điểm', 'label' => 'Vòng 1', 'link'=>'/examiners?round=1', 'role'=>'round-1'])
    @include('home.item', ['name'=>'Nhập điểm', 'label' => 'Vòng 2', 'link'=>'/examiners?round=2', 'role'=>'round-2'])
</div>
@elseif($examiner->key??'')
<!-- bg-light -->
<div class="card text-dark border-primary p-3 mb-3">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h4>Vòng thi {{$round}} - {{'[0'.$round.'-'.$examiner->key.'] '.$examiner->name??''}} </h4>
            </div>
            <!-- <div class="float-right">
                @can('examiner-point')
                <a class="btn btn-success" href="{{ '/groups/'.$examiner->group_id .'/setup?download=true&round='.$round.'&examiner_id='.$examiner->id }}">In biên bản nhập điểm</a>
                @endcan
            </div> -->
        </div>
    </div>
    @include('examiners.form', [
    'researchs'=> $examiner->researchs()->wherePivot('round', $round??1)->orderBy('key', 'ASC')->get()
    ])
</div>

@can('examiner-setup')
<div class="card text-dark border-danger p-3 mb-0">
    @include('medals.pointStatus', compact('researchs'))
</div>
@endcan

@endif


@endsection