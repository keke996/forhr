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
				<h3>员工列表</h3>
				
			</div>
			<div class="module-head">
				<a href="<?php echo U('Index/editUser',array('type'=>'2'));?>" class="btn btn-large btn-success">添加员工</a>
				<br>
				<br>
				<form action="<?php echo U('Index/impUser');?>" method="post" enctype="multipart/form-data">
					<input type="file"  name="import"/>
					<input type="submit"  value="导入"/>
				</form>
			</div>
			<div class="module-body">
				<table id="sanse" class="table table-striped datatable-1">
					<thead>
					<tr>
						
						<th>部门</th>
						<th>姓名</th>
						<th>积分</th>
						<th>入职时间</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
					
					</tbody>
				</table>
				<div style="text-align: right;padding:10px">
					<a href="<?php echo U('Index/expUser');?>" class="btn btn-large btn-success" style="">导出所有员工</a>
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

	<style>
		.btn-group{
			font-size: 14px!important;
		}

		.datatable-pagination>a span{
			display: block!important;
		}
	</style>
	<script src="/Public/scripts/jquery-1.9.1.min.js"></script>
	<script src="/Public/scripts/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="/Public/datatable/js/jquery.dataTables.min.js"></script>
	<!-- <link rel="stylesheet" href="/Public/datatable/css/jquery.dataTables.min.css"> -->
	
	<script>
		
		var tabledata ={};
		$.ajax({
			type: 'POST',
			url: "<?php echo U('Index/userListData');?>",
			dataType:"json",
			async: false,
			success: function (data) {
				console.log(data);
				tabledata = data;
				for(j = 0; j < tabledata.length; j++) {
					tabledata[j]['lala']= "<a userid="+tabledata[j]['id']+" class='btn btn-danger deleteuser'>删除</a>&emsp;&emsp;";
					var uid = tabledata[j]['id'];
					var midurl = "<a href="+"<?php echo U('Index/editUser',array('id'=>'nidval','type'=>'1'));?>"+ " class='btn btn-primary'>编辑</a>";
					var url = midurl.replace('nidval',uid);
					tabledata[j]['lala'] += url;
				} 
				
			},
			error: function(){
				console.log('请求超时，请刷新当前页面重新访问');
			}
		})
		$(document).ready(function() {
			var table = $('#sanse').DataTable(
				{	
					// "lengthChange": false,
					// "pageLength": 50,
					// "paging": false,
					"autoWidth": false,
					"pagingType": "full_numbers",
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
					},
					"data":tabledata,
					"columns": [
						{ "data": "bumen" },
						{ "data": "name" },
						{ "data": "jifen" },
						{ "data": "ruzhi" },
						{ "data": "lala"}
					],
					
				}
			);
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');

			var table = $('#sanse').DataTable();
			$('#sanse').on( 'click', '.deleteuser', function () {
				console.log(table);return false;
				var self = $(this)
				if(window.confirm('确认删除该用户？我暂时还没学会怎么恢复数据，所以请慎重！！！！')){
					//alert("确定");
					var userid = $(this).attr('userid');
					var self = $(this);
					$.ajax({
						type: 'POST',
						url: "<?php echo U('Index/deleteUserAjax');?>",
						dataType:"json",
						data:{
							'id':userid
						},
						async: false,
						success: function (data) {
							if(data.code==200){
								//删除对应行
								table
								.row( self.parents('tr') )
								.remove()
								.draw(false);
								//重绘表格，不返回首页
								
							}
							alert(data.msg);
						},
						error: function(){
							alert("删除失败");
							console.log('请求超时');
						}
					})
					return true;
				}else{
					//alert("取消");
					return false;
				}
			} );

		} );
	</script>
	
</body>