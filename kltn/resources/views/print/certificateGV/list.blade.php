@include('print.title', ['font'=>'18px'])
<div class="p-3 mt-3">
    <h3 class="text-center"><b>Danh sách giáo viên hướng dẫn học sinh đạt giải</b></h3>
    <div class="media text-center mb-2">
        <!-- <div class="media-body">Danh sách giáo viên hướng dẫn học sinh đạt giải: <b>{{$medal->name??''}}</b></div> -->
    </div>
    <table class="table table-bordered text-center">
        <tr>
            <th class="align-middle">Mã</th>
            <th class="align-middle">Tên giáo viên</th>
            <th class="align-middle">Đơn vị công tác</th>
            <th class="align-middle">Tỉnh/TP</th>
            <th class="align-middle fit" style="width: 15%;">Giải</th>
        </tr>
        @php $i=1; @endphp

        @foreach($researchs as $research)

        @php
        $research['teacher'] = explode(',', $research['teacher']);
        @endphp
        <tr>
            @php $id = $research->user->no>9?$research->user->no: ('0'.$research->user->no); @endphp
            <td class="align-middle">21-GV-{{$id}}-{{$i < 10?('0'.$i):$i}}</td>
            <td class="align-middle text-justify">{{$research['teacher'][0]}}</td>
            <td class="align-middle text-justify">{{$research['teacher'][1]}}</td>
            <td class="align-middle">{{ $research->province->name }}</td>
            <td class="align-middle">{{ $research->medal->name }}</td>
        </tr>
        @php $i++; @endphp

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