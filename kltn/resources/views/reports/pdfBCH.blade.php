<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bằng khen Trung ương đoàn</title>
    <style>
        @page {
            size: A4 landscape;
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
            /* background-image: url("{{ storage_path('img/BCHCD.png') }}"); */
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
            top: 49.5%;
            left: 19.5%;
            width: 61%;
            text-align: center;
            font-size: 1.1em;
            /* font-weight: 600;
            text-transform: uppercase; */
        }

        .t {
            top: 48.7%;
            left: 19%;
            width: 20%;
            text-align: left;
            font-size: 1.0em;
            font-weight: 100;
            /* text-transform: uppercase; */
        }

        .school {
            top: 54%;
            left: 17.5%;
            width: 65%;
            font-weight: 100;
        }

        .user {
            top: 60%;
            left: 19.5%;
            width: 61%;
            font-weight: 100;
        }

        .medal {
            top: 58%;
            left: 19.5%;
            width: 61%;
            font-weight: 300;
        }

        .title {
            top: 61.5%;
            left: 19.5%;
            width: 61%;
            font-weight: 300;
        }
    </style>
</head>

<body>
    @php
    $i=1;
    @endphp
    @foreach ($researchs as $research)
    @php
    $research['teacher'] = explode(',', $research['teacher']);
    @endphp
    <div class="wrapper">
       
        <k class="name"> <t style="font-weight: 100;">Đồng chí: </t> <b style="text-transform: uppercase;">{{$research['teacher'][0]}}</b></k>
        <k class="school"> {{$research['teacher'][1]}} - {{$research->user->name}}</k>
        <k class="medal">Đã có thành tích xuất sắc trong hướng dẫn học sinh đạt giải {{$research->medal->name??''}} tại</k>
        <k class="title">Cuộc thi Khoa học kỹ thuật cấp quốc gia học sinh trung học năm học 2020 - 2021</k>
    </div>
    @php $i++; @endphp
    @endforeach
</body>

</html>