<!DOCTYPE html>
<html lang="en">
@include('frontend.bootslander.template.inc.head')

<body class="index-page">

    @include('frontend.bootslander.template.inc.navbar')
    <main class="main">

        @yield('content')
    </main>

    @include('frontend.bootslander.template.inc.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    @include('frontend.bootslander.template.inc.script')

</body>

</html>
