;var spbctaNM = {};
;(function($){
spbctaNM.func = {
// spbcta functionality
spbcta_pass: function(base64String, element, link, target, preview = false){
//if reveal blank hide reveal
	if(base64String){
/////
			if($(element)[0].hasAttribute("href")){
				$(element).addClass('spbcta_selectable');
				$(element).children('.reveal__button__hidden__content').html(atob(base64String));
				if(!preview)$(element).removeAttr("href");
				$(element).closest('.reveal__button__wrapper').addClass('reveal__button__content');
				spbctaNM.selectText($(element).children('.reveal__button__hidden__content')[0]);
				if(!preview)spbctaNM.openLink(link,target);
			} else {
				if(!preview)spbctaNM.openLink(link,target);
				}
			}
		}

	}
spbctaNM.openLink = function(link,target){
	if(target==1){
		window.open(link, '_blank');
	} else {
		location.href=link;
	}
}

spbctaNM.selectText = function(element){
    var range = document.createRange();
    range.selectNodeContents(element);
    var sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
}

})(jQuery);


jQuery(document).ready(function ($) {
$(".reveal__button__hidden__content").each(function(){
$(this).css({
'min-width': ($(this).siblings(".reveal__button__text").width() + 'px')
});
});


});
