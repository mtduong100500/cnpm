@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Chấm thi</h2>
        </div>
        <div class="float-right">
            <form class="form-inline mb-0">
                <div class="form-group mx-sm-3">
                    <input type="text" class="form-control" id="" placeholder="Nhập mã giám khảo">
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
            <!-- @can('product-create')
            <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            @endcan -->
        </div>
    </div>


</div>

@endsection