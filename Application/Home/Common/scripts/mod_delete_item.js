$(function(){
	/* 绑定删除单个的单击事件 */
	$('.delete_this').click(function(e){
		$(this).closest('li.entry').fadeOut(800, function(){
			$(this).remove();
		});
		e.preventDefault();
	});
	/* 绑定批量删除的单击事件 */
	$('.delete_selected').click(function(e){
		var target = $('.item_list li.entry input:checkbox:checked').parents('li.entry');
		if(!target.length){
			alert('请勾选需要删除的产品！');
		}
		else{
			target.fadeOut(800, function(){
				$(this).remove();
			});
		}
		e.preventDefault();
	});
});