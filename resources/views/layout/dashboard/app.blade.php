<!DOCTYPE html>
<html lang="en">
@include('layout.dashboard.head')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
@include('layout.dashboard.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
   
            <!-- Main Content -->
     <div id="content">

                <!-- Topbar -->
             @include('layout.dashboard.navbar')
                <!-- End of Topbar -->

           @yield('body')
            </div>
            <!-- End of Main Content -->

          @include('layout.dashboard.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <form action="{{ route('admin.logout') }}" method="post">
                    @csrf
                     <button type="submit" class="btn btn-primary">Logout</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>
    <script src=" {{ asset('assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/dashboard/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/dashboard/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/dashboard/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/demo/chart-pie-demo.js') }}"></script>
     {{-- <script src="{{ asset('assets/dashboard/') }}/vendor/datatables/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/dashboard/') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script> --}}

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/dashboard/') }}/js/demo/datatables-demo.js"></script>
      <script src="{{ asset('assets/forntend/vendor/file-input/js/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/forntend/vendor/file-input/themes/fa5/theme.min.js') }}"></script>
<script src="{{ asset('assets/forntend/vendor/SummerNote/summernote-bs4.min.js') }}"></script>
    @stack('js')

        @livewireScripts

</body>

</html>