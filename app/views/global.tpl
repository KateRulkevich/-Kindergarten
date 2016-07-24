<?php
if (session_name()) {
	$sess = \Session::init();
}
$editable = "false";
if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin')) {
	$editable="true";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$header['title']?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="keywords" content="<?=$header['keywords']?>" />
	<meta name="description" content="<?=$header['description']?>" />
	<meta name="title" content="<?=$header['title']?>" />
	<link rel="shortcut icon" href="img/x-icon.png" type="image/png">
	<link rel="stylesheet" href="<?=URL?>css/totalStyle.css" type="text/css" />
	<link rel="stylesheet" href="<?=URL?>css/<?=$this->css?>.css" type="text/css" />

	<?php if ($register->get('ctr') == "groups" || $register->get('ctr') == "photo"): ?>
		<link rel="stylesheet" href="<?=URL?>js/libs/flexSlider/flexslider.css" type="text/css" />
	<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.3/less.min.js"></script> -->
	<!-- <link rel="stylesheet/less" type="text/css" href="<?=URL?>js/libs/flexSlider/flexslider.less"> -->
	
	<?php endif ?>
	
	<script src="<?=URL?>js/libs/jquery.js" type="text/javascript" charset="utf-8"></script>

	<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
		<script src="<?=URL?>js/libs/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8">
			CKEDITOR.disableAutoInline = true;
		</script>

	<?php endif ?>
	
	<link rel="shortcut icon" href="<?=URL?>img/x-icon.png" type="image/x-icon">
	<script type="text/javascript">
		function Menu(id)
		{
			var menu = document.getElementById('menu_' + id).style;
			if (menu.display == 'none')
			{
				menu.display = 'block';

			}
			else
			{
				menu.display = 'none';
			}
		}
	</script>

</head>

<body>


	<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
		<div style="text-align:right; position:absolute; right: 20px; top: 7px;"><a href="<?=URL?>admin/logout" style="color: #A63312">Выйти</a></div>
	<?php endif ?>
	<header>
	<!--	<div class="button_line">

			<div class="touch_button search">&#128269;</div>
			<div class="touch_button telephone">&#9742;</div>
			<div class="touch_button email">&#9993;</div>

		</div><!--end .button_line-->

		<div class="menu_bg_line"></div><!--end .menu_bg_line-->
		<section class="align_logo_menu">
				<div class="logo">
					<a href="<?= URL ?>"><img src="<?= URL?>img/logo.png" alt="">	
					
							
							</a>
				</div><!--end .logo-->

			<nav>
				<ul>
					
					<?php if (is_array($register->get('links_main'))): ?>

						<?php foreach ($register->get('links_main') as $val): ?>

							<?php 
							$class ='';
							if ($val['R1'] === $header['R1']) {
								$class = "class='active'";
								$global_title = $val['name'];
								$global_link = $val['link'];
							}
							?>

							<?php if ($val['link'] == 'about' || $val['link'] == 'parents'): ?>
								<li <?=$class?>><a href='javascript:void(null)'><?=$val['name']?></a>
									<ul>
										<?php foreach ($register->get($val['link']) as $val_extra_menu): ?>
											<li><a href="<?=URL?><?=$val_extra_menu['link']?>"><?=$val_extra_menu['name']?></a></li>
										<?php endforeach ?>
									</ul>
								</li>
							<?php else: ?>
								<li <?=$class?> ><a href="<?=URL?><?=$val['link']?>"><?=$val['name']?></a>
								<?php endif ?>
								
							<?php endforeach ?>
						<?php endif ?>

					</ul>
				</nav>

				<div class="clear_block"></div>

				<!-- если контроллер главной страницы, то выводим блок с картинкой -->
				<?php if ($register->get('ctr') == 'main'): ?>
					<div class="slogan_block">
						<p>«Лучший способ сделать ребенка хорошим – это сделать его счастливым»</p>
						<p>Оскар Уайльд</p>
					</div>
					<div class="foto_block"><img src="<?=URL?>img/40703_615.png"></div>
				<?php endif ?>

			</section>
		</header>


		<section class="main_container">

			<?php 
			if (is_null($this->template_2)) {
				require_once $content_path;
			} else {
				require_once 'app/views/'.$this->template_2.'.tpl';	
			}

			?>
			
			<!-- в это поле выводится сообщение при получении ответа по ajax
			главное сохранить класс field-message-user, а так можно все делать и перемещать
			эффект красивого появления можно добавить в файле ajaxSender стр 87
			текст для сообщения от боковой формы в Model метод feedback-->
			<div class="field-message-user">
			</div>

			<div class="send_message" id="sendMessage">
				<p id="targetSendMessage">Отправить сообщение</p>
				<form action="<?=URL?>main/feedback" method="post" accept-charset="utf-8" name="message" class="ajax">
					
					<input type="email" maxlength="100" name="email" placeholder="Введите e-mail" required data-validator="email">
					<input type="text" maxlength="100" name="name" placeholder="Введите Ваше имя" required>
					<textarea name="message" placeholder="Текст сообщения" required></textarea>
					<input type="submit" value="Отправить">
				</form>
			</div><!--end .send_message-->

		</section><!--end .main_container-->



		<footer>
			<section class="align_container">
				<div class="align_block">


					<div class="footer_block">
						<div>Контакты</div>
						<div>адрес: <?=$contacts['address']?></div>
						<div>телефон: <?=$contacts['tel_number']?></div>
						<div>e-mail: <?=$contacts['email']?></div>
					</div><!--end .footer_block-->


					<div class="footer_block">
						<div>Регистрационное свидетельство: №1141606185 от 06.01.2016</div>
						<div>&#169; Все права защищены</div>
						<div>designed by Rulkevich K.</div>
					</div><!--end .footer_block-->
				</div>
			</section><!--end .align_container-->
		</footer>
		<!--end .bottom_container-->
		
		
		<?php if (!empty($this->js)): ?>
			<script src="<?=URL?>js/<?=$this->js?>.js" type='text/javascript' charset='utf-8'></script>
		<?php endif ?>
		
		<script src="<?=URL?>js/ajaxSender.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?=URL?>js/global-scripts.js" type="text/javascript" charset="utf-8"></script>

	</body>

	</html>