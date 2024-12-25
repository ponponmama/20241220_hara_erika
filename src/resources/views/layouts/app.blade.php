<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>mogitate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<html>
<body class="common_body">
  <main class="site_main">
    <header class="products-header">
    <h1 class="top_logo">mogitate</h1>
    </header>
    <div class="main_container">
      @yield('content')
      @yield('content-register')
    </div>
  </main>
</body>
</html>
