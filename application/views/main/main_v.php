<script>
	$(document).ready(function(){
		$("#search_btn").click(function(){  //검색 기능을 누르면
			if($("#q").val() == ''){
				alert('검색어를 입력해주세요.');
				return false;
			} else { // 검색어를 포함한 주소를 만들어서 POST 전송 --> get_list로 보내기
				var act = '/capp/index.php/main/lists/professor/q/'+$("#q").val()+'/page/1';
				//웹서버에서는 전체 url(http://... ) 명시
				$("#bd_search").attr('action', act).submit();
			}
		});
	});
	//검색어 입력후 엔터키를 입력하면 검색 버튼을 누른 것과 동일한 효과를 내도록 함
	function board_search_enter(form) {
		var keycode = window.event.keyCode;
		if(keycode == 13) $("#search_btn").click();
	}
</script>

<article class="w3-card w3-round w3-white" id="board_area">
	<div class="w3-col m9">
        <div class="w3-row-padding">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-padding">
                    <h6 class="w3-opacity">수강과목 검색</h6>
                    <div id="search">
                        <form style="text-align: center; display: block" id="bd_search" method="post">
                            <select name="sech" class="w3-border w3-padding w3-center" style="width: 20%; min-width: 90px">
                                <option value="ftext">과목명</option>
                                <option value="name">교수명</option>
                            </select>
                            <input type="text" name="search_word" id="q" required="required" onkeypress="board_search_enter(document.q);" contenteditable="true" class="w3-border w3-padding" style="width:50%" placeholder="검색어를 입력하세요"/>
                            <button id="search_btn" class="w3-button w3-left-align" style="width: 10%; min-width: 85px; background-color: #744697; color: #FFFFFF"><i class="fa fa-search"></i> 검색</button>
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<br>
		<div class="w3-row-padding">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h2 class="w3-opacity">수강 평가 게시판</h2>
	                <?php
                    date_default_timezone_set('Asia/Seoul');
                    foreach ($list as $lt) {
                    ?>
                        <div class="w3-third">
                            <div class="w3-container w3-card w3-white" style="margin: 0.5em; height: 13.5em">
                                <h4><?php echo $lt->subject_name; ?></h4>
                                <h5 class="w3-opacity"><?php echo $lt->professor_name; ?></h5>
                                <p><?php echo $lt->subject_value; ?></p>
                                <br>
                                <?php if (mb_strlen($lt->subject_name,'utf-8') <= 10) {?>
                                    <br>
                                <?php } else { ?>
                                    <div class="w3-hide-large"><br></div>
                                <?php }?>
                                <a href="<?php echo base_url('/capp/index.php/');?><?php echo $this->uri->segment(1); ?>/view/<?php echo $this->uri->segment(3); ?>/<?php
                                echo $lt->sub_id;?>/page/<?php echo $this->uri->segment(5);?>" class="w3-button w3-block w3-margin-bottom w3-round" style="border: 1px solid; border-color: darkgray">수강평 보기</a>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="w3-center w3-container">
                        <?php echo $pagination;?>
                    </div>
                </div>
		    </div>
	    </div>
	</div>
</article>
