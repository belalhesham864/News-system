
    <!-- Footer Start -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="footer-widget">
              <h3 class="title">Get in Touch</h3>
              <div class="contact-info">
                <p><i class="fa fa-map-marker"></i>{{ $setting->street  .','. $setting->city .','. $setting->country }}</p>
                <p><i class="fa fa-envelope"></i>{{ $setting->email }}</p>
                <p><i class="fa fa-phone"></i>{{ $setting->phone }}</p>
                <div class="social">
                 <a href="{{ $setting->tiwter }}" title="tiwter" target="_blank" ><i class="fab fa-twitter"></i></a>
              <a href="{{ $setting->facebook }}" title="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a href="{{ $setting->instgram }}" title="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
              <a href="{{ $setting->youtube }}" title="youtube" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="footer-widget">
              <h3 class="title">Useful Links</h3>
              <ul>
                @foreach ($relatedsite as $site )
                  
                <li><a target="_blank" title="{{ $site->name }}" href="{{ $site->url }}">{{ $site->name }}</a></li>
                @endforeach
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="footer-widget">
              <h3 class="title">Quick Links</h3>
              <ul>
                <li><a href="#">Lorem ipsum</a></li>
                <li><a href="#">Pellentesque</a></li>
                <li><a href="#">Aenean vulputate</a></li>
                <li><a href="#">Vestibulum sit amet</a></li>
                <li><a href="#">Nam dignissim</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="footer-widget">
              <h3 class="title">Newsletter</h3>
              <div class="newsletter">
                <p>
                 Subscribe to our newsletter
Get the latest updates, news, and exclusive offers directly to your inbox.
                </p>
                <form method="post" action="{{ route('forntend.subscribe') }}">
                  @csrf
                  <input
                    class="form-control"
                    type="email"
                    placeholder="Your email here"
                    name="email"
                  />
                  @error('email')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                  <button class="btn">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer End -->



    <!-- Footer Bottom Start -->
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-6 copyright">
            <p>
              Copyright &copy; <a href="">{{ config('app.name') }}</a>. All Rights
              Reserved
            </p>
          </div>

          <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
          <div class="col-md-6 template-by">
            <p>Designed By <a href="https://belal-hesham.my.canva.site/portfolio">Belal Hesham</a></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer Bottom End -->


    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/forntend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/forntend/lib/slick/slick.min.js') }}"></script>
    <!--  file input -->
<script src="{{ asset('assets/forntend/vendor/file-input/js/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/forntend/vendor/file-input/themes/fa5/theme.min.js') }}"> </script>

{{-- summer notee --}}
<script src="{{ asset('assets/forntend/vendor/SummerNote/summernote-bs4.min.js') }}"> </script>
    <!-- Template Javascript -->
    <script src="{{ asset('assets/forntend/js/main.js') }}"></script>