@include('User.elements.head')
@yield('head')
<body>
<div id="preloder">
    <div class="loader"></div>
</div>
@include('User.elements.header')
@include('User.alert')
@yield('content')
@include('User.elements.footer')
@yield('footer')
</body>

</html>
