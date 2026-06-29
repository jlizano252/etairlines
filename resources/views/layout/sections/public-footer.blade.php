{{-- Livewire --}}
@livewireScripts

{{-- Javascript --}}
<script src="{{ asset( 'vendors/popper/popper.min.js ') }}"></script>
<script src="{{ asset( 'vendors/bootstrap/bootstrap.min.js' ) }}"></script>
<script src="{{ asset( 'vendors/anchorjs/anchor.min.js' ) }}"></script>
<script src="{{ asset( 'vendors/fontawesome/all.min.js' ) }}"></script>
<script src="{{ asset( 'vendors/lodash/lodash.min.js' ) }}"></script>
<script src="{{ asset('vendors/countup/countUp.umd.js') }}"></script>
<!-- <script src="{{ asset( 'js/theme.js' ) }}/"></script> -->
<!-- <script src="{{ asset( 'js/global/preloader.js' ) }}/"></script> -->

{{-- Javascript added by page --}}
@yield('scripts')
@stack('scripts')

</body>

</html>
