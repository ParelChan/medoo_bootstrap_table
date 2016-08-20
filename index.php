<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>信息管理页</title>
<link rel="icon" href="favicon.ico">
<link
	href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//cdn.bootcss.com/bootstrap-table/1.10.0/bootstrap-table.min.css"
	rel="stylesheet">
<script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script

	src="//cdn.bootcss.com/bootstrap-table/1.10.0/bootstrap-table.min.js"></script>
<script

	src="//cdn.bootcss.com/bootstrap-table/1.10.0/extensions/export/bootstrap-table-export.min.js"></script>
<script

	src="//cdn.bootcss.com/bootstrap-table/1.10.0/locale/bootstrap-table-zh-CN.min.js"></script>
<script

	src="//rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
<script src="//cdn.bootcss.com/echarts/3.0.0/echarts.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/moment.zh-cn.js"></script>
<script type="text/javascript">
	$(function() {
		$.getJSON('data.php',{"a":"newdata"},function(data) {
			$("#xinzeng").text(data.newcount);
			$("#xinzeng").tooltip({
				"title" : "今日新增数据，点击查看",
				"placement" : "bottom"
			});
			$("#xinzeng").mouseover();
			$("#login_username").text(data.username);
			$.getJSON('data.php', {"a":"datasum"},function(data) {
				var myChart = echarts.init(document
						.getElementById('echarts_test'));
				var option = {
					title : {
						text : '用户注册统计',
						subtext : "时间分组统计",
						subtextStyle : {
							fontSize : 15,
							fontWeight : 'bold',
							color : 'black'
						}
					},
					tooltip : {
						show : true
					},
					legend : {
						data : [ '注册数' ]
					},
					color : '#61a0a8',
					axisType : 'category',
					xAxis : {
						position : "top",
						axisLabel : {
							formatter : function(value) {
								return value + "个";
							}
						}
					},
					yAxis : [ {
						data : data.c
					} ],
					series : [ {
						"name" : "注册数",
						"type" : "bar",
						"data" : data.d,
						itemStyle : {
							normal : {
								color : 'orange'
							}
						},
						label : {
							normal : {
								show : true,
								position : 'right',
								formatter : function(obj) {
									if (obj.value > 0) {
										return obj.value + "个";
									} else {
										return "暂无数据";
									}
								}
							}
						}
					} ]
				};
				// 为echarts对象加载数据


				myChart.setOption(option);


				var myChart2 = echarts.init(document
						.getElementById('echarts_test2'));
				var option2 = {
					title : {
						text : '用户注册统计',
						subtext : "时间分组统计",
						subtextStyle : {
							fontSize : 15,
							fontWeight : 'bold',
							color : 'black'
						}
					},
					tooltip : {
						show : true
					},
					legend : {
						data : [ '注册数' ]
					},
					color : '#61a0a8',
					axisType : 'category',
					xAxis : {
						position : "top",
						data : data.c,
						axisLabel : {
							formatter : function(value) {
								return value + "时间段";
							}
						}
					},
					yAxis : [ {
						type:"value"
					} ],
					series : [ {
						"name" : "注册数",
						"type" : "bar",
						"data" : data.d,
						itemStyle : {
							normal : {
								color : 'orange'
							}
						},
						label : {
							normal : {
								show : true,
								position : 'top',
								formatter : function(obj) {
									if (obj.value > 0) {
										return obj.value + "个";
									} else {
										return "暂无数据";
									}
								}
							}
						}
					} ]
				};
				// 为echarts对象加载数据


				myChart2.setOption(option2);
			});

		});
	});

	function operateFormatter(value, row, index) {
		return [
				'<a class="edit ml10" style="color:black;" href="javascript:void(0)" title="编辑">',
				'<span class="glyphicon glyphicon-edit"></span>',
				'</a>&emsp;',
				'<a class="remove ml10" style="color:black;" href="javascript:void(0)" title="删除">',
				'<i class="glyphicon glyphicon-remove"></i>', '</a>' ].join('');
	}

	function hideIdFormatter(value, row, index) {
		return "<input type='hidden' value="+value+" name='id' />";
	}

	window.operateEvents = {
		'click .like' : function(e, value, row, index) {
			alert('You click like icon, row: ' + JSON.stringify(row));
			console.log(value, row, index);
		},
		'click .edit' : function(e, value, row, index) {
			alert($("[data-index=" + index + "]").find('td').eq(8).html());
			//alert($("[data-index="+index+"]").find('td').eq(3).text());


			$("#waitph").val(
					$("[data-index=" + index + "]").find('td').eq(3).text());
			$("#edituc").modal("show");
			//alert('You click edit icon, row: ' + JSON.stringify(row));


			//console.log(value, row, index);


		},
		'click .remove' : function(e, value, row, index) {
			//alert('You click remove icon, row: ' + JSON.stringify(row));


			var delid = $("[data-index=" + index + "]").find('td').eq(0)
					.children().first().val();
			if (confirm("确定删除该条记录吗？" + delid)) {
				$.getJSON('user/delete', {
					"id" : delid
				}, function(data) {
					$("#dtb").bootstrapTable('refresh');
				});
			}
			console.log(value, row, index);
		}
	};

	function refreshTable() {
		$("table").bootstrapTable('refresh', {
			url : $("table").attr('data-url')
		});
	}

	function makeparmter(params) {
		params.queryby = $("#queryby").val();
		var ret = '';
		for ( var i in params) {
			ret += i + ':' + params[i];
		}
		//alert(ret);


		return params;
	}

	function saveUcode() {
		//alert($("#waiteduc").val());


		//alert($("#waitph").val());


		$.post('user/edit', {
			"phone" : $("#waitph").val(),
			"uc" : $("#waiteduc").val()
		}, function() {
			//alert('保存成功!');


			$("#edituc").modal('hide');
			$("#waiteduc").val('');
			$("#waitph").val('');
			refreshTable();
		});
	}

	function checkToday() {
		$("#queryby").val('0');
		refreshTable();
	}

	function checkAll() {
		$("#queryby").val('1');
		refreshTable();
	}

	function sys_Exit() {
		if (confirm("确定退出系统吗")) {
			window.location.href = "exit";
		}
	}
	function exporyToday() {
		if (confirm("确定导出当天记录吗？")) {
			window.location.href = "user/export";
		}
	}
	function exporyAll() {
		if (confirm("确定导出所有记录吗？")) {
			window.location.href = "export";
		}
	}

	function dateFormatter(value, row, index) {
		return moment.unix(value).format("YYYY-MM-DD hh:mm:ss a");
	}
