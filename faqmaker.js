function bgfaq(foldup) {
		jQuery('.bg_faq_content_section :header:not(h6)').each(function(){
			//containsimg = jQuery(this).getElementsByTagName('img');
			//if ( !containsimg )
			jQuery(this).addClass('bg_faq_closed');
			jQuery(this).nextUntil(':header').css({'display':'none'});
			var textsize = jQuery(this).css('font-size');
			var halftextsize = parseInt(textsize)/2;
			var backgroundpos = Math.round(halftextsize)-10;
			jQuery(this).css({'background-position-y': backgroundpos});
			console.log(textsize);
		jQuery(this).click(function(){
		
			if(jQuery(this).hasClass('bg_faq_opened')) {
				jQuery(this).nextUntil(':header').slideUp();
				jQuery(this).removeClass('bg_faq_opened').addClass('bg_faq_closed');
				}
		else {
		if(foldup=='yes') {
			jQuery('.bg_faq_opened').each(function(){
				jQuery(this).nextUntil(':header').slideUp();
				jQuery(this).removeClass('bg_faq_opened').addClass('bg_faq_closed');
			})
		}
		jQuery(this).nextUntil(':header').slideDown();
		jQuery(this).removeClass('bg_faq_closed').addClass('bg_faq_opened');
		}
		
		
		})			
			
		});
		

	}