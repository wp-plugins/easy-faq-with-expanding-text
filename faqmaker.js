function bgfaq(theclass,foldup) {
		jQuery('.'+theclass+' p').hide();
		jQuery('.'+theclass+' :header').click(function(){
		
			if(jQuery(this).next().is(':visible')) {
				jQuery(this).nextUntil(':header').slideUp();
				}
		else {
		if(foldup=='yes') {
			jQuery('.'+theclass+' :not(:header)').slideUp();
		}
		jQuery(this).nextUntil(':header').slideToggle()
		}
		
		
		})
	}