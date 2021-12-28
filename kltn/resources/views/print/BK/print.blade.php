@extends('print.layout')
@section('content')

@include('print.BK.list')

<script>
    $(document).ready(function() {
        window.print();
        window.onafterprint = function() {
            $('.printpage', window.parent.document).hide();
        }
    });
</script>
@endsection