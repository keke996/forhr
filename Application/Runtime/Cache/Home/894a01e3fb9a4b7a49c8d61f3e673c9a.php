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
				<h2><?php echo ($userinfo['name']); ?>-积分管理</h2>
				<h3>部门:<?php echo ($userinfo['bumen']); ?></h3>
				<h3>总分:<span id="zongfen"><?php echo ($userinfo['jifen']); ?></span></h3>
			</div>
			<table class="table table-striped datatable-1">
			<tr>
				<form action="<?php echo U('Index/doEditJifen');?>" method="post" class="form-horizontal row-fluid">
				<th><input id="date" type="date" name="date" style="height:2rem"placeholder="请选择时间" class="span2"></th>
				<th>
					<select tabindex="1" name="type" class="span1" data-placeholder="请选择操作类型">
						<option value="1" selected >加</option>
						<option value="2" >减</option>
					</select>
				</th>
				<th><input type="number" name="num" style="height:2rem"placeholder="请输入更改的积分数值"></th>
				<th><input type="text" name="beizhu" style="height:2rem"placeholder="请输入该操作的备注"></th>
				<input type="number" name="uid" value= <?php echo ($userinfo['id']); ?> style="display:none">
				<th><button type="submit" class="btn btn-large btn-success">确认操作</button></th>
				</form>
			</tr>
			</table>
			<div class="module-body">
				
				<table id="sanse" class="table table-striped datatable-1">
					
					<thead>
					<tr>
						<th class="span2" >操作时间</th>
						<th>类型</th>
						<th>数值</th>
						<th>备注</th>
						<th>撤销</th>
					</tr>
					</thead>
					<tbody>
					
					<br>
					<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
							<td><?php echo ($v['date']); ?></td>
							<td>
								<?php if($v['type'] == 1 ): ?>加
								<?php else: ?> 减<?php endif; ?>
							</td>
							<td><?php echo ($v['num']); ?></td>
							<td><?php echo ($v['beizhu']); ?></td>
							<td><input jid = "<?php echo ($v['jid']); ?>" type="button" value="撤销当前操作" class="revoke" ></td>
						</tr><?php endforeach; endif; ?>
					
					</tbody>
				</table>
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
	<script src="/Public/datatable/js/jquery.dataTables.min.js"></script>
	<!-- <script src="/Public/scripts/jquery-1.9.1.min.js"></script>
	<script src="/Public/scripts/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
	<script src="/Public/scripts/datatables/jquery.dataTables.js"></script> -->
	<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
	<script>
		
		getNowFormatDate();
		function getNowFormatDate() {
			var date = new Date();
			var seperator1 = "-";
			var seperator2 = ":";
			var month = date.getMonth() + 1;
			var strDate = date.getDate();
			if (month >= 1 && month <= 9) {
				month = "0" + month;
			}
			if (strDate >= 0 && strDate <= 9) {
				strDate = "0" + strDate;
			}
			var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate;
			document.getElementById('date').value = currentdate;
			console.log(currentdate);
		}
		




		$(document).ready(function() {
			var table = $('#sanse').DataTable(
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

			var table = $('#sanse').DataTable();
			$('#sanse').on( 'click', '.revoke', function () {
				var self = $(this)
				if(window.confirm('要撤销这个记录喽')){
					var userid = $(this).attr('userid');
					var self = $(this);
					var jid = $(this).attr('jid');
					$.ajax({
						type: 'POST',
						url: "<?php echo U('Index/revokeJifen');?>",
						dataType:"json",
						data:{
							'jid':jid
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

								document.getElementById('zongfen').innerText = data.jifen;
								
							}
							alert(data.msg);
							console.log(data);
						},
						error: function(){
							alert("撤销失败");
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