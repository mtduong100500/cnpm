<form action="/examiners/{{$examiner->id}}?round={{$round??1}}" method="POST" class="mb-0" id="inputform">
    @csrf
    <table class="table table-bordered">
        <tr>
            <th>Mã</th>
            <th>Tên đề tài</th>
            <th>Điểm</th>
            <th class="fit">Ghi chú</th>
        </tr>
        @php $i = 0; @endphp
        @foreach ($researchs as $key => $research)
        @php $i++; @endphp
        <tr>
            <td class="align-middle">{{ $research->key }}</td>
            <td class="align-middle">{{ $research->name }}</td>
            <td class="align-middle p-0">
                <input onfocus="this.select();" autofocus type="number" step="0.05" min=0 max=100 data-index="{{$i}}" name="input[{{$research->id}}][point]" value="{{$research->pivot->point}}" />
            </td>
            <td class="align-middle p-0">
                <input type="text" name="input[{{$research->id}}][comment]" value="" />
            </td>
        </tr>
        @endforeach
    </table>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <b>Tổng: {{count($researchs)}}</b>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8">
            <button type="submit" class="btn btn-primary">Lưu điểm</button>
            @can('examiner-point')

            <button type="button" class="btn btn-success" onclick="loadOtherPage()">In danh sách điểm</button>
            <a type="button" class="btn btn-danger" href="/examiner/config?key={{$examiner->key}}&round={{$round}}&status=0">Hoàn thành nhập điểm</a>
            <!-- <a class="btn btn-success" href="{{ '/groups/'.$examiner->group_id .'/setup?download=true&round='.$round.'&examiner_id='.$examiner->id }}">In biên bản nhập điểm</a> -->
            @endcan
            @can('examiner-setup')
            <a type="button" class="btn btn-warning" href="/examiner/config?key={{$examiner->key}}&round={{$round}}&status=1">Mở khóa điểm</a>
            @endcan
        </div>
    </div>
</form>

<style>
    .table td.fit,
    .table th.fit {
        white-space: nowrap;
        width: 1%;
    }

    .table td.fit a {
        white-space: nowrap;
    }

    .table td>input,
    .table td>input:focus {
        padding: 0.4rem 0.75rem;
        border: none;
        border-color: transparent;
        outline: none;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<script>
    $('#inputform').on('keydown', 'input', function(event) {
        if (event.which == 13) {
            event.preventDefault();
            var $this = $(event.target);
            var index = parseFloat($this.attr('data-index'));
            $('[data-index="' + (index + 1).toString() + '"]').focus();
        }
    });

    function loadOtherPage() {
        $("<iframe class='printpage'>") // create a new iframe element
            .hide() // make it invisible
            .attr("src", "/prints/examiner/preview?id={{$examiner->id}}&round={{$round??1}}") // point the iframe to the page you want to print
            .appendTo("body"); // add iframe to the DOM to cause it to load the page
    }
</script>