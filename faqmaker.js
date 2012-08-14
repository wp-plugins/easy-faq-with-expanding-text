function bgfaq(theclass,foldup) {
		jQuery('.'+theclass+' p:not(:first-child, :nth-child(2)), .'+theclass+' ul, .'+theclass+' ol').hide();
		
		jQuery('.'+theclass+' :header').click(function(){
		
			if(jQuery(this).next().is(':visible')) {
				jQuery(this).nextUntil(':header').slideUp();
				}
		else {
		if(foldup=='yes') {
			jQuery('.'+theclass+' :not(:header, p:first-child, p:nth-child(2))').slideUp();
		}
		jQuery(this).nextUntil(':header').slideToggle()
		}
		
		
		})
	}