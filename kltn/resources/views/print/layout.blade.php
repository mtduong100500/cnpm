<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
        }

        div,
        table {
            font-size: 24px;
        }

        div {
            font-size: 22px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000 !important;
        }

        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }

        @media print {

            footer,
            .one-page {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>