<!-- Main Content -->
<main class="main" id="top">
    <div class="container" data-layout="container">

        {{-- Check fluid container from local-storage --}}
        <script>
            var isFluid = JSON.parse(localStorage.getItem('isFluid'));
            if (isFluid) {
                var container = document.querySelector('[data-layout]');
                container.classList.remove('container');
                container.classList.add('container-fluid');
            }
        </script>

        {{-- Aside/right-nav --}}
        @include( 'layout.sections.private-aside' )

        {{-- Content --}}
        @include( 'layout.sections.private-main' )

    </div>
</main>
