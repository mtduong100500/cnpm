@extends('print.layout', ['font'=>'18px'])
@section('content')

@include('print.certificate.list')

<script>
    $(document).ready(function() {
        window.print();
        window.onafterprint = function() {
            $('.printpage', window.parent.document).hide();
        }
    });
</script>
@endsection