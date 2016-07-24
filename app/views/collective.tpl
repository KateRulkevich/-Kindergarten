<?=$register->get('err')?>

<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
	<!-- все можно делать -->
	<a href="javascript:void(null);" class="add" onclick="newBoss.style.display='block'">Добавить нового члена администрации</a>
	<form action="<?=URL?>collective/new_boss" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="newBoss" style="display:none">
		<input type="text" name="name" value="" placeholder="ФИО" required><br>
		<input type="text" name="position" value="" placeholder="Должность" required><br>
		<textarea name="quote" value="" placeholder="Цитата"></textarea> <br>
		<textarea name="personal_info" value="" placeholder="Информация"></textarea>
		<br>
		<input type="text" name="tel_number" value="" placeholder="Телефон" required><br>
		<input type="text" name="email" value="" placeholder="E-mail"><br>
		Фото <input type="file" name="photo" value="" placeholder="Загрузить" required><br>
		<input type="submit" name="" value="Сохранить">
		<input type="reset" name="" value="Отмена" onclick="newBoss.style.display='none'">
	</form>
<?php endif ?>

<?php if (is_array($data['bosses'])): ?>
	<?php foreach ($data['bosses'] as $val): ?>
		<div>
			
			<figure>
				<img src="<?=URL?>img/bosses/<?=$val['image_name']?>" />
			</figure>	

			<div class="info_text">
				<div class="article_title"><h2><?=$val['name']?></h2></div>

				<div class="adminis_info">
					<h3><?=$val['position']?></h3>
					<blockquote><p> <?=$val['quote']?></p></blockquote>
					<p><?=$val['personal_info']?></p>

					<div><span class="icon_block">&#9742;</span>&#160;<?=$val['tel_number']?></div>
					<div><span class="icon_block">&#9993;</span>&#160;<?=$val['email']?></div>
				</div><!--end .adminis_info-->

			</div><!--end .info_text-->
			<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
				<!-- эту ссылку тоже двигать, редактировать, вкладывать -->
				<a href="javascript:void(null);" class="update" onclick="change<?=$val['id']?>.style.display='block'">Редактировать</a>
				<?php if ($val['status'] != 'big_boss'): ?>
					<a href="<?=URL?>collective/delete_boss/<?=$val['id']?>" class='delete'>Удалить</a>
				<?php endif ?>

				<form action="<?=URL?>collective/update_boss/<?=$val['id']?>" method="post"  method="post" enctype="multipart/form-data" accept-charset="utf-8" id="change<?=$val['id']?>" style="display:none">
					<input type="text" name="name" value="<?=$val['name']?>" placeholder="ФИО"><br>
					<input type="text" name="position" value="<?=$val['position']?>" placeholder="Должность"><br>
					<textarea name="quote" value="<?=$val['quote']?>" placeholder="Цитата"><?=$val['quote']?></textarea> <br>
					<textarea name="personal_info" value="<?=$val['personal_info']?>" placeholder="Информация"><?=$val['personal_info']?></textarea>
					<br>
					<input type="text" name="tel_number" value="<?=$val['tel_number']?>" placeholder="Телефон"><br>
					<input type="text" name="email" value="<?=$val['email']?>" placeholder="E-mail"><br>
					Фото <input type="file" name="photo" value="<?=$val['image_name']?>" placeholder="Загрузить"><br>
					<input type="submit" name="" value="Сохранить изменения">
					<input type="reset" name="" value="Отмена" onclick="change<?=$val['id']?>.style.display='none'">
				</form>

			<?php endif ?>
		</div>
		
		<div class="clear_block"></div>

	<?php endforeach ?>
<?php endif ?>


<div class="article_title"><h1><span>&nbsp;&nbsp;&nbsp;Педагогический состав&nbsp;&nbsp;&nbsp;</span></h1></div>

<div class="info_text">
	<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

		<a href="javascript:void(null);" data-editor="collectiveEditor" data-action="<?=URL?>handler_edit/update_article/<?= $data['collective']['id_art']?>?>" class="ajax-edit add">Сохранить изменения</a>

		<span class="change_notice">Внимание! Для редактирования заметки необходимо кликнуть по тексту. После внесения изменений нажмите "Сохранить изменения"</span>
		

	<?php endif; ?>

	<div id="collectiveEditor" contenteditable="<?=$editable?>">
		<?=$data['collective']['description']?>
	</div>
	
</div><!--end .info_text-->