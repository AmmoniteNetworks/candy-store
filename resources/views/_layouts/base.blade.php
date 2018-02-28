<!doctype html>
<html lang="en">
<head>
    @include('_includes.head')
</head>
<body>

    <div id="app">

        <header class="header-wrap">
            @include('_includes/header')
            @include('_includes/navigation')
        </header>

        @yield('content')

        @include('_includes.footer')

    </div>
        <script src="https://use.fontawesome.com/2633bba861.js"></script>
        <script src="{{ mix('/js/app.js') }}"></script>

    @section('bodyscript')
    @show

</body>
</html>