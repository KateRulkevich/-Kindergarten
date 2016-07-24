
<div class='info_text'>

		<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
			<a href="javascript:void(null);" data-editor="articleEditor" data-action="<?=URL?>handler_edit/update_article/<?= $data['id_art']?>" class="ajax-edit add">Сохранить изменения</a>

			<span class="change_notice">Внимание! Для редактирования заметки необходимо кликнуть по тексту. После внесения изменений нажмите "Сохранить изменения"</span>
			
		<?php endif ?>

		<div id="articleEditor" contenteditable="<?=$editable?>">
			<?= $data['description']?>
		</div>

</div>

<script>
CKEDITOR.inline('articleEditor');
</script>