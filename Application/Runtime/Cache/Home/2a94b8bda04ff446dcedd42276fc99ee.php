<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>完美</title>
        <link type="text/css" href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="/Public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="/Public/css/theme.css" rel="stylesheet">
        <link type="text/css" href="/Public/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>
    
<body>
    
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i></a><a class="brand" href="<?php echo U('index/index');?>">KEKE996 </a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                            <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Item No. 1</a></li>
                                <li><a href="#">Don't Click</a></li>
                                <li class="divider"></li>
                                <li class="nav-header">Example Header</li>
                                <li><a href="#">A Separated link</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Support </a></li>
                        <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/Public/images/user.png" class="nav-avatar" />
                            <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Your Profile</a></li>
                                <li><a href="#">Edit Profile</a></li>
                                <li><a href="#">Account Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo U('Index/dologout');?>">退出登录</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.nav-collapse -->
            </div>
        </div>
        <!-- /navbar-inner -->
    </div>
    
    <!-- /navbar -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                
                <div class="span3">
                    <div class="sidebar">
                        <ul class="widget widget-menu unstyled">
                            <li class="active"><a href="<?php echo U('Index/index');?>"><i class="menu-icon icon-dashboard"></i>控制面板</a></li>
                            <li><a href="<?php echo U('Index/userlist');?>"><i class="menu-icon icon-user"></i>员工管理 </a></li>
                            <li><a href="<?php echo U('Index/jifenlist');?>"><i class="menu-icon icon-inbox"></i>积分管理</a></li>
                        </ul>
                        <!--/.widget-nav-->
                        
                        
                    </div>
                    
                    <!--/.sidebar-->
                </div>
                
                <!--/.span3-->
                
                <div class="span9">
                    <div class="content">
                        <div class="btn-controls">
                            <div class="btn-box-row row-fluid">
                                <a href="#" class="btn-box big span4"><i class=" icon-random"></i><b>65%</b>
                                    <p class="text-muted">
                                        Growth</p>
                                </a><a href="<?php echo U('Index/userlist');?>" class="btn-box big span4"><i class="icon-user"></i><b><?php echo ($userNum); ?></b>
                                    <p class="text-muted">
                                        目前员工总数</p>
                                </a><a href="#" class="btn-box big span4"><i class="icon-money"></i><b>15,152</b>
                                    <p class="text-muted">
                                        Profit</p>
                                </a>
                            </div>
                            <div class="btn-box-row row-fluid">
                                <div class="span8">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <a href="#" class="btn-box small span4"><i class="icon-envelope"></i><b>Messages</b>
                                            </a><a href="#" class="btn-box small span4"><i class="icon-group"></i><b>Clients</b>
                                            </a><a href="#" class="btn-box small span4"><i class="icon-exchange"></i><b>Expenses</b>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <a href="#" class="btn-box small span4"><i class="icon-save"></i><b>Total Sales</b>
                                            </a><a href="#" class="btn-box small span4"><i class="icon-bullhorn"></i><b>Social Feed</b>
                                            </a><a href="#" class="btn-box small span4"><i class="icon-sort-down"></i><b>Bounce
                                                Rate</b> </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="widget widget-usage unstyled span4">
                                    <li>
                                        <p>
                                            <strong>Windows 8</strong> <span class="pull-right small muted">78%</span>
                                        </p>
                                        <div class="progress tight">
                                            <div class="bar" style="width: 78%;">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <p>
                                            <strong>Mac</strong> <span class="pull-right small muted">56%</span>
                                        </p>
                                        <div class="progress tight">
                                            <div class="bar bar-success" style="width: 56%;">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <p>
                                            <strong>Linux</strong> <span class="pull-right small muted">44%</span>
                                        </p>
                                        <div class="progress tight">
                                            <div class="bar bar-warning" style="width: 44%;">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <p>
                                            <strong>iPhone</strong> <span class="pull-right small muted">67%</span>
                                        </p>
                                        <div class="progress tight">
                                            <div class="bar bar-danger" style="width: 67%;">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--/#btn-controls-->
                        
                        <!--/.module-->
                    </div>
                    <!--/.content-->
                </div>
                
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->
    
    <div class="footer">
        <div class="container">
            <b class="copyright">&copy;KEKE996 </b>
        </div>
    </div>
    <script src="/Public/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="/Public/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Public/scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="/Public/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="/Public/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/Public/scripts/common.js" type="text/javascript"></script>
    
</body>