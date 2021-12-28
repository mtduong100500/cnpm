@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h3>Tỉnh: <k class="text-blue">{{ $province->name }}</k> </h3>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('provinces.index') }}"> Quay lại</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="mr-3">Số lượng đề tài:</strong>{{count($researchs)}}
            </div>
            @include('researchs.items.list')
        </div>
    </div>
@endsection
