@include('layouts.header')
<div class="wrapper">
    @include('layouts.preloader')
    @include('layouts.topbar')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        <div class="container">
            @yield('page')
        </div>
    </div>
    @include('layouts.right-sidebar')
</div>
@include('layouts.footer')