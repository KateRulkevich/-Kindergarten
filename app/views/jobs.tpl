<?php 

// print_r($data) ?>
<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
	<!-- можно делать все -->
	<a href="javascript:void(null);" class="add" onclick="newJob.style.display='block'">Создать вакансию</a>

	<!-- можно делать все -->
	<form action="<?=URL?>jobs/new_job/" method="post" id="newJob" style="display:none">
		<input type="text" name="title" value="" placeholder="Вакансия" required><br>
		<textarea name="text" placeholder='Описание'></textarea><br>
		<input type="submit" name="" value="Опубликовать">
		<input type="reset" name="" value="Отмена" onclick="newJob.style.display='none'">
	</form>
<?php endif; ?>

<div class="info_text">	
	<p>В настоящее время в нашем учреждении открыты вакансии на позиции:</p>

	<?php if (is_array($data['jobs'])): ?>
		<?php foreach ($data['jobs'] as $val): ?>
			<div class="vacancy_proposal">
				<h2 style="text-align: center;"><?=$val['title']?></h2>
				<p><?=$val['text']?></p>
				
				<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
					<!-- можно делать все -->
					<a href="javascript:void(null);" class="update" onclick="updateJob<?=$val['id_job']?>.style.display='block'">Редактировать</a>
					<!-- эту ссылку тоже двигать, редактировать, вкладывать -->
					<a href="<?=URL?>jobs/delete_job/<?=$val['id_job']?>" class='delete'>Удалить</a>

					<!-- можно делать все -->
					<form action="<?=URL?>jobs/update_job/<?=$val['id_job']?>" method="post" id="updateJob<?=$val['id_job']?>" style="display:none">
						<input type="text" name="title" value="<?=$val['title']?>" placeholder="Вакансия" required><br>
						<textarea name="text"><?=$val['text']?></textarea><br>
						<input type="submit" name="" value="Сохранить изменения">
						<input type="reset" name="" value="Отмена" onclick="updateJob<?=$val['id_job']?>.style.display='none'">
					</form>
				<?php endif; ?>
			</div><!--end .vacancy_proposal-->
			<br>
		<?php endforeach ?>
	<?php endif ?>
	

	<p style="margin-bottom: 20px">По вопросам трудоустройства обращаться к заведующему
		<span class="icon_block">&#160;&#160;&#9742;</span>&#160; <?=$data['tel_number']?>
	</p>
	<div class="accordion-container">
		<div class="set">
			<a href="javascript:void(null)">Преимущества работы у нас<i class="fa fa-plus"></i></a>
			<div class="content">
				<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

					<a href="javascript:void(null);" data-editor="artJobEditor" data-action="<?=URL?>handler_edit/update_article/<?=$data['art_jobs']['id_art']?>" class="ajax-edit add">Сохранить изменения</a>
					
					<!-- можно делать все -->
					<span class="change_notice">Внимание! Для редактирования заметки необходимо кликнуть по тексту. После внесения изменений нажмите "Сохранить изменения"</span>
					<!-- можно делать все -->
					
				<?php endif ?>
				<div id="artJobEditor" contenteditable="<?=$editable?>">
					<?=$data['art_jobs']['description']?>
				</div>
			</div><!--end .content-->
		</div><!--end .set-->

	</div><!--end .accordion-container-->


</div><!--end .info_text-->

<script>
CKEDITOR.inline('artJobEditor');
</script>