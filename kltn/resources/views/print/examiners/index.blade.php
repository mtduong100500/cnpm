@extends('print.layout')
@section('content')

<script>
    function loadOtherPage() {
        $("<iframe class='printpage'>") // create a new iframe element
            .hide() // make it invisible
            .attr("src", "/prints/examiners/preview?id={{$id}}&round={{$round}}") // point the iframe to the page you want to print
            .appendTo("body"); // add iframe to the DOM to cause it to load the page
    }
</script>
<div>
    <br><br>
    <button class="btn btn-primary" onclick="loadOtherPage()">In danh sách</button>
</div>
@foreach ($examiners as $examiner)
<div class="one-page">
    @include('print.examiners.content', ['examiner'=>$examiner])
</div>
@endforeach
@endsection