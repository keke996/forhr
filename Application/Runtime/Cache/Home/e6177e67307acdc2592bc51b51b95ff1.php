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

		<div class="module">
			<div class="module-head">
				<h3>积分列表</h3>
				
			</div>
			<div class="module-head">
				
				<form action="<?php echo U('Index/impJifen');?>" method="post" enctype="multipart/form-data">
					<input type="file"  name="import"/>
					<input type="submit"  value="积分批量导入"/>
				</form>
			</div>
			<div class="module-body">
				<table class="table table-striped datatable-1">
					<thead>
					<tr>
						
						<th>部门</th>
						<th>姓名</th>
						<th>积分</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
					<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
							
							<td><?php echo ($v['bumen']); ?></td>
							<td><?php echo ($v['name']); ?></td>
							<td><?php echo ($v['jifen']); ?></td>
							<td>
								<a href="<?php echo U('Index/jifenDetail',array('id'=>$v['id']));?>" class="btn btn-primary">查看积分详情</a>
							</td>
						</tr><?php endforeach; endif; ?>
					
					</tbody>
				</table>
				<div style="text-align: right;padding:10px">
					<a href="<?php echo U('Index/expJifen');?>" class="btn btn-large btn-success" style="">导出所有员工积分情况</a>
				</div>
				<br>
			</div>
		</div>

	<br />
		
	</div><!--/.content-->
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

	<script src="/Public/scripts/jquery-1.9.1.min.js"></script>
	<script src="/Public/scripts/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
	<script src="/Public/scripts/datatables/jquery.dataTables.js"></script>
	<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable(
				{ 
					"oLanguage": { 
					"sLengthMenu": "每页显示 _MENU_ 条记录", 
					"sZeroRecords": "抱歉， 没有找到", 
					"sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据", 
					"sInfoEmpty": "没有数据", 
					"sInfoFiltered": "(从 _MAX_ 条数据中检索)", 
					"oPaginate": { 
					"sFirst": "首页", 
					"sPrevious": "前一页", 
					"sNext": "后一页", 
					"sLast": "尾页" 
					}, 
					"sZeroRecords": "没有检索到数据", 
					"sProcessing": "<img src='./loading.gif' />" 
					} 
				}
			);
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
	
</body>