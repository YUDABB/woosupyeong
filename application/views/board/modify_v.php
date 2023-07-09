<script>
	$(document).ready(function(){
		$("#write_btn").click(function(){
			if($("#input01").val() == ''){
				alert('제목을 입력해주세요.');
				$("#input01").focus();
				return false;
			} else if($("#input02").val() == ''){
				alert('내용을 입력해주세요.');
				$("#input02").focus();
				return false;
			} else {
				$("#write_action").submit();
			}
		});
	});
</script>
<article class="w3-card w3-round w3-white" id="board_area">
	<div class="w3-col m9">
		<div class="w3-row-padding">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
	<header>
		<h1></h1>
	</header>
	<form class="form-horizontal" method="post" action="" id="write_action">
		<fieldset>
			<legend>게시물 수정</legend>
			<div class="control-group">
				<label class="control-label" for="input01">제목</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="input01" name="b_title" style="width: 100%" value="<?php echo $views->b_title;?>">
					<p class="help-block"></p>
				</div>
				<label class="control-label" for="input02">내용</label>
				<div class="controls">
					<textarea class="input-xlarge" id="input02" name="b_contents" rows="10" style="width: 100%"><?php echo $views->b_contents;?></textarea>
					<p class="help-block"></p>
				</div>
                <br>
				<div class="form-actions w3-center">
					<button type="submit" class="w3-button w3-margin-bottom w3-round" style="border: 1px solid; border-color: darkgray" id="write_btn">수정</button>
					<button class="w3-button w3-margin-bottom w3-round" style="border: 1px solid; border-color: darkgray" onclick="document.location.reload()">취소</button>
				</div>
			</div>
		</fieldset>
	</form>
				</div>
			</div>
		</div>
	</div>
</article>
