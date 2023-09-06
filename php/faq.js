$(document).ready(function() {
	$('#question').keyup(function() {
		var question = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'faq.php',
			data: {question: question},
			dataType: 'json',
			success: function(response) {
				$('#answer').html(response.answer);
			}
		});
	});
});
