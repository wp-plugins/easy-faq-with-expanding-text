function bgfaq(foldup) {
		jQuery('#bg_faq_content_section  p:not(:first-child, :nth-child(2)), #bg_faq_content_section ul, #bg_faq_content_section ol').addClass("bg_faq_hidden");
		
		jQuery('#bg_faq_content_section :header').click(function(){
		
			if(jQuery(this).next().is(':visible')) {
				jQuery(this).nextUntil(':header').slideUp().addClass('bg_faq_hidden');
				}
		else {
		if(foldup=='yes') {
			jQuery('.bg_faq_unhidden').slideUp().removeClass('bg_faq_unhidden').addClass('bg_faq_hidden');
		}
		jQuery(this).nextUntil(':header').slideToggle().addClass('bg_faq_unhidden');
		}
		
		
		})
	}