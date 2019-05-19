<div class="wrap">
    @yield('heading')
    <div id="poststuff">

        @yield('content')

        <br class="clear">
        @stack('js')
    </div>
    <!-- #poststuff -->
</div> <!-- .wrap -->