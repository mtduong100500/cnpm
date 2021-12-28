<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bằng khen Bộ trưởng</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <style>
        * {
            margin: 0;
        }


        @page {
            size: A4 landscape;
            /* size: 2480px 3508px landscape; */
            margin: 0px;
        }

        @media print {

            footer,
            .one-page {
                page-break-after: always;
            }
        }

        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0px;
            /* font-size: 3.1em; */
            font-size: 1.2em;
        }

        .wrapper {
            height: 100%;
            width: 100%;
            background-size: cover;
            text-align: center;
            page-break-inside: avoid;
            position: relative;
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
            /* font-weight: 600; */
            /* text-transform: uppercase; */
        }

        .t {
            top: 50%;
            left: 14.5%;
            width: 20%;
            text-align: left;
            font-size: 1.0em;
            font-weight: 100;
            /* text-transform: uppercase; */
        }

        .school {
            top: 54%;
            left: 19.5%;
            width: 61%;
            font-weight: 100;
        }

        .user {
            top: 58%;
            left: 19.5%;
            width: 61%;
            font-weight: 100;
        }

        .medal {
            top: 62.5%;
            left: 19.5%;
            width: 61%;
            font-weight: 300;
        }

        .title {
            top: 67%;
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
    $research['student_1'] = explode(',', $research['student_1']);
    $research['student_2'] = explode(',', $research['student_2']);
    @endphp
    <div class="wrapper">
        @if($research['student_2'][0])
        <k class="t">Nhóm học sinh</k>
        <k class="name"><b style="text-transform: uppercase;">{{$research['student_1'][0]}}, {{$research['student_2'][0]}}</b></k>
        @else
        <k class="name"><b>{{$research['student_1'][0]}}</b></k>
        @endif
        <k class="school"><i>Trường {{$research->school->name}}</i></k>
        <k class="user"><i>{{$research->user->name}}</i></k>
        <k class="medal"><b><i>Đạt giải {{$research->medal->name??''}}</i></b></k>
        <k class="title"><b><i>Tại cuộc thi Khoa học kỹ thuật cấp quốc gia học sinh trung học năm học 2020 - 2021</i></b></k>
    </div>
    @php $i++; @endphp
    @endforeach

    <script>
        $(document).ready(function() {
            window.print();
            window.onafterprint = function() {
                $('.printpage', window.parent.document).hide();
            }
        });
    </script>
</body>

</html>