<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <style>
        @font-face {
            font-family: "jsMath-cmti10";
            src: url("{{ asset('fonts/jsMath-cmti10.ttf') }}") format("truetype");
            font-weight: normal;
            font-style: normal;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body class="common_body">
    <main class="site_main">
        <header class="product-header">
            <h1 class="top_logo">mogitate</h1>
        </header>
        @yield('content')
    </main>
</body>

</html>
