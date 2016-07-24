<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

	<!-- сообщения при ошибке и удаче -->
	<?=$register->get('ok')?>
	<?=$register->get('err')?>

	<!-- форма добавить группу -->
	<form action="<?=URL?>groups/new_group" method="post" accept-charset="utf-8">
		<input type="text" name="title" value="" placeholder="Название группы">
		<input type="submit" name="" value="Добавить групппу">
	</form>
<?php endif; ?>


<div class="info_text">	

	<div class="accordion-container">
		<?php if (is_array($data)): ?>
			<?php foreach ($data as $val): ?>
				<div class="set">
					<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
						<!-- удалить группу -->
						<span><a href="<?=URL?>groups/delete_group/<?=$val['id_group']?>" class='delete'>Удалить группу</a></span>
					<?php endif; ?>

					<!-- заголовок группы -->
					<a href="javascript:void(null)">
						<?=$val['title']?>

						<i class="fa fa-plus"></i>
					</a>
					<div class="content">
						<div class="dropdown_box" onclick="order<?=$val['id_group']?>.style.display='block';menu<?=$val['id_group']?>.style.display='none';foto<?=$val['id_group']?>.style.display='none'"><h3><img src="<?=URL?>/img/order.png" > Распорядок текущего дня</h3></div>
						<div class="dropdown_box" onclick="menu<?=$val['id_group']?>.style.display='block';order<?=$val['id_group']?>.style.display='none';foto<?=$val['id_group']?>.style.display='none'"><h3><img src="<?=URL?>/img/menu.png"> Меню на сегодня</h3></div>
						<div class="dropdown_box" onclick="foto<?=$val['id_group']?>.style.display='block';menu<?=$val['id_group']?>.style.display='none';order<?=$val['id_group']?>.style.display='none'"><h3><img src="<?=URL?>/img/foto.png"> Фотографии</h3></div>

						<div id="order<?=$val['id_group']?>" style="display:none;padding-top:20px">

							<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

								<a href="javascript:void(null);" data-editor="scheduleEditor<?=$val['id_group']?>" data-action="<?=URL?>handler_edit/update_schedule/<?=$val['id_group']?>" class="ajax-edit add" style="margin-top: 20px;">Сохранить изменения</a>

								<span class="change_notice">Внимание! Для редактирования заметки необходимо кликнуть по тексту. После внесения изменений нажмите "Сохранить изменения"</span>
								
							<?php endif; ?>
							
							<!-- расписание -->
							<div id="scheduleEditor<?=$val['id_group']?>" contenteditable="<?=$editable?>">
								<?=$val['schedule']?>
							</div>
						</div>

						<div id="menu<?=$val['id_group']?>" style="display:none">
							<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

								<a href="javascript:void(null);" data-editor="eatEditor<?=$val['id_group']?>" data-action="<?=URL?>handler_edit/update_eat/<?=$val['id_group']?>" class="ajax-edit add" style="margin-top: 20px;">Сохранить изменения</a>

								<span class="change_notice">Внимание! Для редактирования заметки необходимо кликнуть по тексту. После внесения изменений нажмите "Сохранить изменения"</span>
								
							<?php endif; ?>
							
							<!-- меню -->
							<div id="eatEditor<?=$val['id_group']?>" contenteditable="<?=$editable?>" style="padding-top:20px">
								<?=$val['eat']?>
							</div>
						</div>

						<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
							<script>
								CKEDITOR.inline("scheduleEditor<?=$val['id_group']?>");
								CKEDITOR.inline("eatEditor<?=$val['id_group']?>");
							</script>
						<?php endif; ?>

						<div id="foto<?=$val['id_group']?>" style="display:none;padding-top:20px">

							<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
								<?php if (is_array($val['photos'])): ?>
									<?php foreach ($val['photos'] as $val_photo): ?>
										
										<!-- картинки в админке -->
										<figure>
											<img src="<?=URL?>img/photo_child_group/<?=$val_photo['photo_name']?>">

											<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
												<a href="<?=URL?>groups/delete_photo/<?=$val_photo['id_photo']?>" class='delete'>Удалить</a>
											<?php endif; ?>
										</figure>

									<?php endforeach ?>
								<?php endif ?>
								<form action="<?=URL?>groups/new_photo/<?=$val['id_group']?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
									
									<!-- <input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> -->
									<input type="file" name="photo" value="" placeholder="Загрузить" required>
									<input type="submit" name="" value="Добавить фото">
								</form>
							<?php else: ?>
								<div class="photoContent">
									<div class="gallery">
										<a href="javascript:void(null)" class="ajax-edit slideShowLink user_page" data-success="showGallery" data-action="<?=URL?>groups/get_child_photo/<?=$val['id_group']?>" data-path='photo_child_group/'>Смотреть слайд-шоу</a>
									</div>
									
								</div>
								<!-- слайд-шоу -->
								
							<?php endif; ?>

						</div>
						
						<!-- воспитатели -->
						<h2>Воспитатели:</h2>
						<?php if (is_array($val['educators'])): ?>

							<?php foreach ($val['educators'] as $val_educ): ?>
								<h3><?=$val_educ['name']?></h3>
								<span class="icon_block">&#9742;</span>&#160;<?=$val_educ['tel_number']?>
								<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
									<!-- удалить воспитателя -->
									<a href="<?=URL?>groups/delete_educ/<?=$val_educ['id_educ']?>" class='detail_delete'>&#9746;</a>
								<?php endif; ?>
							<?php endforeach ?>

						<?php endif ?>
						
						<!-- форма добавления воспитателя -->
						<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
							<form action="<?=URL?>groups/new_educ/<?=$val['id_group']?>" method="post" accept-charset="utf-8">
								<input type="text" name="name" value="" placeholder="ФИО">
								<input type="text" name="tel_number" value="" placeholder="Телефон">
								<input type="submit" name="" value="Добавить воспитателя" style="width:200px">
							</form>
						<?php endif; ?>
						
						<!-- помощник воспитателя -->
						<h2>Помощник воспитателя</h2>
						<h3><?=$val['helper']['name']?></h3>
						<span class="icon_block">&#9742;</span>&#160;<?=$val['helper']['tel_number']?><br>
						<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

							<!-- кнопка, чтоб появилась форма для редактирования помощника -->
							<a href="javascript:void(null)" onclick="helper<?=$val['helper']['id_helper']?>.style.display='block'" class="update">Редактировать помощника</a>

							<!-- форма редактировать помощника -->
							<form action="<?=URL?>groups/update_helper/<?=$val['helper']['id_helper']?>" method="post" accept-charset="utf-8" id='helper<?=$val['helper']['id_helper']?>' style="display:none">
								<input type="text" name="name" value="<?=$val['helper']['name']?>" placeholder="ФИО">
								<input type="text" name="tel_number" value="<?=$val['helper']['tel_number']?>" placeholder="Телефон">
								<input type="submit" name="" value="Сохранить изменения" style="width:200px">
								<input type="reset" name="" value="Отмена" onclick="helper<?=$val['helper']['id_helper']?>.style.display='none'">
							</form>

						<?php endif; ?>

						
						<!-- воспитанники -->
						<h2>Cписок воспитанников:</h2>

						<?php if (is_array($val['childs'])): ?>
							<ul>
								<?php foreach ($val['childs'] as $val_child): ?>
									<li><?=$val_child['name']?>
										<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
											<a href="<?=URL?>groups/delete_child/<?=$val_child['id_child']?>" class='detail_delete'>&#9746;</a>
										<?php endif; ?>
									</li>
								<?php endforeach ?>
							</ul>

						<?php endif ?>
						<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

							<!-- форма добавления воспитанника -->
							<form action="<?=URL?>groups/new_child/<?=$val['id_group']?>" method="post" accept-charset="utf-8">
								<input type="text" name="name" value="" placeholder="ФИО">
								<input type="submit" name="" value="Добавить воспитанника"style="width:200px">
							</form>
						<?php endif; ?>

					</div><!--end .content-->
				</div><!--end .set-->
			<?php endforeach ?>
		<?php endif ?>

	</div><!--end .accordion-container-->


</div><!--end .info_text-->