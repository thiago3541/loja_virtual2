$(function(){
	Shadowbox.init({
		language: 'pt',
		player: ['html', 'swf', 'img'],
		handleOversize: "drag",
		modal: true
	})
});

$(function()
{
	$('#tel').mask('(99)9999-9999');
	$('#cpf').mask('999.999.999-99');
	$('#cep').mask('99.999-999');	
})
