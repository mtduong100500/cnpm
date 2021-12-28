<table class="table table-bordered">
    <tr>
        <th>Mã</th>
        <th>Tên đề tài</th>
        <th>Điểm</th>
        <th class="fit">Ghi chú</th>
    </tr>
    @foreach ($researchs as $research)
    <tr>
        <td class="align-middle">{{ $research->key }}</td>
        <td class="align-middle">{{ $research->name }}</td>
        <td class="align-middle">{{ $research->pivot->point }}</td>
        <td class="align-middle">{{ $research->pivot->comment }}</td>
    </tr>
    @endforeach
</table>
<b>Tổng: {{count($researchs)}}</b>