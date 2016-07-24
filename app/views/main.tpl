<section class="align_container">

	<section class="left_content">
		<div class="info_text">
			<div class="article_title"><h1><span>&nbsp;&nbsp;&nbsp;<?= $data['about']['title']?>&nbsp;&nbsp;&nbsp;</span></h1></div>
			
			<div>
			
				<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

					<a href="javascript:void(null);" data-editor="aboutNoticeEditor" data-action="<?=URL?>handler_edit/update_notice/<?=$data['about']['id_art']?>" class="ajax-edit add">Сохранить изменения</a>

					<span class="change_notice">Внимание! Для редактирования заметки необходимо кликнуть по тексту. После внесения изменений, нажмите "Сохранить изменения"</span>
					
				<?php endif ?>
				<div id="aboutNoticeEditor" contenteditable="<?=$editable?>" >
					<?= $data['about']['notice_art']?>
				</div>
				
				
			</div>

			<div class="more_button"><a href="<?=URL?>about_us">Подробнее...</a>
			</div>


			
		</div><!--end .info_text-->

		<div class="info_text">

			<div class="article_title"><h1><span>&nbsp;&nbsp;&nbsp;<?= $data['extra_course']['title']?>&nbsp;&nbsp;&nbsp;</span></h1></div>

			<div data-index="<?= $data['extra_course']['id_art']?>" data-action="main/save_notice_art" data-define="parent-text">
			
			<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

				<a href="javascript:void(null);" data-editor="courseNoticeEditor" data-action="<?=URL?>handler_edit/update_notice/<?=$data['extra_course']['id_art']?>" class="ajax-edit add">Сохранить изменения</a>

					<span class="change_notice">Внимание! Для редактирования заметки необходимо кликнуть по тексту. После внесения изменений, нажмите "Сохранить изменения"</span>
					
				<?php endif ?>
				<div id="courseNoticeEditor" contenteditable="<?=$editable?>">
					<?= $data['extra_course']['notice_art']?>
				</div>
				
			</div>
			<div class="more_button"><a href="<?=URL?>extra_course">Подробнее...</a></div>
			
		</div><!--end .info_text-->

		<div class="info_text">

			<div class="article_title"><h1><span>&nbsp;&nbsp;&nbsp;Последние новости&nbsp;&nbsp;&nbsp;</span></h1></div>
			
			<?php if (is_array($data['last_news'])): ?>
				
				<?php foreach ($data['last_news'] as $val): ?>
					<div class="full_news">
						<figure><img src="<?=URL?>img/news/<?=$val['image_name']?>"> 

							<figcaption><h3><?=$val['date']?></h3></figcaption>
						</figure>
						<div class="news_description">

							<h2><?=$val['title']?></h2>
							<?=$val['news_text']?>
						</div><!--end .news_description-->
					</div><!--end .full_news-->
				<?php endforeach ?>

			<?php endif ?>

			
			<div class="more_button"><a href="<?=URL?>news">Все новости... </a></div>
		</div><!--end .info_wrapper-->	

	</section><!--end .left_content-->


	<section class="right_content">

		<div class="info_text">
			<div class="top_border"></div>
			<div class="info_wrapper">
				<div class="article_title"><h1><span>&nbsp;&nbsp;&nbsp;Заведующий&nbsp;&nbsp;&nbsp;</span></h1></div>
				<div class="adminis_block">
					<div class="adminis_info">

						<h2><?= $data['big_boss']['name']?> </h2>
						<blockquote><p><?= $data['big_boss']['quote']?></p></blockquote>
						<div><img src="<?=URL?>img/icon_time.png" style="float: left;"><?= $data['big_boss']['working_time']?> </div>
					</div>
					<div><span class="icon_block">&#9742;</span>&#160;<?= $data['big_boss']['tel_number']?></div>
					<div><span class="icon_block">&#9993;</span>&#160;<?= $data['big_boss']['email']?></div>

				</div><!--end .adminis_info-->
			</div><!--end .adminis_block-->	
			
		</div><!--end .info_wrapper-->	
		<div class="bottom_border"></div>		
	</div><!--end .info_text-->


	<div class="info_text">
		<div class="top_border"></div>
		<div class="info_wrapper">
			<div class="article_title"><a href="template/foto.html"><h1><span>&nbsp;&nbsp;&nbsp;Фотогалерея&nbsp;&nbsp;&nbsp;</span></h1></a></div>
			<figure>
				<img src="img/room.png">

				<figcaption><h3>Наши группы</h3></figcaption>
			</figure>	
			<figure>
				<img src="img/swimming.png">

				
				<figcaption><h3>Наш бассейн</h3></figcaption>
			</figure>	

			<figure>
				<img src="img/musik_hall.png">

				
				<figcaption><h3>Музыкальный зал</h3></figcaption>
			</figure>

			<figure>
				<img src="img/sport_hall.png">

				
				<figcaption><h3>Спортивный зал</h3></figcaption>
			</figure>
			<div class="more_button"><a href="<?=URL?>photo">Подробнее...</a></div>
		</div><!--end .info_wrapper-->	
		<div class="bottom_border"></div>		
	</div><!--end .info_text-->

	<div class="info_text">
		<div class="top_border"></div>
		<div class="info_wrapper">

			<div class="article_title"><h1><span>&nbsp;&nbsp;&nbsp;Вакансии&nbsp;&nbsp;&nbsp;</span></h1></div>
			<p>В настоящее время в нашем учреждении открыта вакансия на позицию <h2 style="text-align: center;"><?=$data['last_job']?></h2></p>
			<div class="more_button"><a href="<?=URL?>jobs">Подробнее...</a></div>
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

<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
	<script>
		CKEDITOR.inline('aboutNoticeEditor');
		CKEDITOR.inline('courseNoticeEditor');
	</script>
<?php endif ?>