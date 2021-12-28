@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Đăng ký đề tài khóa luận tốt nghiệp</h3>
            </div>
            <!-- <div class="col text-right">
                <a href="#!" class="btn btn-sm btn-primary">See all</a>
            </div> -->
        </div>
    </div>
    <div class="card-body">
        <div class="row">            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr class="badge-default">
                        <th class="text-align-center">STT</th>
                        <th class="text-align-center">
                            <a class="thead" href="#">    
                                <div class="col-xl-12">
                                    Tên đề tài  <i class="fas fa-arrows-alt-v"></i>
                                </div>
                            </a>
                        </th>
                        <th class="text-align-center">
                            <a class="thead" href="#">    
                                <div class="col-xl-12">
                                    Bộ môn  <i class="fas fa-arrows-alt-v"></i>
                                </div>
                            </a>
                        </th>
                        <th class="text-align-center">
                            <a class="thead" href="#">    
                                <div class="col-xl-12">
                                    Mã sinh viên  <i class="fas fa-arrows-alt-v"></i>
                                </div>
                            </a>
                        </th>
                        <th class="text-align-center">
                            <a class="thead" href="#">    
                                <div class="col-xl-12">
                                    Họ tên sv  <i class="fas fa-arrows-alt-v"></i>
                                </div>
                            </a>
                        </th>
                        <th class="text-align-center">
                            <a class="thead" href="#">    
                                <div class="col-xl-12">
                                    Giảng viên hướng dẫn  <i class="fas fa-arrows-alt-v"></i>
                                </div>
                            </a>
                        </th>
                    </tr>
                    
                    @foreach ($register_result as $key => $result)
                    <tr>
                        <td class="text-align-center">{{ ++$i }}</td>
                        <td style="width: 40%;" class="align-middle">{{ $result->topic_name }}</td>  
                        <td class="text-align-center">{{ $result->department }}</td>
                        <td class="text-align-center">{{ $result->student_id }}</td>
                        <td class="text-align-center">{{ $result->student_name }}</td>
                        <td class="text-align-center">{{ $result->instructor_name }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

{!! $register_result->render() !!}
@endsection