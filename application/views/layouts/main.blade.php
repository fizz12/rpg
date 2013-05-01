<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>FizzRPG - @yield('pagetitle')</title>
        {{ Asset::styles() }}
        {{ Asset::scripts() }}
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="/rpg/public/">FizzRPG</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            @section('navigation')
                            @if( ! Auth::check())
                            <li><a href="<?php echo URL::base();?>">Home</a></li>
                            <li><a href="<?php echo URL::to('login');?>">Login</a></li>
                            <li><a href="<?php echo URL::to('register');?>">Register</a></li>
                            @else
                            <?php $uid = Auth::user()->id;?>
                            <li><a href="<?php echo URL::to('dashboard');?>">Dashboard</a></li>
                            <li><a href="<?php echo URL::to('dashboard/profile/'.$uid);?>">Profile</a></li>
                            <li><a href="<?php echo URL::to('user/logout');?>">Logout</a></li>
                            @endif
                            @yield_section
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <hr>

        <div class="container">
            @yield('content')
            <hr>
            <div class="span6" id="footer">
                <p>&copy; FizzRPG 2013</p>
            </div>
        </div> <!-- /container -->
    </body>
</html>