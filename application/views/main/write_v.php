<style>
    .star-rating {
        display:flex;
        flex-direction: row-reverse;
        font-size:3.5em;
        justify-content:space-around;
        padding:0 .2em;
        text-align:center;
        width:5em;
    }

    .star-rating input {
        display:none;
    }

    .star-rating label {
        color:#ccc;
        cursor:pointer;
    }

    .star-rating :checked ~ label {
        color:#1746a2;
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color:#5f9df7;
    }
</style>

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
							<legend>평가하기</legend>
							<div class="col-lg-12">
                                <div class="control-group">
                                    <table class="table table-bordered w3-center" style="font-size: 1em">
                                        <label class="control-label">태그</label>
                                <tr>
                                    <td style="width: 3.5em">토론<br><input class="w3-check" type="checkbox" name="dedate"></td>
                                    <td style="width: 3.5em">조별과제<br><input class="w3-check" type="checkbox" name="group_task"></td>
                                    <td style="width: 3.5em">발표<br><input class="w3-check" type="checkbox" name="announcement"></td>
                                    <td style="width: 3.5em">레포트<br><input class="w3-check" type="checkbox" name="report"></td>
                                    <td style="width: 3.5em">답사<br><input class="w3-check" type="checkbox" name="exploration"></td>
                                </tr>
                                <tr>
                                    <td>시험<br><input class="w3-check" type="checkbox" name="exam"></td>
                                    <td>P/F<br><input class="w3-check" type="checkbox" name="pf"></td>
                                    <td>온라인<br><input class="w3-check" type="checkbox" name="onli"></td>
                                    <td>블렌디드<br><input class="w3-check" type="checkbox" name="blen"></td>
                                    <td>캡스톤<br><input class="w3-check" type="checkbox" name="cap"></td>
                                </tr>
                                    </table>
                                    <p class="help-block">강의에 해당하는 것을 선택해주세요.</p>
                                </div>
                                <br>
								<label class="control-label" for="input02">너의 생각</label>
								<div class="controls">
                                <textarea class="input-xlarge" id="input02" name="content" rows="10" style="width: 100%"></textarea>
									<p class="help-block">게시물의 내용을 써주세요.</p>
								</div>
                                <br>
                                <label class="control-label">별점</label>
                                <div class="star-rating controls">
                                    <input type="radio" id="5-stars" name="rating" value="5" />
                                    <label for="5-stars" class="star">&#9733;</label>
                                    <input type="radio" id="4-stars" name="rating" value="4" />
                                    <label for="4-stars" class="star">&#9733;</label>
                                    <input type="radio" id="3-stars" name="rating" value="3" />
                                    <label for="3-stars" class="star">&#9733;</label>
                                    <input type="radio" id="2-stars" name="rating" value="2" />
                                    <label for="2-stars" class="star">&#9733;</label>
                                    <input type="radio" id="1-star" name="rating" value="1" />
                                    <label for="1-star" class="star">&#9733;</label>
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
