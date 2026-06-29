<div class="row mt-3 justify-content-between align-items-center">
    <div class="col-6">
        <h3 class="mb-0">
            @yield('title')
        </h3>
        <p class="small">
            @yield('description')
        </p>
    </div>
    <div class="col-6 d-flex justify-content-end align-items-center">
        @yield('page-actions')
    </div>
</div>

@include('layout.sections.messages')

@hasSection('main-content')
    @yield('main-content')
@else
    @yield('content')
@endif
