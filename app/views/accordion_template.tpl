<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

	<form action="<?=URL?>handler_edit/new_advise/<?=$register->get('ctr')?>" method="post" accept-charset="utf-8">
		<input type="text" name="title" value="" placeholder="Заголовок">
		<input type="submit" name="" value="Добавить совет">
	</form>
<?php endif; ?>

<div class="info_text">	

	<div class="accordion-container">

		<?php if (is_array($data)): ?>
			<?php foreach ($data as $val): ?>
				
				<div class="set" id="art-<?=$val['id_art']?>">
					<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
						<span><a href="<?=URL?>handler_edit/delete_advise/<?=$register->get('ctr')?>-<?=$val['id_art']?>" class='delete'>Удалить совет</a></span>
					<?php endif; ?>
					<a href="javascript:void(null)">
						<?=$val['title']?>
						<i class="fa fa-plus"></i>
					</a>
					<div class="content">
						<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

							<a href="javascript:void(null);" data-editor="artEditor<?=$val['id_art']?>" data-action="<?=URL?>handler_edit/update_advise/<?= $val['id_art']?>" class="ajax-edit add">Сохранить изменения</a>
							
							<span class="change_notice">Внимание! Для редактирования заметки необходимо кликнуть по тексту. После внесения изменений нажмите "Сохранить изменения"</span>
							
							
						<?php endif ?>

						<div id="artEditor<?=$val['id_art']?>" contenteditable="<?=$editable?>">
							<?=$val['text']?>
						</div>

						<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
						<script>CKEDITOR.inline("artEditor<?=$val['id_art']?>");</script>
						<?php endif ?>
					</div><!--end .content-->
				</div><!--end .set-->
			<?php endforeach ?>
		<?php endif ?>
		
	</div><!--end .accordion-container-->


</div><!--end .info_text-->