<div class="info_text">	


	<h3 style="text-align: center;">Уважаемые родители! Здесь Вы можете оставлять свои предложения по улучшению качества работы нашего учреждения!</h3>

	<!-- кнопка для появления формы -->
	<p style="text-align: center;">
		<a href="javascript:void(null)" class="add" onclick="formProposal.style.display='block'">Добавить предложение</a>
	</p>

	<!-- поле сообщения о получении предложения -->
	<div class="field-message" style="text-align:center">
		<?=$register->get('ok')?>
	</div>

	<!-- форма предложения -->
	<div class="send_proposal" id="formProposal" style="display:none">
		<!-- лучше ajax отправлять -->
		<p>Ваше предложение</p>
		<form action="<?=URL?>proposal/new_proposal" method="post" accept-charset="utf-8" id="proposal">
			<input type="text" maxlength="100" name="name" placeholder="Введите Ваше имя" required>
			<textarea name="message" placeholder="Текст сообщения" required></textarea>
			<input type="submit" value="Отправить">
		</form>

	</div><!--end .send_proposal-->

	<?php if (is_array($data)): ?>
		<?php foreach ($data as $val): ?>
			<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') || $val['status'] == 1 && $sess->get('logged_admin') != true):  ?>

				<div class="parents_proposal">
					<h3><?=$val['name']?></h3><span><?=$val['date']?></span>
					<p><?=$val['text_proposal']?></p>

					<div class="like_dislike">

					<!-- лайк -->
						<a href="javascript:void(null)" data-action="<?=URL?>proposal/like/<?=$val['id_proposal']?>" data-editor="good<?=$val['id_proposal']?>" data-success="score" class="ajax-edit"><img src="<?=URL?>img/like.png"></a>
						<span>
							<span id='good<?=$val['id_proposal']?>'>
								<?=$val['good']?>
							</span>&nbsp;
						</span>

					<!-- дизлайк -->
						<a href="javascript:void(null)" data-action="<?=URL?>proposal/dislike/<?=$val['id_proposal']?>" data-editor="bad<?=$val['id_proposal']?>" data-success="score" class="ajax-edit"><img src="<?=URL?>img/dislike.png"></a>
						<span>
							<span id='bad<?=$val['id_proposal']?>'>
								<?=$val['bad']?>
							</span>
						</span>
					</div><!--end .like_dislike-->
					
					<!-- опубликовать -->
					<?php if ($val['status'] == 0 ): ?>
						<span class="update">Новое предложение</span>
						<a href="<?=URL?>proposal/show_proposal/<?=$val['id_proposal']?>" class='add'>Опубликовать</a>
					<?php endif ?>		

					<!-- удалить -->
					<?php if ( $sess->get('logged_admin') == true): ?>
						<a href="<?=URL?>proposal/delete_proposal/<?=$val['id_proposal']?>" class='delete'>Удалить</a>
					<?php endif ?>

				</div><!--end .parents_proposal-->
			<?php endif ?>
		<?php endforeach ?>
	<?php endif ?>



</div><!--end .info_text-->
