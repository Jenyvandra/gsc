jQuery(function($) {
	$(document).on("click", ".news-section .nav-items a", function(e) {
		e.preventDefault();
		$(".news-section .nav-items").removeClass("active");
		$(this).parent().addClass("active");
		term_id = $(this).parent().data('term-id');
		$.ajax({
			type: 'post',
			url: gsc_obj.ajax_url,
			data: {
				action: 'gsc_get_category_filtered_posts',
				term_id: term_id
			},
			success: function(res) {
				$(".popular-news-left .news-areas").html(res.popular_news);
				$(".popular-news-left .other-news-section .other-news").html(res.other_news);
				$(".popular-news-left .feature-news-section").html(res.featured_news);
			}
		});
	});

	$(document).on("click", ".other-news-section .other-news .pagination .page-numbers", function(e) {
		e.preventDefault();
		if($(this).hasClass("current")) {
	    	return;
	    }
		url = $(this).attr("href");
		var pageNumber = url.match(/page\/(\d+)/);
		var page = 1;
	    if (pageNumber && pageNumber[1]) {
	        page = pageNumber[1];
	    } else {
	        page =  url.match(/paged=(\d+)/)[1];
	    }
	    var term_id = $(".news-section .nav-items.active").data('term-id');


	    $.ajax({
	    	type: "POST",
	    	url: gsc_obj.ajax_url,
	    	data: {
	    		action: "gsc_load_posts",
	    		term_id: term_id,
	    		page: page
	    	},
	    	success: function(res) {
	    		$(".popular-news-left .other-news-section .other-news").html(res.other_news);
	    	}
	    });

	});
});