@extends('print.layout')
@section('content')


@foreach ($examiners as $examiner)
<div class="one-page">
    @include('print.examiners.content', ['examiner'=>$examiner])
</div>
@endforeach

<script>
    $(document).ready(function() {
        window.print();
        window.onafterprint = function() {
            $('.printpage', window.parent.document).hide();
        }
    });
</script>
@endsection