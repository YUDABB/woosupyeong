<script>
	// 입력하지 않고 쓰기 버튼을 누르는 경우 처리
	// 폼에 빈 값이 있을 경우 경고메시지를 띄우고 해당 입력폼에 포커스 이동, FALSE를 반환
	$(document.ready(function () {
		if(" #write_btn ").click(function(){
			if($("#input01").val() == ''){
				alert('제목을 입력해주세요.');
				$("#input01").focus();
				return false;
			} else if ($("#input02").val() == ''){
				alert("내용을 입력해주세요");
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
	<form class="form-horizontal" method="post" action="" id="write_action">
		<fieldset>
			<legend>게시물 쓰기</legend>
			<div class="control-group">
				<label class="control-label" for="input01">제목</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="input01" name="m_title" style="width: 100%"
						   value="<?php echo set_value('m_title');?>">
					<p class="help-block">게시물의 제목을 써주세요.</p>
				</div>
				<label class="control-label" for="input02">내용</label>
				<div class="controls">
<textarea class="input-xlarge" id="input02" name="m_contents" rows="10" style="width: 100%">
<?php echo set_value('m_contents');?></textarea>
					<p class="help-block">게시물의 내용을 써주세요.</p>
				</div>
				<div class="controls">
					<p class="help-block"><?php echo validation_errors();?></p>
				</div>
                <br>
				<div class="form-actions w3-center">
					<button type="submit" class="w3-button w3-margin-bottom w3-round" style="border: 1px solid; border-color: darkgray" id="write_btn">작성</button>
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
