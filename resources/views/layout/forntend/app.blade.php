
@include('layout.forntend.head')
  <body>

@include('layout.forntend.header')

   <div class="breadcrumb-wrap">
      <div class="container">
        <ul class="breadcrumb">
          @section('breadcrumb')
@show
        </ul>
      </div>
    </div>
@yield('body')


@include('layout.forntend.footer')
  @stack('js')
  </body>
</html>
