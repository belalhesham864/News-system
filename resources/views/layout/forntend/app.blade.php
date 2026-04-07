
@include('layout.forntend.head')
  <body>

@include('layout.forntend.header')


@yield('body')


@include('layout.forntend.footer')
  @stack('js')
  </body>
</html>
