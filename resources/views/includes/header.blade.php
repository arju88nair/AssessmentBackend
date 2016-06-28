
<!--END THEME SETTING-->
<!--BEGIN BACK TO TOP-->
<a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
<!--END BACK TO TOP-->
<!--BEGIN TOPBAR-->
<div id="header-topbar-option-demo" class="page-header-topbar">
    <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a id="logo" href="http://localhost/Laravel/Assessment/public/dashboardAction" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">Assessment</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
        <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>



            <ul class="nav navbar navbar-top-links navbar-right mbn">
                <li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-bell fa-fw"></i><span class="badge badge-green"><?=count($report) + count($assistance)?></span></a>

                </li>
                <li><a href="http://localhost/Laravel/Assessment/public/loginAdmin"><span
                                class="glyphicon glyphicon-log-out"></span> Logout</a></li>


            </ul>
        </div>
    </nav>
    <!--BEGIN MODAL CONFIG PORTLET-->
    <div id="modal-config" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                        &times;</button>
                    <h4 class="modal-title">
                        Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend et nisl eget
                        porta. Curabitur elementum sem molestie nisl varius, eget tempus odio molestie.
                        Nunc vehicula sem arcu, eu pulvinar neque cursus ac. Aliquam ultricies lobortis
                        magna et aliquam. Vestibulum egestas eu urna sed ultricies. Nullam pulvinar dolor
                        vitae quam dictum condimentum. Integer a sodales elit, eu pulvinar leo. Nunc nec
                        aliquam nisi, a mollis neque. Ut vel felis quis tellus hendrerit placerat. Vivamus
                        vel nisl non magna feugiat dignissim sed ut nibh. Nulla elementum, est a pretium
                        hendrerit, arcu risus luctus augue, mattis aliquet orci ligula eget massa. Sed ut
                        ultricies felis.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">
                        Close</button>
                    <button type="button" class="btn btn-primary">
                        Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--END MODAL CONFIG PORTLET-->
</div>
<!--END TOPBAR-->
<div id="wrapper">
    <!--BEGIN SIDEBAR MENU-->
    <nav id="sidebar" role="navigation" data-step="2" style="height: 100%" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
         data-position="right" class="navbar-default navbar-static-side">
        <div class="sidebar-collapse menu-scroll">
            <ul id="side-menu" class="nav">

                <div class="clearfix"></div>
                <li class="active"><a  href="http://localhost/Laravel/Assessment/public/dashboardAction"><i class="fa fa-tachometer fa-fw">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Dashboard</span></a></li>
                <li><a href="http://localhost/Laravel/Assessment/public/addTest"><i class="fa fa-desktop fa-fw">
                            <div class="icon-bg bg-violet"></div>
                        </i><span class="menu-title">Add New Test</span></a>

                </li>
                <li><a href="http://localhost/Laravel/Assessment/public/addFeed"><i class="fa fa-send-o fa-fw">
                            <div class="icon-bg bg-pink"></div>
                        </i><span class="menu-title">Add New Feed</span></a>

                </li>
                <li><a href="http://localhost/Laravel/Assessment/public/viewUsers"><i class="fa fa-edit fa-fw">
                            <div class="icon-bg bg-blue"></div>
                        </i><span class="menu-title">View Users</span></a>

                </li>
              {{--  <li><a href="Tables.html"><i class="fa fa-th-list fa-fw">
                            <div class="icon-bg bg-blue"></div>
                        </i><span class="menu-title">Tables</span></a>

                </li>
                <li><a href="DataGrid.html"><i class="fa fa-database fa-fw">
                            <div class="icon-bg bg-red"></div>
                        </i><span class="menu-title">Data Grids</span></a>

                </li>
                <li><a href="Pages.html"><i class="fa fa-file-o fa-fw">
                            <div class="icon-bg bg-yellow"></div>
                        </i><span class="menu-title">Pages</span></a>

                </li>
                <li><a href="Extras.html"><i class="fa fa-gift fa-fw">
                            <div class="icon-bg bg-grey"></div>
                        </i><span class="menu-title">Extras</span></a>

                </li>
                <li><a href="Dropdown.html"><i class="fa fa-sitemap fa-fw">
                            <div class="icon-bg bg-dark"></div>
                        </i><span class="menu-title">Multi-Level Dropdown</span></a>

                </li>
                <li><a href="Email.html"><i class="fa fa-envelope-o">
                            <div class="icon-bg bg-primary"></div>
                        </i><span class="menu-title">Email</span></a>

                </li>
                <li><a href="Charts.html"><i class="fa fa-bar-chart-o fa-fw">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Charts</span></a>

                </li>
                <li><a href="Animation.html"><i class="fa fa-slack fa-fw">
                            <div class="icon-bg bg-green"></div>
                        </i><span class="menu-title">Animations</span></a></li>--}}
            </ul>
        </div>
    </nav>