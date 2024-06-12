<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('admin') }}/assets/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/js/bootstrap.js"></script>
{{--  <script src="{{ asset('admin') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>  --}}

<script src="{{ asset('admin') }}/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
{{--  <script src="{{ asset('admin') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>  --}}

<!-- Main JS -->
<script src="{{ asset('admin') }}/assets/js/main.js"></script>

@stack('admin_script')

<!-- Page JS -->
{{--  <script src="{{ asset('admin') }}/assets/js/dashboards-analytics.js"></script>  --}}

<!-- Place this tag in your head or just before your close body tag. -->
{{--  <script async defer src="https://buttons.github.io/buttons.js"></script>  --}}


{{--  Toster  --}}
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

{{--  sweet alert  --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
