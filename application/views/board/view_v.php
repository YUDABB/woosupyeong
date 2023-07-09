<script>
    $(function() {
        if("#comment_add").click(function () {
            if($("#input01").val() == ''){
                alert('댓글을 입력해주세요');
                $("#input01").focus();
                return false;}
            else {
                $("#comment_action").submit();
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
	<table cellspacing="0" cellpadding="0" class="table table-striped" >
		<thead>
		<tr>
			<th scope="col"> <?php echo $views->b_title; ?></th>
			<th scope="col">이름 : <?php echo $views->b_name; ?></th>
			<th scope="col">조회수 : <?php echo $views->b_views; ?></th>
			<th scope="col"> 등록일 : <?php echo $views->b_date; ?></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th colspan="4" class="w3-padding-16" style="height: 300px"><?php echo $views->b_contents; ?></th>
		</tr>
		</tbody>
		<tfoot>
		<tr>
			<th colspan="4">
				<a href="<?php echo base_url('/capp/index.php/board/lists/');?><?php echo $this->uri->segment(3);?>"
                   class="w3-button w3-round" style="border: 1px solid; border-color: darkgray">목록</a>
                <?php if ($this->session-> userdata('user') == TRUE) {?>
                    <?php $udata = $this->session-> userdata('user');
                        if($udata->uid == $views->uid) {?>
                            <a href="<?php echo base_url('/capp/index.php/board/modify/');?><?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>"
                               class="w3-button w3-round" style="border: 1px solid; border-color: darkgray">수정</a>
                            <a href="<?php echo base_url('/capp/index.php/board/delete/');?><?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>"
                               class="w3-button w3-round" style="border: 1px solid; border-color: darkgray">삭제</a>
                        <?php } else {?>
                            <a></a>
                            <a></a>
                        <?php }?>
                <?php } else {?>
                        <a></a>
                        <a></a>
                <?php }?>
                <a href="<?php echo base_url('/capp/index.php/board/write/');?><?php echo $this->uri->segment(3);?>"
                   class="w3-button w3-round" style="background-color: #744697; color: #FFFFFF">쓰기</a></th>
		    </tr>
		</tfoot>
	</table>
        <form class="form-horizontal" method="POST" action="" id="comment_action" name="com_add">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="input01">댓글</label>
                    <p class="help-block">욕설/비속어 등 남을 비방하는 말은 자제해주세요.</p>
                    <textarea class="input-xlarge" id="input01" name="c_contents" rows="5" style="width: 100%"></textarea>
                    <input class="w3-button w3-round w3-right w3-margin-bottom" style="background-color: #744697; color: #FFFFFF" type="submit" id="comment_add" value="작성" />
                </div>
            </fieldset>
        </form>
        <div id="comment_area">
            <table cellspacing="0" cellpadding="0" class="table table-striped">
                <tbody >
                <?php
                foreach ($comment_list as $lt) {
                    ?>
                    <tr>
                        <th class="w3-padding"><?php echo $lt->c_name;?> (<?php echo $lt->c_date;?>)</th>
                    </tr>
                    <tr>
                        <th class="w3-padding-16"><?php echo $lt->c_contents;?></th>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            </div>
			</div>
		</div>
	</div>
</article>
