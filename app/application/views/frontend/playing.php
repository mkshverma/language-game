<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<div class="col-sm-12 text-center">
		<h2><?php
		if(isset($is_correct)){
			if($is_correct) echo 'Nice...';
			else echo "So close !";
		}else{
			if(@$question->type == 'script') echo "Which script is this ?";
			else echo "What language is this ?";
		}
		?></h2>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<h3 class="text-center">Lives: <?=$this->session->lives;?></h3>
		<div class="content-holder">
	<?php	if(@$question->type == 'script'){ ?>
			<img src="<?=$question->filename;?>" class="img-responsive">
	<?php	}else if(@$question->type == 'language'){ ?>
			<audio controls autoplay src="<?=$question->filename;?>"></audio>
	<?php	} ?>
		</div>
	</div>
	<div class="col-sm-6">
		<h3 class="text-center">Score: <?=$this->session->score;?></h3>
		<?php echo form_open('',['disabled'=>isset($is_correct)]);?>
		<input type="hidden" name="question_id" value="<?=$question->question_id;?>">
		<?php foreach ($question->choices as $choice) {	
			$classes = '';
			$type = 'submit';
			if(isset($answer)){
				$type = 'button';
				if(!$choice->is_correct) $classes .= ' btn-crossed';
				if($answer == $choice->text){
					if($choice->is_correct) $classes .= ' btn-success';
					else $classes .= ' btn-danger';
				}
			}
		?>
		<div class="form-group">
			<input type="<?=$type;?>" class="btn btn-default<?=$classes;?>" name="choice" value="<?=$choice->text;?>">
		</div>
		<?php } echo form_close();?>
	</div>
</div>
<div class="row">
	<?php if(isset($answer)){
		if($this->session->lives > 0 ){	 ?>
	<div class="col-sm-12 text-center">
		<a href="<?=base_url('next');?>" class="btn btn-primary btn-lg">Next &gt;</a>
	</div>
	<?php }else{ ?>
	<div class="col-sm-12 text-center">
		<a href="<?=base_url('start');?>" class="btn btn-primary btn-lg">Play Again !</a>
	</div>
	<?php }
		} ?>
</div>