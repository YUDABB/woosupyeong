<script>
	$(document).ready(function(){
		$("#search_btn").click(function(){  //검색 기능을 누르면
			if($("#q").val() == ''){
				alert('검색어를 입력해주세요.');
				return false;
			} else { // 검색어를 포함한 주소를 만들어서 POST 전송 --> get_list로 보내기
				var act = '/capp/index.php/mboard/lists/m_board/q/'+$("#q").val()+'/page/1';
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
                        <form style="text-align: center; display: block" action="index.php?route=free/sech" id="bd_search" method="post">
                            <select name="sech" class="w3-border w3-padding w3-center" style="width: 20%; min-width: 90px">
                                <option value="ftext">제목</option>
                                <option value="name">작성자</option>
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
					<h2>문의게시판</h2>
				<table cellspacing="0" cellpadding="0" class="table table-striped">
					<thead>
					<tr>
						<th scope="col">번호</th><th scope="col">제목</th><th scope="col">작성자</th><th scope="col">조회수</th><th scope="col">작성일</th>
					</tr>
					</thead>
					<tbody>
					<?php
					date_default_timezone_set('Asia/Seoul');
					foreach ($list as $lt) {
						?>
						<tr>
							<th scope="row">
								<?php echo $lt->m_id; ?>
							</th>
							<td><a rel="external" href="<?php echo base_url('/capp/index.php/');?><?php echo $this->uri->segment(1); ?>/view/<?php echo $this->uri->segment(3); ?>/<?php
								echo $lt-> m_id;?>/page/<?php echo $this->uri->segment(5);?> ">
									<?php echo $lt->m_title; ?></a></td>
							<td><?php echo $lt->m_name; ?></td>
							<td><?php echo $lt->m_views; ?></td>
							<td><?php echo $lt->m_date; ?></td>
						</tr>
						<?php } ?>
					<tr><th colspan="5"><a href="<?php echo base_url('/capp/index.php/mboard/write/');?><?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(5);?>"
                                           class="w3-button w3-round w3-right" style="background-color: #744697; color: #FFFFFF">쓰기</a></th> </tr>
					</tbody>
					<tfoot>
                    <tr>
                        <th class="w3-center" colspan="5"><?php echo $pagination;?></th>
                    </tr>
					</tfoot>
				</table>
				</div>
			</div>
		</div>
	</div>
	</div>
</article>
