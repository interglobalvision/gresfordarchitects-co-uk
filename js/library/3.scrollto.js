/*
ScrollTo balupton
 MIT License {@link http://creativecommons.org/licenses/MIT/}
*/
(function(p,q){var d,l;d=p.jQuery;l=d.ScrollTo=d.ScrollTo||{config:{duration:400,easing:"swing",callback:q,durationMode:"each",offsetTop:85,offsetLeft:0},configure:function(e){d.extend(l.config,e||{});return this},scroll:function(e,c){var a,b,g,f,i,m,j,k,h,n;a=e.pop();b=a.$container;g=b.get(0);f=a.$target;i=d("<span/>").css({position:"absolute",top:"0px",left:"0px"});m=b.css("position");b.css("position","relative");i.appendTo(b);a=i.offset().top;a=f.offset().top-a-parseInt(c.offsetTop,10);j=i.offset().left;
k=f.offset().left-j-parseInt(c.offsetLeft,10);f=g.scrollTop;j=g.scrollLeft;i.remove();b.css("position",m);h={};n=function(a){0===e.length?"function"===typeof c.callback&&c.callback.apply(this,[a]):l.scroll(e,c);return!0};c.onlyIfOutside&&(i=f+b.height(),m=j+b.width(),f<a&&a<i&&(a=f),j<k&&k<m&&(k=j));a!==f&&(h.scrollTop=a);k!==j&&(h.scrollLeft=k);d.browser.safari&&g===document.body?(p.scrollTo(h.scrollLeft,h.scrollTop),n()):h.scrollTop||h.scrollLeft?b.animate(h,c.duration,c.easing,n):n();return!0},
fn:function(e){var c,a,b;c=[];var g=d(this);if(0===g.length)return this;e=d.extend({},l.config,e);a=g.parent();for(b=a.get(0);1===a.length&&b!==document.body&&b!==document;){var f;f="visible"!==a.css("overflow-y")&&b.scrollHeight!==b.clientHeight;b="visible"!==a.css("overflow-x")&&b.scrollWidth!==b.clientWidth;if(f||b)c.push({$container:a,$target:g}),g=a;a=a.parent();b=a.get(0)}c.push({$container:d(d.browser.msie||d.browser.mozilla?"html":"body"),$target:g});"all"===e.durationMode&&(e.duration/=c.length);
l.scroll(c,e);return this}};d.fn.ScrollTo=d.ScrollTo.fn})(window);