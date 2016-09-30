<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>登陆系统</title>
<link rel="icon" href="favicon.ico">
<link href="http://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="css/css.css" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/form-elements.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="//cdn.bootcss.com/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css" rel="stylesheet">
<script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.js"></script>
<script src="//cdn.bootcss.com/jquery-url-parser/2.3.1/purl.min.js"></script>
<script src="//cdn.bootcss.com/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script src="//cdn.bootcss.com/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-zh_CN.min.js"></script>
<script src="//cdn.bootcss.com/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
<script src="//cdn.bootcss.com/jquery.form/3.51/jquery.form.min.js"></script>
<style type="text/css">
	.formError .formErrorContent {
		background-color: #333333;
	}
</style>
<script type="text/javascript">
	$(function(){
		 $.backstretch("image/backimg.jpg");
		 $("input[name='requri']").val($.url(window.location.href).param('requri'));
		 $("#login_form").validationEngine('attach', {
				showOneMessage: false,
				"custom_error_messages": {
					"#email": {
						'required': {
							'message': "邮件必填"
						},
						'custom[email]': {
							'message': "邮件格式错误"
						}
					}
				},
				promptPosition: "top",
				scroll: false
// 				onValidationComplete: function(form, status) {
// 					//可以通过这里阻止表单提交
// 					console.log("The form status is: " + status + ", it will never submit");
// 					if(status) {
// 						if(confirm("是否允许提交")) {
// 							return true;
// 						}
// 						return false;
// 					}
// 				}
		});
		var options = {
	        success: function (data) {
	        	if(data.success==true){
	        		var jsoninfo=$.parseJSON(data.msg)
			        console.log(jsoninfo.id);
		        	console.log(jsoninfo.name);
					window.location.href="index.php";
		        }else{
		        	alert(data.msg);
			    }
	        	
	        }
	    };
        $("#login_form").ajaxForm(options);
        // ajaxSubmit
        $("#submit").click(function () {
        	if($("#login_form").validationEngine('validate')){
        		$("#login_form").ajaxSubmit(options);
        		return false;
        	}
        });
        
	});
</script>
</head>
<body>
	<div class="container">
		<div class="top-content">
			<div class="inner-bg">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2 text">
							<h1>
								<strong>欢迎使用</strong>
							</h1>
							<div class="description">
								<p>
									This is a free responsive login form made with Bootstrap.
									Download it on <a href="http://azmind.com/"><strong>AZMIND</strong></a>,
									customize and use it as you like!
								</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3 form-box">
							<div class="form-top">
								<div class="form-top-left">
									<h3>登陆</h3>
									<p>Enter your username and password to log on:</p>
								</div>
								<div class="form-top-right"></div>
							</div>
							<div class="form-bottom">
								<form id="login_form" role="form" action="route.php?a=login" method="post"
									class="login-form">
									<div class="form-group">
										<label class="sr-only" for="form-username">用户名</label> <input
											name="username" placeholder="Username..."
											class="form-username form-control input-error validate[required,custom[onlyLetterNumber],minSize[3]]"
											id="form-username" type="text">
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-password">密码</label> <input
											name="password" placeholder="Password..."
											class="form-password form-control input-error validate[required,minSize[6]]"
											id="form-password" type="password">
									</div>
									<input name="requri" type="hidden" value=""/>
<!-- 									 type="submit" -->
									<button id="submit" class="btn">登陆</button>
								</form>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3 social-login">
							<h3>...or login with:</h3>
							<div class="social-login-buttons">
								<a class="btn btn-link-2" href="#"> Facebook </a> <a
									class="btn btn-link-2" href="#"> Twitter </a> <a
									class="btn btn-link-2" href="#"> Google Plus </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>