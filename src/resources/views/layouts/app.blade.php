<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'mogitate')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    @if (request()->is('products/*/edit'))
        <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    @endif
</head>

<body>
    <header>
        <div class="header__inner">
            <a class="header__logo" href="/products">
            mogitate
            </a>
    </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer> </footer>
</body>
</html>