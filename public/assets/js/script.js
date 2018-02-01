var lives = 3,
	score = 0,
	correct = '',
	question = '';
start = function() {
	$('#lives').text(lives);
	$('#score').text(score);

}
$(document).ready(function(){
	start();
	getQ();
	// setQuestion();
});
function getQ()
{
	$.get(base_url + 'next',function(data){
		question = data.question;
		if(question.type == 'Image'){
			$('#title').text('Which script it is ?');
			$('.content-holder').html('<img src="'+question.filename+'" class="img-responsive">');
		}else{
			$('#title').text('Which language it is ?');
			$('.content-holder').html('<audio controls src="'+question.filename+'" >');
		}
		$('.answers').html('');
		$.each(question.choices, function(k,v){
			if(v.is_correct) correct = v.text;
			$('.answers').append('<button class="btn btn-default answer">'+v.text+'</button>');
		});
	});
}
