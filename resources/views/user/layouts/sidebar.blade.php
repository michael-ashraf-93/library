<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://cssanimation.rocks/images/posts/wwdc15/step1.png" class="img-circle"
                     alt="User Image"/>
            </div>
            {{--@if(Auth::user())--}}
            <div class="pull-left info">
                @if (Auth::guest())
                <p>Dashboard</p>
                    <a href="/login"><i class="fa fa-circle text-success"></i>You Are A Guest</a>

                @else
                    <p>{{ Auth::user()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i>{{ ucfirst(Auth::user()->role)}}</a>
            @endif
                <!-- Status -->
            </div>
                {{--@else--}}
            {{--@endif--}}
        </div>

        <!-- Sidebar Menu -->

        <ul class="sidebar-menu">
            @include('.user.layouts.menu')
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>