
<section class="align_container">
	<section class="left_content">
		
		<?php 
		$aside_menu = '';
		foreach ($register->get($global_link) as $val) {
			if ($val['link'] == $register->get('ctr')) {
				$title_article = $val['name'];
				if ($register->get('ctr') == 'collective') {
					$title_article = 'Администрация';
				}
			} else {
				$aside_menu .= "<li><a href='".URL.$val['link']."'>".$val['name']."</a></li>";
			}

		}
		?>
		<!-- ЗАГОЛОВОК СТАТЬИ -->
		<div class='article_title'><h1><span>&nbsp;&nbsp;&nbsp;<?=$title_article?>&nbsp;&nbsp;&nbsp;</span></h1></div>

		<?php
		require_once $content_path;
		?>
		
	</section><!--end .left_content-->


	<section class="right_content">

		<div class="info_text">
			<div class="top_border"></div>
			<div class="info_wrapper">
				<div class="article_title"><h1><span>&nbsp;&nbsp;&nbsp;Меню раздела&nbsp;&nbsp;&nbsp;</span></h1></div>
				<ul>
					<?= $aside_menu ?>
				</ul>		
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
