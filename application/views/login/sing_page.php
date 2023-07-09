<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>화원가입</title>
</head>
<body>
<div class="container">
	<h1 class="page-header text-center">회원가입</h1>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="login-panel panel w3-card w3-round">
				<div class="panel-heading" style="background-color: #744697; color: #FFFFFF">
					<h3  style="background-color: #744697; color: #FFFFFF">Sign Up
					</h3>
				</div>
				<div class="panel-body w3-card w3-round w3-white" style="background-color: white; color: #744697">
					<form method="POST" action="">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="닉네임" type="text" name="name" value="<?php echo set_value('name'); ?>" required>
								<span class="text-danger"><?php echo form_error("name"); ?></span>
								<p class="help-block">닉네임을 입력해주세요</p>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="아이디" type="text" name="id" value="<?php echo set_value('id'); ?>" required>
								<span class="text-danger"><?php echo form_error("id"); ?></span>
								<p class="help-block">아이디를 입력하세요</p>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="이메일" type="email" name="email" value="<?php echo set_value('email'); ?>" required>
								<span class="text-danger"><?php echo form_error("email"); ?></span>
								<p class="help-block">이메일을 입력하세요</p>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="비밀번호" type="password" name="password" required>
								<span class="text-danger"><?php echo form_error("password"); ?></span>
								<p class="help-block">비밀번호를 입력해주세요(8자이상)</p>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="비밀번호 확인" type="password" name="passwordt" required>
								<span class="text-danger"><?php echo form_error("passwordt"); ?></span>
								<p class="help-block">비밀번호를 한번 더 입력해주세요</p>
							</div>


							<button type="submit" class="btn btn-lg btn-primary btn-block w3-card w3-round " style="background-color: #744697; color: #FFFFFF">가입하기</button>
							<a  class="btn btn-block" href="<?php echo base_url(); ?>capp/index.php/user">로그인</a>

						</fieldset>
					</form>
				</div>
			</div>
			<?php
			if($this->session->flashdata('error')){
				?>
				<div class="alert alert-danger text-center" style="margin-top:20px;">
					<?php echo $this->session->flashdata('error'); ?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
</body>
</html>
