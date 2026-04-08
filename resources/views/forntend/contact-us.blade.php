@extends('layout.forntend.app')
@section('title')
  Contact-Us
@stop
@section('breadcrumb')
  @parent
            <li class="breadcrumb-item active">Contact-Us</li>
@endsection
@section('body')
 

    <!-- Contact Start -->
    <div class="contact">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="contact-form">
              <form action="{{ route('forntend.contact.store') }}" method="post">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Your Name"
                      name="name"
                    />
                    <strong class="text-danger">@error('name')
                  {{ $message }}
                      @enderror</strong>
                  </div>
                  <div class="form-group col-md-6">
                    <input
                      type="email"
                      class="form-control"
                      placeholder="Your Email"
                      name="email"
                    />
                       <strong class="text-danger">@error('email')
                  {{ $message }}
                      @enderror</strong>
                  </div>
                  <div class="form-group col">
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Your phone"
                      name="phone"
                    />
                       <strong class="text-danger">@error('phone')
                  {{ $message }}
                      @enderror</strong>
                  </div>
                </div>
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Subject"
                    name="title"
                  />
                     <strong class="text-danger">@error('title')
                  {{ $message }}
                      @enderror</strong>
                </div>
                <div class="form-group">
                  <textarea
                    class="form-control"
                    rows="5"
                    name="body"
                    placeholder="Message"
                  ></textarea>
                     <strong class="text-danger">@error('body')
                  {{ $message }}
                      @enderror</strong>
                </div>
                <div>
                  <button class="btn" type="submit">Send Message</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-info">
              <h3>Get in Touch</h3>
              <p class="mb-4">
              {{ $setting->contact }}
               
              </p>
              <h4><i class="fa fa-map-marker"></i>{{ $setting->street . ' , ' . $setting->city . ' , ' . $setting->country  }}</h4>
              <h4><i class="fa fa-envelope"></i>{{ $setting->email }}</h4>
              <h4><i class="fa fa-phone"></i>{{ $setting->phone }}</h4>
              <div class="social">
                  <a href="{{ $setting->tiwter }}" title="tiwter" target="_blank" ><i class="fab fa-twitter"></i></a>
              <a href="{{ $setting->facebook }}" title="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a href="{{ $setting->instgram }}" title="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
              <a href="{{ $setting->youtube }}" title="youtube" target="_blank"><i class="fab fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact End -->
    @endsection