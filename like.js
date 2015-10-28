function add_like(comment_id) {
	
	$.post('like_add.php', {comment_id:comment_id},  function(data){
		if(data == 'success')
		{
			// do something
			like_get(comment_id);
		} else{
			alert(data);
		}
	});
	
}

function like_get(comment_id){
	
	$.post('like_get.php', {comment_id:comment_id},  function(data){
		$('#comment_'+comment_id+'_likes').text(data);
	});
	
}

