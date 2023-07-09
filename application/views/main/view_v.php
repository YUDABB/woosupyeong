<article class="w3-card w3-round w3-white" id="board_area">
	<div class="w3-col m9">
		<div class="w3-row-padding">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<div>
						<h3>과목명: <?php echo $view->subject_name; ?> (<?php echo $view->subject_value; ?>)</h3>
						<h4>교수명 :<?php echo $view->professor_name; ?></h4>
					</div>
					<a href="<?php echo base_url('/capp/index.php/main/write/');?><?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>"
                       class="w3-button w3-margin-bottom w3-round w3-right" style="background-color: #744697; color: #FFFFFF">평가하기</a>
                    <br><br>
                </div>
            </div>
            <br>
            <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-padding">
                    <h4>수강평</h4>
                    <?php
                    date_default_timezone_set('Asia/Seoul');
                    foreach ($evaluation as $lt) { ?>
                        <div class="w3-container w3-border w3-white w3-padding w3-round-large">
                            <p style="display: inline-block;"><?php echo $lt->e_name; ?></p>
                            <h6 class="w3-opacity" style="display: inline-block; margin-left: 1em"><?php echo $lt->e_date; ?></h6>
                            <div class="w3-right">
                                <?php if ($this->session-> userdata('user') == TRUE) {?>
                                    <?php $udata = $this->session-> userdata('user');
                                    if($udata->uid == $lt->uid) {?>
                                        <a href="<?php echo base_url('/capp/index.php/main/modify/');?><?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">수정</a>
                                        <a href="<?php echo base_url('/capp/index.php/main/delete/');?><?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>?>">삭제</a>
                                    <?php } else {?>
                                        <a></a>
                                        <a></a>
                                    <?php }?>
                                <?php } else {?>
                                    <a></a>
                                    <a></a>
                                <?php }?>
                            </div>
                            <div class="w3-border w3-padding w3-round" style="margin-bottom: 1em"><?php echo $lt->content; ?></div>
                            <?php if($lt->dedate == 1) { ?>
                                <p class="w3-border w3-padding-small w3-round-xxlarge" style="display: inline-block; margin-left: 0.2em; margin-bottom: 0.5em"># 토론</p>
                            <?php } ?>
                            <?php if($lt->group_task == 1) { ?>
                                <p class="w3-border w3-padding-small w3-round-xxlarge" style="display: inline-block; margin-left: 5px; margin-bottom: 8px"># 조별과제</p>
                            <?php } ?>
                            <?php if($lt->announcement == 1) { ?>
                                <p class="w3-border w3-padding-small w3-round-xxlarge" style="display: inline-block; margin-left: 5px; margin-bottom: 8px"># 발표</p>
                            <?php } ?>
                            <?php if($lt->report == 1) { ?>
                                <p class="w3-border w3-padding-small w3-round-xxlarge" style="display: inline-block; margin-left: 5px; margin-bottom: 8px"># 레포트</p>
                            <?php } ?>
                            <?php if($lt->exploration == 1) { ?>
                                <p class="w3-border w3-padding-small w3-round-xxlarge" style="display: inline-block; margin-left: 5px; margin-bottom: 8px"># 답사</p>
                            <?php } ?>
                            <?php if($lt->exam == 1) { ?>
                                <p class="w3-border w3-padding-small w3-round-xxlarge" style="display: inline-block; margin-left: 5px; margin-bottom: 8px"># 시험</p>
                            <?php } ?>
                            <?php if($lt->pf == 1) { ?>
                                <p class="w3-border w3-padding-small w3-round-xxlarge" style="display: inline-block; margin-left: 5px; margin-bottom: 8px"># P/F</p>
                            <?php } ?>
                            <?php if($lt->onli == 1) { ?>
                                <p class="w3-border w3-padding-small w3-round-xxlarge" style="display: inline-block; margin-left: 5px; margin-bottom: 8px"># 온라인</p>
                            <?php } ?>
                            <?php if($lt->blen == 1) { ?>
                                <p class="w3-border w3-padding-small w3-round-xxlarge" style="display: inline-block; margin-left: 5px; margin-bottom: 8px"># 블렌디드</p>
                            <?php } ?>
                            <?php if($lt->cap == 1) { ?>
                                <p class="w3-border w3-padding-small w3-round-xxlarge" style="display: inline-block; margin-left: 5px; margin-bottom: 8px"># 캡스톤</p>
                            <?php } ?>
                        </div>
                        <br>
                    <?php } ?>
                    <div class="w3-center w3-container">
                        <?php echo $pagination2;?>
                    </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</article>
