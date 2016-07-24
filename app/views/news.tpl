<!-- сообщение об ошибке с ними можно все делать -->
<?=$register->get('err')?>

<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
	<!-- все можно делать -->
	<a href="javascript:void(null);" class="add" onclick="newNews.style.display='block'">Добавить новость</a>
	<form action="<?=URL?>news/new_news" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="newNews" style="display:none">
		<input type="text" name="title" value="" placeholder="Заголовок" required><br>
		<textarea name="news_text" value="" placeholder="Текст новости" required></textarea> <br>

		<!-- надо подумать.эта штука не выдает ошибку, просто не грузит -->
		<!-- <input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> -->
		<input type="file" name="photo" value="" placeholder="Загрузить" required><br>
		<input type="submit" name="" value="Опубликовать новость">
		<input type="reset" name="" value="Отмена" onclick="newNews.style.display='none'">
	</form>
<?php endif ?>

<?php if (is_array($data)): ?>
	<?php foreach ($data as $val): ?>
		

		<div class="info_text">	
			
			<div class="full_news">
				<figure><img src="<?=URL?>/img/news/<?=$val['image_name']?>"> 

					<figcaption><h3><?=$val['date']?></h3></figcaption>
				</figure>
				<div class="news_description">

					<h2><?=$val['title']?></h2>
					<p><?=$val['news_text']?></p>
				</div><!--end .news_description-->
			</div><!--end .full_news-->

			<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
				<a href="javascript:void(null);" class="update" onclick="change<?=$val['id_news']?>.style.display='block'">Редактировать</a>

				<a href="<?=URL?>news/delete_news/<?=$val['id_news']?>" class='delete'>Удалить</a>
				<form action="<?=URL?>news/update_news/<?=$val['id_news']?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="change<?=$val['id_news']?>" style="display:none">
					<input type="text" name="title" value="<?=$val['title']?>" placeholder="Заголовок" required><br>
					<textarea name="news_text" value="<?=$val['news_text']?>" placeholder="Текст новости"><?=$val['news_text']?></textarea> <br>

					<input type="file" name="photo" value="" placeholder="Загрузить"><br>
					<input type="submit" name="" value="Сохранить изменения">
					<input type="reset" name="" value="Отмена" onclick="change<?=$val['id_news']?>.style.display='none'">
				</form>
			<?php endif ?>
		</div>
		
	<?php endforeach ?>
<?php endif ?>

