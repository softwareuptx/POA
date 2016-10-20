            <!-- Top Bar Start -->
            <div class="topbar">

              <!-- LOGO -->
              <div class="topbar-left">
                <div class="text-center">
                  <center>
                    <a href="<?=base_url()?>" class="logo"><i class="icon-c-logo"><img src="<?=images('uptx_escudo.png')?>"></i><span><img src="<?=images('logo_poa_blanco.png')?>" style="max-width:80%"></span></a>
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

                    <!--<form role="search" class="navbar-left app-search pull-left hidden-xs" action="<?=base_url('tutorias/cita')?>">
                     <input type="text" name placeholder=" Tutoria... " class="form-control">
                     <a href=""><i class="fa fa-search"></i></a>
                     </form>-->

                   <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown hidden-xs">
                      <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">
                        <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">3</span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-lg">
                        <li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>
                        <li class="list-group nicescroll notification-list" tabindex="5000" style="overflow: hidden; outline: none;">
                         <!-- list item-->
                         <a href="javascript:void(0);" class="list-group-item">
                          <div class="media">
                           <div class="pull-left p-r-10">
                            <em class="fa fa-diamond fa-2x text-primary"></em>
                          </div>
                          <div class="media-body">
                            <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                            <p class="m-0">
                              <small>There are new settings available</small>
                            </p>
                          </div>
                        </div>
                      </a>

                      <!-- list item-->
                      <a href="javascript:void(0);" class="list-group-item">
                        <div class="media">
                         <div class="pull-left p-r-10">
                          <em class="fa fa-cog fa-2x text-custom"></em>
                        </div>
                        <div class="media-body">
                          <h5 class="media-heading">New settings</h5>
                          <p class="m-0">
                            <small>There are new settings available</small>
                          </p>
                        </div>
                      </div>
                    </a>

                    <!-- list item-->
                    <a href="javascript:void(0);" class="list-group-item">
                      <div class="media">
                       <div class="pull-left p-r-10">
                        <em class="fa fa-bell-o fa-2x text-danger"></em>
                      </div>
                      <div class="media-body">
                        <h5 class="media-heading">Updates</h5>
                        <p class="m-0">
                          <small>There are <span class="text-primary font-600">2</span> new updates available</small>
                        </p>
                      </div>
                    </div>
                  </a>

                  <!-- list item-->
                  <a href="javascript:void(0);" class="list-group-item">
                    <div class="media">
                     <div class="pull-left p-r-10">
                      <em class="fa fa-user-plus fa-2x text-info"></em>
                    </div>
                    <div class="media-body">
                      <h5 class="media-heading">New user registered</h5>
                      <p class="m-0">
                        <small>You have 10 unread messages</small>
                      </p>
                    </div>
                  </div>
                </a>

                <!-- list item-->
                <a href="javascript:void(0);" class="list-group-item">
                  <div class="media">
                   <div class="pull-left p-r-10">
                    <em class="fa fa-diamond fa-2x text-primary"></em>
                  </div>
                  <div class="media-body">
                    <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                    <p class="m-0">
                      <small>There are new settings available</small>
                    </p>
                  </div>
                </div>
              </a>

              <!-- list item-->
              <a href="javascript:void(0);" class="list-group-item">
                <div class="media">
                  <div class="pull-left p-r-10">
                   <em class="fa fa-cog fa-2x text-custom"></em>
                 </div>
                 <div class="media-body">
                  <h5 class="media-heading">New settings</h5>
                  <p class="m-0">
                    <small>There are new settings available</small>
                  </p>
                </div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0);" class="list-group-item text-right">
              <small class="font-600">See all notifications</small>
            </a>
          </li>
          <div id="ascrail2000" class="nicescroll-rails" style="width: 8px; z-index: 1000; cursor: default; position: absolute; top: 52px; left: 292px; height: 230px; display: none; opacity: 0;"><div style="position: relative; top: 0px; float: right; width: 6px; height: 0px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; background-color: rgb(152, 166, 173); background-clip: padding-box;"></div></div><div id="ascrail2000-hr" class="nicescroll-rails" style="height: 8px; z-index: 1000; top: 274px; left: 0px; position: absolute; cursor: default; display: none; opacity: 0; width: 292px;"><div style="position: relative; top: 0px; height: 6px; width: 0px; border: 1px solid rgb(255, 255, 255); border-radius: 5px; left: 0px; background-color: rgb(152, 166, 173); background-clip: padding-box;"></div></div></ul>
        </li>
        <li class="hidden-xs">
          <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
        </li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="false"><img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url('logout')?>"><i class="ti-power-off m-r-5"></i> Salir</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!--/.nav-collapse -->
  </div>
</div>
</div>
            <!-- Top Bar End -->