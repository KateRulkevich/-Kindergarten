<div class="info_text">
	<div><img src="../img/icon_map.png">&#160; <?=$contacts['address']?></div>
	<div><span class="icon_block">&#9742;</span>&#160; <?=$contacts['tel_number']?></div>
	<div><span class="icon_block">&#9993;</span>&#160;<?=$contacts['email']?></div>

	<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
	<!-- можно делать все -->
	<a href="javascript:void(null);" class="update" onclick="updateContacts.style.display='block'">Редактировать</a>

	<!-- можно делать все -->
		<form action="<?=URL?>contact/update_contact" method="post" id="updateContacts" style="display:none">
			Адрес&#160;<input type="text" name="address" value="<?=$contacts['address']?>" placeholder="Адрес" required><br>
			Телефоны&#160;<input type="text" name="tel_number" value="<?=$contacts['tel_number']?>" placeholder="Телефоны" required><br>
			E-mail&#160;<input type="text" name="email" value="<?=$contacts['email']?>" placeholder="E-mail" required><br>
			<input type="hidden" name="id" value="<?=$contacts['id_cont']?>">
			<input type="submit" name="" value="Сохранить изменения">
			<input type="reset" name="" value="Отмена" onclick="updateContacts.style.display='none'">
		</form>
	<?php endif; ?>
	

	<img src="<?=URL?>/img/map.png" width="600px" style="margin-top:10px">
</div><!--end .info_text-->



