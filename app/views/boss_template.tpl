
<section class="align_container">
	<section class="left_content photoContent">
		<div class="article_title"><h1><span>&nbsp;&nbsp;&nbsp;<?=$global_title?>&nbsp;&nbsp;&nbsp;</span></h1></div>

		<?php require_once $content_path; ?>
		
	</section><!--end .left_content-->


	<section class="right_content">


		<!-- сделать вывод заведующей -->

		<?php 
		$big_boss = $register->get('big_boss');
		?>
		<div class="info_text">
			<div class="top_border"></div>
			<div class="info_wrapper">
				<div class="article_title"><h1><span>&nbsp;&nbsp;&nbsp;Заведующий&nbsp;&nbsp;&nbsp;</span></h1></div>
				<div class="adminis_block">
					<div class="adminis_info">
						<h2><?=$big_boss['name']?></h2>
						<div><img src="<?=URL?>img/icon_time.png" style="float: left;"><?= $big_boss['working_time']?> </div>
					</div>
					<div><span class="icon_block">&#9742;</span>&#160;<?= $big_boss['tel_number']?></div>
					<div><span class="icon_block">&#9993;</span>&#160;<?= $big_boss['email']?></div>

				</div><!--end .adminis_info-->
			</div><!--end .adminis_block-->	

		</div><!--end .info_wrapper-->	
		<div class="bottom_border"></div>		
	</div><!--end .info_text-->



	<div class="info_text">
		<div class="top_border"></div>
		<div class="info_wrapper">
			<div class="article_title"><h1><span>&nbsp;&nbsp;&nbsp;Поиск по сайту&nbsp;&nbsp;&nbsp;</span></h1></div>
			<form>
				<input type="search">
				<input type="submit" value="Найти">
			</form>

		</div><!--end .info_wrapper-->	
		<div class="bottom_border"></div>		
	</div><!--end .info_text-->
	
	
</section><!--end .right_content-->
</section><!--end .align_container-->
