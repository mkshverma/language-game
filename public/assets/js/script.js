var lives = 3,
	score = 0,
	correct = '',
	tip = '',
	question = '';
start = function() {
	lives = 3;
	score = 0;
	$('#lives').text(lives);
	$('#score').text(score);
	$('#play-again').hide();
	$('#next').show();
	getQ();
}
$(document).ready(function(){
	start();
	$(document).on('click','#next',function(){
		getQ();
	});
	// setQuestion();
	$(document).on('click','#play-again',start);
});
function getQ()
{
	$.get(base_url + 'next',function(data){
		question = data.question;
		if(question.type == 'Image'){
			$('#title').text('Which script it is ?');
			$('.content-holder').html('<img srcset="'+base_url+'assets/img/looading.gif" src="'+question.filename+'" class="img-responsive">');
		}else{
			$('#title').text('Which language it is ?');
			$('.content-holder').html('<div><i class="fa fa-5x fa-volume-up"></i></div><audio controls src="'+question.filename+'" >');
		}
		$('.answers').html('');
		$.each(question.choices, function(k,v){
			if(v.is_correct == 1){ correct = v.language; tip = v.tip;}
			$('.answers').append('<button class="btn btn-default answer">'+v.language+'</button>');
		});
		$('#next').attr('disabled',true);

		$(document).on('click','.answer',function(){
			$selected = $(this);
			$('#next').attr('disabled',false);
			if($selected.text() == correct){
				$selected.addClass('btn-success');
				score += 50;
			}else{
				$selected.addClass('btn-danger');
				lives -= 1;
				$('.answers').append($('<div></div>').addClass('alert alert-info').text(tip));
			}
			$('#lives').text(lives);
			$('#score').text(score);
			$('#score').text(score);
			$('.answer').each(function(){
				$this = $(this);
				if($this.text() != correct)
				{
					$this.addClass('btn-crossed');
				}else{
					$this.addClass('btn-success');
				}
			});
			$(document).off('click','.answer');

			if(lives == 0){
				$('#next').hide();
				$('#play-again').show();
			}
		});
	});
}
