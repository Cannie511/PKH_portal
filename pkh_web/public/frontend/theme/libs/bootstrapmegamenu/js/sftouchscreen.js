(function($){$.fn.sftouchscreen=function(){return this.each(function(){$(this).find('li > ul').closest('li').children('a').each(function(){var $item=$(this);$item.click(function(event){if($item.hasClass('sf-clicked')){var $uri=$item.attr('href');window.location=$uri;}
else{event.preventDefault();$item.addClass('sf-clicked');}}).closest('li').mouseleave(function(){$item.removeClass('sf-clicked');});});});};})(jQuery);