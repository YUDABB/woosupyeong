<!DOCTYPE html>
<html>
<head>
	<title>우수평</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
		html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
	</style>
</head>
<script>
	// Accordion
	function myAccFunc(a) {
		var x = document.getElementById(a);
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
		} else {
			x.className = x.className.replace(" w3-show", "");
		}
	}

	// Script to open and close sidebar
	function w3_open() {
		document.getElementById("mySidebar").style.display = "block";
	}

	function w3_close() {
		document.getElementById("mySidebar").style.display = "none";
	}
</script>
<body class="w3-theme-l5">

<!-- 헤더 -->
<header class="w3-display-container w3-content w3-wide" style="max-width:950px;">
    <div class="w3-hide-small" style="margin-top: 2em; margin-bottom: 2em" onclick="document.location.reload()">
        <img class="w3-image" src = "<?php echo base_url('/capp/');?>media/img/woosupyeong_header.png" alt="우수평">
    </div>
    <div class="w3-hide-medium w3-hide-large" style="margin: 2em" onclick="document.location.reload()">
        <img class="w3-image" src = "<?php echo base_url('/capp/');?>media/img/woosupyeong_header.png" alt="우수평">
    </div>
</header>

<!-- 페이지 구성 -->
<div class="w3-container w3-content" >
	<div class="w3-row">
		<div class="w3-col m3 w3-hide-small">
			<!-- 프로필화면 -->
			<div class="w3-card w3-round w3-white">
				<div class="w3-container">
					<?php
					if ($this->session-> userdata('user') == TRUE) {?>
                        <h4 class="w3-center">내 프로필</h4>
                        <p class="w3-center"><img class="w3-image w3-circle" src = "<?php echo base_url('/capp/');?>images/basic.png" alt="기본이미지" style="height: 10em"></p>
                        <hr>
                        <p><i class="fa fa-user fa-fw w3-margin-right" style="color:#744697;"></i><?php $udata = $this->session->userdata('user'); echo $udata->name;?></p>
                        <p><i class="fa fa-book fa-fw w3-margin-right" style="color:#744697;"></i>평가글 갯수</p>
                        <p><i class="fa fa-commenting fa-fw w3-margin-right" style="color:#744697;"></i>댓글 갯수</p>
					    <a href="<?php echo base_url(); ?>capp/index.php/user/logout" class="w3-bar w3-button w3-round" style="background-color: #744697; color: #FFFFFF">Logout</a>
					<?php } else { ?>
                        <h4 class="w3-center">로그인</h4>
                        <a href="<?php echo base_url();?>capp/index.php/user"class="w3-bar w3-button w3-round" style="background-color: #744697; color: #FFFFFF">Login</a>
                        <p></p>
                        <a href="<?php echo base_url(); ?>capp/index.php/user/regist" class="w3-bar w3-button w3-round" style="background-color: #744697; color: #FFFFFF">우수평 가입하기</a>
                    <?php }?>
				</div>
				<br>
			</div>
			<br>

			<!-- 게시판부분 -->
			<div class="w3-card w3-round w3-white">
				<div class="w3-container">
                    <h6 class="w3-opacity">게시판</h6>
					<p>
					<div class="w3-card w3-round">
						<div class="w3-white">
							<a href="<?php echo base_url(); ?>capp/index.php/board/lists/f_board/page/1" class="w3-button w3-block w3-left-align" style="background-color: #BEAEE2; color: #744697"><i class="fa fa-users fa-fw w3-margin-right"></i>자유게시판</a>
							<a href="<?php echo base_url(); ?>capp/index.php/mboard/lists/m_board/page/1" class="w3-button w3-block w3-left-align" style="background-color: #BEAEE2; color: #744697"><i class="fa fa-users fa-fw w3-margin-right"></i>문의게시판</a>
						</div>
					</div>
					</p>
				</div>
			</div>
			<br>

			<!-- 태그 -->
			<div class="w3-card w3-round w3-white">
				<div class="w3-container">
                    <h6 class="w3-opacity">수강신청 가이드</h6>
					<p>
					<div class="w3-card w3-round">
						<div class="w3-white">
                            <a href="<?php echo base_url(); ?>capp/index.php/main/lists/professor/page/1" class="w3-button w3-block w3-left-align" style="background-color: #BEAEE2; color: #744697"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>전체보기</a>
                            <a href="<?php echo base_url(); ?>capp/index.php/main/enrolment/1" class="w3-button w3-block w3-left-align" style="background-color: #BEAEE2; color: #744697"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>수강신청</a>
                            <a href="<?php echo base_url(); ?>capp/index.php/main/education/1" class="w3-button w3-block w3-left-align" style="background-color: #BEAEE2; color: #744697"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>교육과정</a>
                            <a href="<?php echo base_url(); ?>capp/index.php/main/enrolment/1" class="w3-button w3-block w3-left-align" style="background-color: #BEAEE2; color: #744697"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>졸업안내</a>
                            <a href="<?php echo base_url(); ?>capp/index.php/main/enrolment/1" class="w3-button w3-block w3-left-align" style="background-color: #BEAEE2; color: #744697"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>전공학위안내</a>
                            <a href="<?php echo base_url(); ?>capp/index.php/main/enrolment/1" class="w3-button w3-block w3-left-align" style="background-color: #BEAEE2; color: #744697"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>교양학사제</a>

                        </div>
					</div>
					</p>
				</div>
			</div>
			<!-- End Left Column -->
		</div>
