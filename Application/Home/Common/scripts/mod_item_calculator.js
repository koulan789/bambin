$(function(){
	$('input:checkbox').click(function(){
		$('*[itemnumberfield]').html($('li.entry input:checkbox:checked').length);
		var total = 0,
			addition = parseFloat($('*[itemadditionfield]').text()) || 0;
		$('li.entry input:checkbox:checked').each(function(){
			total += parseFloat($(this).closest('li.entry').find('.total').text() || $(this).closest('li.entry').find('.subtotal').text());
		})
		$('*[itemtotalfield]').html((total + addition).toFixed(2).toString());
	});
});