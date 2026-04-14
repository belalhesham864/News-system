<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
   <title>
   {{ config('app.name') }} -  @yield('title')
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link href="{{ asset('assets/forntend/lib/slick/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/forntend/lib/slick/slick-theme.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/forntend/css/style.css') }}" rel="stylesheet" />

    <!-- file input-->
    <link rel="stylesheet" href="{{ asset('assets/forntend/vendor/file-input/css/fileinput.min.css') }}">

    {{-- summer note --}}
    <link rel="stylesheet" href="{{ asset('assets/forntend/vendor/SummerNote/summernote-bs4.min.css') }}">
  </head>