$('.panel-collapse').on('shown.bs.collapse',function(){
		var pr_x=$(this).attr('id');
		var pr_parent="#"+pr_x;
		
		$("div[data-target='"+pr_parent+"']").toggleClass('active');
	});

$('.panel-collapse').on('hidden.bs.collapse',function(){
		var pr_x=$(this).attr('id');
		var pr_parent="#"+pr_x;
		
		$("div[data-target='"+pr_parent+"']").toggleClass('active');
	});