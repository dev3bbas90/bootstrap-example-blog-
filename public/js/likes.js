// alert('like.js page');
$('.like_div').on('click',function(){
	var like_s=$(this).attr('data_like');
	var post_idd=$(this).attr('data_postid');
	$.ajax({
		type:'Post',
		url:url,
		data:{
			like_s,post_id:post_idd,_token:token},
		success:function(data){
			/// style changes
			var is_like=data.is_like;
			var swapped=data.swapped;
			//alert(is_like);
	       if(is_like==1)
	       {
		   $('*[data_postid="'+post_idd+'"]').removeClass('far').addClass('fa');
		   $('*[data_postid="'+post_idd+'"]').css("color", "#337ab7");
		   /////////////////////////////// increase count
		   var current_like = $('*[data_postid_count="'+post_idd+'"]').find('.like_count').text();
		   var new_like =parseInt(current_like)+1;
		   $('*[data_postid_count="'+post_idd+'"]').find('.like_count').text(new_like);
		   ///////////////////////////////////////if swapped change dislike
		   if(swapped==1){
		   var current_like2 = $('*[data_postid_count2="'+post_idd+'"]').find('.dislike_count').text();
		   var new_like =parseInt(current_like2)-1;
		   $('*[data_postid_count2="'+post_idd+'"]').find('.dislike_count').text(new_like);
		   }
		   //////////////////////////////// change dislike
		    $('*[data_postid2="'+post_idd+'"]').removeClass('fa').addClass('far');
		   $('*[data_postid2="'+post_idd+'"]').css("color", "#272626");
		   
	       }
           if(is_like==0)
	       {
		   $('*[data_postid="'+post_idd+'"]').removeClass('fa').addClass('far');
		    $('*[data_postid="'+post_idd+'"]').css("color", "#272626");
		    /////////////////////////////////// decrease count
		    var current_like=$('*[data_postid_count="'+post_idd+'"]').find('.like_count').text();
		    var new_like=parseInt(current_like)-1;
		    $('*[data_postid_count="'+post_idd+'"]').find('.like_count').text(new_like);
	        }

		}
	}); /// end ajax
});

$('.dislike_div').on('click',function(){
	var like_s=$(this).attr('data_dislike');
	var post_idd=$(this).attr('data_postid2');
	$.ajax({
		type:'Post',
		url:url2,
		data:{
			like_s,post_id:post_idd,_token:token},
		success:function(data){
			/// style changes
			var is_dislike=data.is_dislike;
			var swapped=data.swapped;
	       if(is_dislike==1)
	       {
		   $('*[data_postid2="'+post_idd+'"]').removeClass('far').addClass('fa');
		   $('*[data_postid2="'+post_idd+'"]').css("color", "#337ab7");
		   /////////////////////////////////// change like 
		   $('*[data_postid="'+post_idd+'"]').removeClass('fa').addClass('far');
		    $('*[data_postid="'+post_idd+'"]').css("color", "#272626");
		    ///////////////////////////////////////////  increase count
		    var current_like = $('*[data_postid_count2="'+post_idd+'"]').find('.dislike_count').text();
		   var new_like =parseInt(current_like)+1;
		   $('*[data_postid_count2="'+post_idd+'"]').find('.dislike_count').text(new_like);
		   /////////////////////////////////////////////////if swapped decrease like
		   if(swapped==1){
		   var current_like2 = $('*[data_postid_count="'+post_idd+'"]').find('.like_count').text();
		   var new_like =parseInt(current_like2)-1;
		   $('*[data_postid_count="'+post_idd+'"]').find('.like_count').text(new_like);
		   }

	       }
           if(is_dislike==0)
	       {
		   $('*[data_postid2="'+post_idd+'"]').removeClass('fa').addClass('far');
		    $('*[data_postid2="'+post_idd+'"]').css("color", "#272626");
		     /////////////////////////////////// decrease count
		    var current_like=$('*[data_postid_count2="'+post_idd+'"]').find('.dislike_count').text();
		    var new_like=parseInt(current_like)-1;
		    $('*[data_postid_count2="'+post_idd+'"]').find('.dislike_count').text(new_like);

	        }

		}
	}); /// end ajax
});