<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
	
	
	<div class="change_notice"><?=$register->get('ok')?></div>

<?php else: ?>
	<div class="info_text">
		<div class="top_border"></div><!--end .top_border-->
			<div class="info_wrapper">		
				
					<form action="<?=URL?>admin/login" method="post" accept-charset="utf-8">
			<div>
				<!-- можешь написать другие сообщения, папка models - admin - метод login -->
				<?=$register->get('err')?>
			</div>
			<input type="text" name="login" value="" placeholder="Login" required>
			<input type="password" name="password" value="" placeholder="Password" required>
			<input type="submit" name="" value="Войти">
		</form>
			</div><!--end .info_wrapper-->
		<div class="bottom_border">		</div><!--end .bottom_border-->
	</div><!--end .info_text-->
	
<?php endif ?>




