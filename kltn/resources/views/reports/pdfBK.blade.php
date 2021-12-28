<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bằng khen Bộ trưởng</title>
    <style>
        @page {
            size: B4 landscape;
            /* size: 2480px 3508px landscape; */
            margin: 0px;
        }

        @font-face {
            font-family: 'DOMPDF';
            src: url("{{storage_path('fonts/times.ttf')}}");
            font-weight: 500;
        }

        @font-face {
            font-family: 'DOMPDF';
            src: url("{{storage_path('fonts/timesi.ttf')}}");
            font-weight: 100;
        }

        @font-face {
            font-family: 'DOMPDF';
            src: url("{{storage_path('fonts/timesbi.ttf')}}");
            font-weight: 300;
        }

        @font-face {
            font-family: 'DOMPDF';
            src: url("{{storage_path('fonts/timesbd.ttf')}}");
            font-weight: 600;
        }

        * {
            margin: 0;
        }

        body {
            font-family: 'DOMPDF';
            margin: 0px;
            font-weight: 400;
            /* font-size: 3.1em; */
            font-size: 1.2em;
        }

        .wrapper {
            /* background-image: url("{{ storage_path('img/BK.png') }}"); */
            height: 100%;
            width: 100%;
            background-size: cover;
            text-align: center;
            page-break-inside: avoid;
        }

        k {
            position: absolute;
            display: block;
            text-align: center;
            /* border: 1px solid; */
            font-size: 1em;
            font-weight: 500;
        }

        .name {
            top: 46.5%;
            left: 14.5%;
            width: 71%;
            text-align: center;
            font-size: 1.1em;
            /* font-weight: 600;
            text-transform: uppercase; */
        }

        
        .name1 {
            top: 45.5%;
            left: 19.5%;
            width: 61%;
            text-align: center;
            font-size: 1.1em;
            /* font-weight: 600;
            text-transform: uppercase; */
        }
        .school1 {
            top: 49%;
            left: 19.5%;
            width: 61%;
            text-align: center;
            font-size: 1.1em;
            font-weight: 100;
            /* font-weight: 600;
            text-transform: uppercase; */
        }
        .name2 {
            top: 53.5%;
            left: 19.5%;
            width: 61%;
            text-align: center;
            font-size: 1.1em;
            /* font-weight: 600;
            text-transform: uppercase; */
        }
        .school2 {
            top: 57%;
            left: 19.5%;
            width: 61%;
            text-align: center;
            font-size: 1.1em;
            font-weight: 100;
            /* font-weight: 600;
            text-transform: uppercase; */
        }

        .school {
            top: 51%;
            left: 19.5%;
            width: 61%;
            font-weight: 100;
        }

        .user {
            top: 55%;
            left: 19.5%;
            width: 61%;
            font-weight: 100;
        }

        
        .medal {
            top: 60%;
            left: 19.5%;
            width: 61%;
            font-weight: 300;
        }

        .medal1 {
            top: 60.5%;
            left: 19.5%;
            width: 61%;
            font-weight: 300;
        }

        .title {
            top: 64%;
            left: 19.5%;
            width: 61%;
            font-weight: 300;
        }

        .no{
            top: 78%;
            left: 16.5%;
            width: 61%;
            text-align: left;
            font-weight: 100;
        }
    </style>
</head>

<body>
    @php
    $i=1;
    @endphp
    @foreach ($researchs as $research)
    @php
    $research['student_1'] = explode(',', $research['student_1']);
    $research['student_2'] = explode(',', $research['student_2']);
    @endphp
    @if($research['student_2'][0]&&($research->school->id!=$research->school2->id))
    <div class="wrapper">
        <k class="name1">Em: <b style="text-transform: uppercase;">{{$research['student_1'][0]}}</b></k>
        <k class="name2">Em: <b style="text-transform: uppercase;">{{$research['student_2'][0]}}</b></k>
        <k class="school1">Trường {{$research->school->name}} - {{$research->user->name}}</k>
        <k class="school2">Trường {{$research->school2->name}} - {{$research->user->name}}</k>
        <k class="medal1">Đạt giải {{$research->medal->name??''}}</k>
        <k class="title">Tại cuộc thi Khoa học kỹ thuật cấp quốc gia học sinh trung học năm học 2020 - 2021</k>
        <k class="no">Quyết định số: 1053/QĐ-BGDĐT</k>
    </div>

    @else
    <div class="wrapper">
        @if($research['student_2'][0])
        <k class="name">Nhóm học sinh: <b style="text-transform: uppercase;">{{$research['student_1'][0]}}, {{$research['student_2'][0]}}</b></k>
        @else
        <k class="name">Em: <b style="text-transform: uppercase;">{{$research['student_1'][0]}}</b></k>
        @endif
        <k class="school">Trường {{$research->school->name}}</k>
        <k class="user">{{$research->user->name}}</k>
        <k class="medal">Đạt giải {{$research->medal->name??''}}</k>
        <k class="title">Tại cuộc thi Khoa học kỹ thuật cấp quốc gia học sinh trung học năm học 2020 - 2021</k>
        <k class="no">Quyết định số: 1053/QĐ-BGDĐT</k>
    </div>
    @endif
    @php $i++; @endphp
    @endforeach
</body>

</html>