<?php foreach($categories AS $category) { ?>
	<div class="col-md-6" style="padding-left: 0px;">
	<div class="tile" style="margin-bottom: 15px">
		<h3 class="sidebar_title"><?php echo anchor('news/'.$this->news->friendly_url($category['short_title']).'-'.$category['id'].'',$category['short_title'],'title2');?></h3>
		<?php echo $category['description'];?>
		</div>
	</div>
<?php } ?>