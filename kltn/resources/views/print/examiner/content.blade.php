@include('print.title')
<div class="p-3 mt-3">
    <h3 class="text-center"><b>PHIẾU NHẬP ĐIỂM</b></h3>
    <div class="media text-center mb-2">
        <div class="media-body">Vòng: <b>{{$round}}</b></div>
        <div class="media-body">Mã phiếu: <b>0{{$round}}-{{$examiner->key}}</b></div>
    </div>
    <table class="table table-bordered text-center">
        <tr>
            <th>TT</th>
            <th>Mã</th>
            <th>Tên dự án</th>
            <th>Điểm</th>
            <th class="fit" style="width: 15%;">Ghi chú</th>
        </tr>
        @php $i=1; @endphp
        @foreach($examiner->researchs as $research)
        <tr>
            <td class="align-middle">{{ $i }}</td>
            <td class="align-middle">{{ $research->key }}</td>
            <td class="align-middle text-justify">{{ $research->name }}</td>
            <td class="align-middle">{{ $research->pivot->point }}</td>
            <td class="align-middle"></td>
            <!-- <td class="align-middle">{{ $research->pivot->comment }}</td> -->
        </tr>
        @php $i++; @endphp
        @endforeach
    </table>

    <div class="media text-center mb-2">
        <div class="media-body"><b>Thư ký</b><br><i>(Kí và ghi rõ họ tên)</i></div>
        <div class="media-body"><b>Giám khảo</b><br><i>(Kí và ghi rõ họ tên)</i></div>
        <!-- <div class="media-body"><b>Thanh tra</b><br><i>(Kí và ghi rõ họ tên)</i></div> -->
    </div>
</div>