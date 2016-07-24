
<div class="info_text">
	<ul>

	<?php if (is_array($data)): ?>

		<?php foreach ($data as $val): ?>
			<li data-index="<?=$val['id_course']?>">
				<span><?=$val['title']?> <?=$val['description']?>, педагог – <span class="icon_block"><?=$val['educator']?></span></span>
				
				<!-- можешь менять теги, главное, чтоб они были любыми потомками li -->
				<!-- <a href="javascript:void(null);" style="background:green; color:#fff;" class="saveChange">Сохранить</a> -->

				<!-- на удаление вообще можешь, что хочешь делать, удалять будет по id в хреф 
				<a href="<?=URL?>extra_course/delete/<?=$val['id_course']?>"  class="saveChange">Удалить</a>-->
			</li>
		<?php endforeach ?>
		
	<?php endif ?>
		
	</ul>
</div><!--end .info_text-->
<div class="clear_block"></div>
	
	<!-- можно как угодно оформлять, только сохранить name как есть и action
<div>
	<form action="<?=URL?>extra_course/new_course" method="post" accept-charset="utf-8" class="add_course">
		<input type="text" name="title" value="" placeholder="Название курса"><br>
		<input type="text" name="description" value="" placeholder="Краткое описание"><br>
		<input type="text" name="educator" value="" placeholder="ФИО руководителя"><br>
		<input type="submit" name="submit" value="Добавить курс">
		
	</form>
</div>-->

	


