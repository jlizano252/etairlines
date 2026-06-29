{{-- Alpine.js --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

{{-- Livewire --}}
@livewireScripts

{{-- Javascript --}}
<script src="{{ asset( 'vendors/popper/popper.min.js ') }}"></script>
<script src="{{ asset( 'vendors/bootstrap/bootstrap.min.js' ) }}"></script>
<script src="{{ asset( 'vendors/anchorjs/anchor.min.js' ) }}"></script>
<script src="{{ asset( 'vendors/fontawesome/all.min.js' ) }}"></script>
<script src="{{ asset( 'vendors/lodash/lodash.min.js' ) }}"></script>
<!-- <script src="{{ asset( 'js/theme.js' ) }}/"></script> -->
<script src="{{ asset( 'js/global/preloader.js' ) }}"></script>
<script src="{{ asset( 'js/global/messages-listeners.js' ) }}"></script>
<script src="{{ asset( 'js/global/searchBox.js' ) }}"></script>
<script src="{{ asset('vendors/countup/countUp.umd.js') }}"></script>

{{-- Javascript added by page --}}
@yield('scripts')

</body>

</html>