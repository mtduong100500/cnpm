@include('print.title', ['font'=>'18px'])
<div class="p-3 mt-3">
    <h3 class="text-center text-uppercase"><b>Danh sách học sinh đạt giải</b></h3>
    <div class="media text-center mb-2">
        <!-- <div class="media-body">Danh sách giáo viên hướng dẫn học sinh đạt giải: <b>{{$medal->name??''}}</b></div> -->
    </div>
    <table class="table table-bordered text-center">
        <tr>
            <th class="align-middle">STT</th>
            <th class="align-middle">Tên học sinh</th>
            <th class="align-middle">Ngày sinh</th>
            <th class="align-middle">Trường</th>
            <th class="align-middle">Tỉnh/TP</th>
            <th class="align-middle fit" style="width: 15%;">Giải</th>
        </tr>
        @php $i=1; @endphp

        @foreach($researchs as $research)

        @php
        $research['student_1'] = explode(',', $research['student_1']);
        $research['student_2'] = explode(',', $research['student_2']);
        @endphp
        <tr>
            @php $d = explode('-', $research['student_1'][1]??"xxxx-xx-xx"); @endphp
            <td class="align-middle">{{$i}}</td>
            <td class="align-middle text-left">{{$research['student_1'][0]}}</td>
            <td class="align-middle">{{($d[1]??"--")."/".($d[2]??"--")."/".($d[0]??"--")}}</td>
            <td class="align-middle text-left">{{ $research->school->name??'' }}</td>
            <td class="align-middle">{{ $research->province->name }}</td>
            <td class="align-middle">{{ $research->medal->name }}</td>
        </tr>
        @php $i++; @endphp

        @if($research['student_2'][0])
        <tr>
            @php $d = explode('-', $research['student_1'][1]??"xxxx-xx-xx"); @endphp
            <td class="align-middle">{{$i}}</td>
            <td class="align-middle text-left">{{$research['student_2'][0]}}</td>
            <td class="align-middle">{{($d[1]??"--")."/".($d[2]??"--")."/".($d[0]??"--")}}</td>
            <td class="align-middle text-left">{{ $research->school2->name??'' }}</td>
            <td class="align-middle">{{ $research->province->name }}</td>
            <td class="align-middle">{{ $research->medal->name }}</td>
        </tr>
        @php $i++; @endphp
        @endif

        @endforeach
    </table>
</div>
<style>
    @page {
        size: A4 landscape;
    }

    div,
    table {
        font-size: 20px;
    }
</style>