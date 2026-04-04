<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
   <title>
     @yield('title')
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
      content="Bootstrap News Template - Free HTML Templates"
      name="keywords"
    />
    <meta
      content="Bootstrap News Template - Free HTML Templates"
      name="description"
    />

    <!-- Favicon -->
    <link href="{{ asset('assets/forntend/img/favicon.ico') }}" rel="icon" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap"
      rel="stylesheet"
    />

    <!-- CSS Libraries -->
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link href="{{ asset('assets/forntend/lib/slick/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/forntend/lib/slick/slick-theme.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/forntend/css/style.css') }}" rel="stylesheet" />
  </head>

  <body>

@include('layout.forntend.header')


@yield('body')


@include('layout.forntend.footer')



    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/forntend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/forntend/lib/slick/slick.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/forntend/js/main.js') }}"></script>
  </body>
</html>
