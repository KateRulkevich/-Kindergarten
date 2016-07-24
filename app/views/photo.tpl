
<!-- сообщение об ошибке или ок. с ними можно все делать -->
<?=$register->get('err')?>
<?=$register->get('ok')?>

<!-- все можно делать, но чтоб внутри условия авториации было-->
<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
	
	<form action="<?=URL?>photo/new_group" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<input type="text" name="title" value="" placeholder="Заголовок" required>
		<input type="submit" name="" value="Добавить категорию">
	</form>
	
<?php endif; ?>

<div class="gallery">
	

	<?php if (is_array($data)): ?>
		<?php foreach ($data as $val): ?>


			<div class="info_text">
				<h2><?=$val['title']?></h2>
				

					<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>

						<!--  удалить группу-->
						<a href="<?=URL?>photo/delete_group/<?=$val['id_group']?>" class='delete'>Удалить группу</a><br>

						<!-- форма добавить группу -->
						<form action="<?=URL?>photo/new_photo/<?=$val['id_group']?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
							<!-- надо подумать.эта штука не выдает ошибку, просто не грузит -->
							<!-- <input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> -->
							<input type="file" name="photo" value="" placeholder="Загрузить" required>
							<input type="submit" name="" value="Добавить фото">
						</form>
					<?php endif; ?>

					<?php foreach ($val['photos'] as $val_photos): ?>
						<!-- если в массиве фоток есть имена фоток, тогда циклом создаются img-->
						<?php if ($val_photos['name']): ?>

							<!-- фотографии -->
							<figure>
								<img src="<?=URL?>img/foto_gallery/<?=$val_photos['name']?>">

								<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ): ?>
									<a href="<?=URL?>photo/delete_photo/<?=$val_photos['id_img']?>" class='delete'>Удалить</a>
								<?php endif; ?>
							</figure>
						<?php endif ?>


					<?php endforeach ?>

					<figure class="see_slides">
						<a href="javascript:void(null)" class="ajax-edit slideShowLink" data-success="showGallery" data-action="<?=URL?>photo/get_photo_show/<?=$val['id_group']?>" data-path='foto_gallery/'>Смотреть слайд-шоу</a>
					</figure>
				</div>
			

		<?php endforeach ?>

	<?php endif ?>
</div>




