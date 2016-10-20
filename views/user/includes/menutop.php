            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                    <center>
                        <a href="<?=base_url()?>" class="logo"><i class="icon-c-logo">UPTX</i><span><img src="<?=images('logo_tutorias_blanco.png')?>" style="max-width:80%"></span></a>
                    </center>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="ion-navicon"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <form role="search" class="navbar-left app-search pull-left hidden-xs" action="<?=base_url('tutorias/cita')?>">
                                 <input type="text" name placeholder=" Tutoria... " class="form-control">
                                 <a href=""><i class="fa fa-search"></i></a>
                            </form>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?=base_url('perfil/foto/'.User()->idpersonas)?>" alt="user-img" class="img-circle"> <?=user()->nombre?> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?=base_url('logout')?>"><i class="fa fa-power-off"></i> Salir </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->