</script>
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"></a>
			</div>

			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<p class="navbar-text">后台管理</p>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<p class="navbar-text">
						<span class="glyphicon glyphicon-user"></span> 欢迎您：<span
							id="login_username"></span>
					</p>
					<p class="navbar-text">
						今日共新增<span class="badge" id="xinzeng" style="cursor: pointer;"
							onclick="checkToday();">0</span>条数据
					</p>
					<li><a href="#" id="sys_exit" onclick="sys_Exit();"><span
							class="glyphicon glyphicon-off"></span>退出系统</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<hr>
		<div class="row">
			<div id="echarts_test" style="height: 200px;" class="col-md-12"></div>
		</div>
		<div class="row">
			<div id="echarts_test2" style="height: 200px;" class="col-md-12"></div>
		</div>
		<!-- <div class="btn-group btn-group-justified" role="group"

			aria-label="...">

			<div class="btn-group" role="group">

				<button type="button" class="btn btn-default"

					onclick="checkToday();">

					<span class="glyphicon glyphicon-search"></span> 查询今日数据

				</button>

			</div>

			<div class="btn-group" role="group">

				<button type="button" class="btn btn-default" onclick="checkAll();">

					<span class="glyphicon glyphicon-hdd"></span> 查询所有数据

				</button>

			</div>

			<div class="btn-group" role="group">

				<button type="button" class="btn btn-default"

					onclick="exporyToday();">

					<span class="glyphicon glyphicon-arrow-down"></span> 导出今日数据到excel

				</button>

			</div>

		</div> -->
		<button type="button" class="btn btn-default" onclick="exporyAll();">
			<span class="glyphicon glyphicon-arrow-down"></span> 导出历史数据到excel
		</button>
		<table id="dtb" data-toggle="table"
			data-url="userlist.php" class="table table-hover"
			data-show-columns="true" data-search="true" data-show-refresh="true"
			data-show-toggle="true" data-show-export="true"
			data-export-types="['json', 'xml', 'csv', 'txt', 'sql', 'excel']"
			data-height="450" data-side-pagination="server"
			data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
			data-query-params="makeparmter">
			<thead>
				<tr>
					<th data-field="id" data-formatter="hideIdFormatter" class="hide"></th>
					<th data-field="name" data-align="left">姓名</th>
					<th data-field="sex" data-align="center">性别</th>
					<th data-field="age">年龄</th>
					<th data-field="phone">手机号</th>
					<th data-field="deliveryaddress">收货地址</th>
					<th data-field="adddate" data-formatter="dateFormatter">添加时间</th>
					<th data-field="operate" data-formatter="operateFormatter"
						data-events="operateEvents">操作</th>
				</tr>
			</thead>
		</table>

		<div class="modal fade" id="edituc" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">编辑当前用户的资料</h4>
					</div>
					<div class="modal-body">
						<input id="waiteduc" type="text" class="form-control" value=""
							pattern="" required="required" /> <input id="waitph"
							type="hidden" />
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<button type="button" class="btn btn-primary"
							onclick="saveUcode();">保存</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="xinzengrows" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">今日新增的用户数据</h4>
					</div>
					<div class="modal-body">
						<table class="table">

						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</body>
<!-- <script src="//cdn.bootcss.com/echarts/3.0.0/echarts.min.js"></script> -->
</html>