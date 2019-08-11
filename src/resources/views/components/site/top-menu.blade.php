<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{!! route('home') !!}">Project horus</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item {{ Request::is('/') || Request::is('/home') ? 'active' : '' }}">
                    <a class="nav-link" href="{!! route('home') !!}">Home</a>
                </li>
                <li class="nav-item {{ Request::is('system') ? 'active' : '' }}">
                    <a class="nav-link" href="{!! route('system.index') !!}">System</a>
                </li>
                <li class="nav-item {{ Request::is('services') ? 'active' : '' }}">
                    <a class="nav-link" href="{!! route('service.index') !!}">Pakketten</a>
                </li>
                <li class="nav-item {{ Request::is('over-ons') ? 'active' : '' }}">
                    <a class="nav-link" href="{!! route('about.index') !!}">Over Ons</a>
                </li>
                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{!! route('contact.index') !!}">Contact</a>
                </li>
                <li class="nav-item" style="padding-left:10px;">
                    <a class="nav-link btn btn-primary" href="{!! route('login') !!}" style="color: #FFFFFF;">Login klant</a>
                </li>
            </ul>
        </div>
    </div>
</nav>