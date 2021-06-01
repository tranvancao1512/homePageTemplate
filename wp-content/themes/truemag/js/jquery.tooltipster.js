/*Tooltipster 3.0.0 | 2013-12-22*/ !function(t,o,e){function n(o,e){this.bodyOverflowX,this.checkInterval=null,this.content,this.$el=t(o),this.elProxyPosition,this.$elProxy,this.enabled=!0,this.options=t.extend({},a,e),this.mouseIsOverProxy=!1,this.namespace="tooltipster-"+Math.round(1e5*Math.random()),this.status="hidden",this.timerHide=null,this.timerShow=null,this.$tooltip,this.tooltipArrowReposition,this.options.iconTheme=this.options.iconTheme.replace(".",""),this.options.theme=this.options.theme.replace(".",""),this.init()}function s(o,e){var i=!0;return t.each(o,function(t){return"undefined"==typeof e[t]||o[t]!==e[t]?(i=!1,!1):void 0}),i}function r(){return!d&&f}function p(){var t=e.body||e.documentElement,o=t.style,i="transition";if("string"==typeof o[i])return!0;v=["Moz","Webkit","Khtml","O","ms"],i=i.charAt(0).toUpperCase()+i.substr(1);for(var n=0;n<v.length;n++)if("string"==typeof o[v[n]+i])return!0;return!1}var l="tooltipster",a={animation:"fade",arrow:!0,arrowColor:"",autoClose:!0,content:null,contentAsHTML:!1,contentCloning:!0,delay:200,fixedWidth:0,maxWidth:0,functionInit:function(){},functionBefore:function(t,o){o()},functionReady:function(){},functionAfter:function(){},icon:"(?)",iconCloning:!0,iconDesktop:!1,iconTouch:!1,iconTheme:"tooltipster-icon",interactive:!1,interactiveTolerance:350,offsetX:0,offsetY:0,onlyOne:!1,position:"top",positionTracker:!1,speed:350,timer:0,theme:"tooltipster-default",touchDevices:!0,trigger:"hover",updateAnimation:!0};n.prototype={init:function(){var o=this;if(e.querySelector){if(null!==o.options.content)o.setContent(o.options.content);else{var i=o.$el.attr("title");"undefined"==typeof i&&(i=null),o.setContent(i)}var n=o.options.functionInit(o.$el,o.content);"undefined"!=typeof n&&o.setContent(n),o.$el.removeAttr("title").addClass("tooltipstered"),!f&&o.options.iconDesktop||f&&o.options.iconTouch?("string"==typeof o.options.icon?(o.$elProxy=t('<span class="'+o.options.iconTheme+'"></span>'),o.$elProxy.text(o.options.icon)):o.$elProxy=o.options.iconCloning?o.options.icon.clone(!0):o.options.icon,o.$elProxy.insertAfter(o.$el)):o.$elProxy=o.$el,"hover"==o.options.trigger?(o.$elProxy.on("mouseenter."+o.namespace,function(){(!r()||o.options.touchDevices)&&(o.mouseIsOverProxy=!0,o.showTooltip())}).on("mouseleave."+o.namespace,function(){(!r()||o.options.touchDevices)&&(o.mouseIsOverProxy=!1)}),f&&o.options.touchDevices&&o.$elProxy.on("touchstart."+o.namespace,function(){o.showTooltipNow()})):"click"==o.options.trigger&&o.$elProxy.on("click."+o.namespace,function(){(!r()||o.options.touchDevices)&&o.showTooltip()})}},showTooltip:function(){var t=this;"shown"!=t.status&&"appearing"!=t.status&&(t.options.delay?t.timerShow=setTimeout(function(){("click"==t.options.trigger||"hover"==t.options.trigger&&t.mouseIsOverProxy)&&t.showTooltipNow()},t.options.delay):t.showTooltipNow())},showTooltipNow:function(){var o=this;clearTimeout(o.timerShow),o.timerShow=null,clearTimeout(o.timerHide),o.timerHide=null,o.enabled&&null!==o.content&&(o.options.onlyOne&&t(".tooltipstered").not(o.$el).each(function(o,e){var i=t(e),n=i[l]("status"),s=i[l]("option","autoClose");"hidden"!==n&&"disappearing"!==n&&s&&i[l]("hide")}),o.options.functionBefore(o.$elProxy,function(){if("hidden"!==o.status){var e=0;"disappearing"===o.status&&(o.status="appearing",p()?(o.$tooltip.clearQueue().removeClass("tooltipster-dying").addClass("tooltipster-"+o.options.animation+"-show"),o.options.speed>0&&o.$tooltip.delay(o.options.speed),o.$tooltip.queue(function(){o.status="shown"})):o.$tooltip.stop().fadeIn(function(){o.status="shown"}))}else{o.status="appearing";var e=o.options.speed;o.bodyOverflowX=t("body").css("overflow-x"),t("body").css("overflow-x","hidden");var i="tooltipster-"+o.options.animation,n="-webkit-transition-duration: "+o.options.speed+"ms; -webkit-animation-duration: "+o.options.speed+"ms; -moz-transition-duration: "+o.options.speed+"ms; -moz-animation-duration: "+o.options.speed+"ms; -o-transition-duration: "+o.options.speed+"ms; -o-animation-duration: "+o.options.speed+"ms; -ms-transition-duration: "+o.options.speed+"ms; -ms-animation-duration: "+o.options.speed+"ms; transition-duration: "+o.options.speed+"ms; animation-duration: "+o.options.speed+"ms;",s=o.options.fixedWidth>0?"width:"+Math.round(o.options.fixedWidth)+"px;":"",r=o.options.maxWidth>0?"max-width:"+Math.round(o.options.maxWidth)+"px;":"",l=o.options.interactive?"pointer-events: auto;":"";if(o.$tooltip=t('<div class="tooltipster-base '+i+" "+o.options.theme+'" style="'+s+" "+r+" "+l+" "+n+'"><div class="tooltipster-content"></div></div>'),o.insertContent(),o.$tooltip.appendTo("body"),o.positionTooltip(),o.options.functionReady(o.$el,o.$tooltip),p()?(o.$tooltip.addClass(i+"-show"),o.options.speed>0&&o.$tooltip.delay(o.options.speed),o.$tooltip.queue(function(){o.status="shown"})):o.$tooltip.css("display","none").fadeIn(o.options.speed,function(){o.status="shown"}),o.setCheckInterval(),o.options.autoClose)if(t("body").off("."+o.namespace),"hover"==o.options.trigger)if(f&&setTimeout(function(){t("body").on("touchstart."+o.namespace,function(){o.hideTooltip()})},0),o.options.interactive){t(".youtube").colorbox({iframe:!0,innerWidth:480,innerHeight:320}),t(".vimeo").colorbox({iframe:!0,innerWidth:500,innerHeight:409}),f&&o.$tooltip.on("touchstart."+o.namespace,function(t){t.stopPropagation()});var a=null;o.$elProxy.add(o.$tooltip).on("mouseleave."+o.namespace+"-autoClose",function(){clearTimeout(a),a=setTimeout(function(){o.hideTooltip()},o.options.interactiveTolerance)}).on("mouseenter."+o.namespace+"-autoClose",function(){clearTimeout(a)})}else o.$elProxy.on("mouseleave."+o.namespace+"-autoClose",function(){o.hideTooltip()});else"click"==o.options.trigger&&(setTimeout(function(){t("body").on("click."+o.namespace+" touchstart."+o.namespace,function(){o.hideTooltip()})},0),o.options.interactive&&(t(".youtube").colorbox({iframe:!0,innerWidth:480,innerHeight:320}),t(".vimeo").colorbox({iframe:!0,innerWidth:500,innerHeight:409}),o.$tooltip.on("click."+o.namespace+" touchstart."+o.namespace,function(t){t.stopPropagation()})))}o.options.timer>0&&(o.timerHide=setTimeout(function(){o.timerHide=null,o.hideTooltip()},o.options.timer+e))}))},setCheckInterval:function(){var o=this;o.checkInterval=setInterval(function(){if(o.options.positionTracker){var e=o.positionInfo(o.$elProxy),i=!1;s(e.dimension,o.elProxyPosition.dimension)&&("fixed"===o.$elProxy.css("position")?s(e.position,o.elProxyPosition.position)&&(i=!0):s(e.offset,o.elProxyPosition.offset)&&(i=!0)),i||o.positionTooltip()}0!==t("body").find(o.$el).length||"shown"!=o.status&&"appearing"!=o.status||o.hideTooltip(),(0===t("body").find(o.$el).length||0===t("body").find(o.$elProxy).length||"hidden"==o.status||0===t("body").find(o.$tooltip).length)&&o.cancelCheckInterval()},200)},cancelCheckInterval:function(){clearInterval(this.checkInterval),this.checkInterval=null},hideTooltip:function(){var o=this;if(clearTimeout(o.timerShow),o.timerShow=null,clearTimeout(o.timerHide),o.timerHide=null,"shown"==o.status||"appearing"==o.status){o.status="disappearing";var e=function(){o.status="hidden",o.$tooltip.remove(),o.$tooltip=null,t("body").off("."+o.namespace).css("overflow-x",o.bodyOverflowX),o.$elProxy.off("."+o.namespace+"-autoClose"),o.options.functionAfter(o.$elProxy)};p()?(o.$tooltip.clearQueue().removeClass("tooltipster-"+o.options.animation+"-show").addClass("tooltipster-dying"),o.options.speed>0&&o.$tooltip.delay(o.options.speed),o.$tooltip.queue(e)):o.$tooltip.stop().fadeOut(o.options.speed,e)}},setContent:function(t){"object"==typeof t&&null!==t&&this.options.contentCloning&&(t=t.clone(!0)),this.content=t},insertContent:function(){var t=this,o=this.$tooltip.find(".tooltipster-content");"string"!=typeof t.content||t.options.contentAsHTML?o.empty().append(t.content):o.text(t.content)},updateTooltip:function(t){var o=this;o.setContent(t),null!==o.content?"hidden"!==o.status&&(o.insertContent(),o.positionTooltip(),o.options.updateAnimation&&(p()?(o.$tooltip.css({width:"","-webkit-transition":"all "+o.options.speed+"ms, width 0ms, height 0ms, left 0ms, top 0ms","-moz-transition":"all "+o.options.speed+"ms, width 0ms, height 0ms, left 0ms, top 0ms","-o-transition":"all "+o.options.speed+"ms, width 0ms, height 0ms, left 0ms, top 0ms","-ms-transition":"all "+o.options.speed+"ms, width 0ms, height 0ms, left 0ms, top 0ms",transition:"all "+o.options.speed+"ms, width 0ms, height 0ms, left 0ms, top 0ms"}).addClass("tooltipster-content-changing"),setTimeout(function(){"hidden"!=o.status&&(o.$tooltip.removeClass("tooltipster-content-changing"),setTimeout(function(){"hidden"!==o.status&&o.$tooltip.css({"-webkit-transition":o.options.speed+"ms","-moz-transition":o.options.speed+"ms","-o-transition":o.options.speed+"ms","-ms-transition":o.options.speed+"ms",transition:o.options.speed+"ms"})},o.options.speed))},o.options.speed)):o.$tooltip.fadeTo(o.options.speed,.5,function(){"hidden"!=o.status&&o.$tooltip.fadeTo(o.options.speed,1)}))):o.hideTooltip()},positionInfo:function(t){return{dimension:{height:t.outerHeight(!1),width:t.outerWidth(!1)},offset:t.offset(),position:{left:parseInt(t.css("left")),top:parseInt(t.css("top"))}}},positionTooltip:function(){function e(){var e=t(o).scrollLeft();if(0>H-e){var i=H-e;H=e,s.tooltipArrowReposition=i}if(H+l-e>r){var i=H-(r+e-l);H=r+e-l,s.tooltipArrowReposition=i}}function n(e,i){p.offset.top-t(o).scrollTop()-f-A-12<0&&i.indexOf("top")>-1&&(D=e),p.offset.top+p.dimension.height+f+12+A>t(o).scrollTop()+t(o).height()&&i.indexOf("bottom")>-1&&(D=e,O=p.offset.top-f-A-12)}var s=this;if(s.$tooltip){s.$tooltip.css("width",""),s.elProxyPosition=s.positionInfo(s.$elProxy);var r=t(o).width(),p=s.elProxyPosition,l=s.$tooltip.outerWidth(!1),a=s.$tooltip.innerWidth()+1,f=s.$tooltip.outerHeight(!1);if(s.$elProxy.is("area")){var d=s.$elProxy.attr("shape"),c=s.$elProxy.parent().attr("name"),h=t('img[usemap="#'+c+'"]'),u=h.offset().left,m=h.offset().top,v=void 0!==s.$elProxy.attr("coords")?s.$elProxy.attr("coords").split(","):void 0;if("circle"==d){var g=parseInt(v[0]),$=parseInt(v[1]),w=parseInt(v[2]);p.dimension.height=2*w,p.dimension.width=2*w,p.offset.top=m+$-w,p.offset.left=u+g-w}else if("rect"==d){var g=parseInt(v[0]),$=parseInt(v[1]),y=parseInt(v[2]),x=parseInt(v[3]);p.dimension.height=x-$,p.dimension.width=y-g,p.offset.top=m+$,p.offset.left=u+g}else if("poly"==d){var b=0,T=0,P=0,C=0,k="even";for(i=0;i<v.length;i++){var I=parseInt(v[i]);"even"==k?(I>P&&(P=I,0===i&&(b=P)),b>I&&(b=I),k="odd"):(I>C&&(C=I,1==i&&(T=C)),T>I&&(T=I),k="even")}p.dimension.height=C-T,p.dimension.width=P-b,p.offset.top=m+T,p.offset.left=u+b}else p.dimension.height=h.outerHeight(!1),p.dimension.width=h.outerWidth(!1),p.offset.top=m,p.offset.left=u}0===s.options.fixedWidth&&s.$tooltip.css({width:Math.round(a)+"px","padding-left":"0px","padding-right":"0px"});var H=0,W=0,O=0,A=parseInt(s.options.offsetY),M=parseInt(s.options.offsetX),D=s.options.position;if("top"==D){var R=p.offset.left+l-(p.offset.left+p.dimension.width);H=p.offset.left+M-R/2,O=p.offset.top-f-A-12,e(),n("bottom","top")}if("top-left"==D&&(H=p.offset.left+M,O=p.offset.top-f-A-12,e(),n("bottom-left","top-left")),"top-right"==D&&(H=p.offset.left+p.dimension.width+M-l,O=p.offset.top-f-A-12,e(),n("bottom-right","top-right")),"bottom"==D){var R=p.offset.left+l-(p.offset.left+p.dimension.width);H=p.offset.left-R/2+M,O=p.offset.top+p.dimension.height+A+12,e(),n("top","bottom")}if("bottom-left"==D&&(H=p.offset.left+M,O=p.offset.top+p.dimension.height+A+12,e(),n("top-left","bottom-left")),"bottom-right"==D&&(H=p.offset.left+p.dimension.width+M-l,O=p.offset.top+p.dimension.height+A+12,e(),n("top-right","bottom-right")),"left"==D){H=p.offset.left-M-l-12,W=p.offset.left+M+p.dimension.width+12;var S=p.offset.top+f-(p.offset.top+s.$elProxy.outerHeight(!1));if(O=p.offset.top-S/2-A,0>H&&W+l>r){var z=2*parseFloat(s.$tooltip.css("border-width")),F=l+H-z;s.$tooltip.css("width",F+"px"),f=s.$tooltip.outerHeight(!1),H=p.offset.left-M-F-12-z,S=p.offset.top+f-(p.offset.top+s.$elProxy.outerHeight(!1)),O=p.offset.top-S/2-A}else 0>H&&(H=p.offset.left+M+p.dimension.width+12,s.tooltipArrowReposition="left")}if("right"==D){H=p.offset.left+M+p.dimension.width+12,W=p.offset.left-M-l-12;var S=p.offset.top+f-(p.offset.top+s.$elProxy.outerHeight(!1));if(O=p.offset.top-S/2-A,H+l>r&&0>W){var z=2*parseFloat(s.$tooltip.css("border-width")),F=r-H-z;s.$tooltip.css("width",F+"px"),f=s.$tooltip.outerHeight(!1),S=p.offset.top+f-(p.offset.top+s.$elProxy.outerHeight(!1)),O=p.offset.top-S/2-A}else H+l>r&&(H=p.offset.left-M-l-12,s.tooltipArrowReposition="right")}if(s.options.arrow){var j="tooltipster-arrow-"+D;if(s.options.arrowColor.length<1)var N=s.$tooltip.css("background-color");else var N=s.options.arrowColor;var Q=s.tooltipArrowReposition;if(Q?"left"==Q?(j="tooltipster-arrow-right",Q=""):"right"==Q?(j="tooltipster-arrow-left",Q=""):Q="left:"+Math.round(Q)+"px;":Q="","top"==D||"top-left"==D||"top-right"==D)var X=parseFloat(s.$tooltip.css("border-bottom-width")),q=s.$tooltip.css("border-bottom-color");else if("bottom"==D||"bottom-left"==D||"bottom-right"==D)var X=parseFloat(s.$tooltip.css("border-top-width")),q=s.$tooltip.css("border-top-color");else if("left"==D)var X=parseFloat(s.$tooltip.css("border-right-width")),q=s.$tooltip.css("border-right-color");else if("right"==D)var X=parseFloat(s.$tooltip.css("border-left-width")),q=s.$tooltip.css("border-left-color");else var X=parseFloat(s.$tooltip.css("border-bottom-width")),q=s.$tooltip.css("border-bottom-color");X>1&&X++;var E="";if(0!==X){var L="",Y="border-color: "+q+";";-1!==j.indexOf("bottom")?L="margin-top: -"+Math.round(X)+"px;":-1!==j.indexOf("top")?L="margin-bottom: -"+Math.round(X)+"px;":-1!==j.indexOf("left")?L="margin-right: -"+Math.round(X)+"px;":-1!==j.indexOf("right")&&(L="margin-left: -"+Math.round(X)+"px;"),E='<span class="tooltipster-arrow-border" style="'+L+" "+Y+';"></span>'}s.$tooltip.find(".tooltipster-arrow").remove();var B='<div class="'+j+' tooltipster-arrow" style="'+Q+'">'+E+'<span style="border-color:'+N+';"></span></div>';s.$tooltip.append(B)}s.$tooltip.css({top:Math.round(O)+"px",left:Math.round(H)-5+"px"})}}},t.fn[l]=function(){var o=arguments;if(0===this.length){if("string"==typeof o[0]){var e=!0;switch(o[0]){case"setDefaults":t.extend(a,o[1]);break;default:e=!1}return e?!0:this}return this}if("string"==typeof o[0]){var i=null;return this.each(function(){var e=t(this).data("tooltipster");if(!e)throw new Error("You called Tooltipster's \""+o[0]+'" method on an unitialized element');switch(o[0]){case"content":case"update":if("undefined"==typeof o[1])return i=e.content,!1;e.updateTooltip(o[1]);break;case"destroy":e.hideTooltip(),e.$el[0]!==e.$elProxy[0]&&e.$elProxy.remove();var n="string"==typeof e.content?e.content:t("<div></div>").append(e.content).html();e.$el.removeClass("tooltipstered").attr("title",n).removeData("tooltipster").off("."+e.namespace);break;case"disable":e.hideTooltip(),e.enabled=!1;break;case"elementIcon":return i=e.$el[0]!==e.$elProxy[0]?e.$elProxy[0]:void 0,!1;case"elementTooltip":return i=e.$tooltip?e.$tooltip[0]:void 0,!1;case"enable":e.enabled=!0;break;case"hide":e.hideTooltip();break;case"option":i=e.options[o[1]];break;case"reposition":e.positionTooltip();break;case"show":e.showTooltipNow();break;case"status":return i=e.status,!1;default:throw new Error('Unknown method .tooltipster("'+o[0]+'")')}}),null!==i?i:this}return this.each(function(){t(this).data("tooltipster")||t(this).data("tooltipster",new n(this,o[0]))})};var f=!!("ontouchstart"in o),d=!1;t("body").one("mousemove",function(){d=!0}),t(o).on("orientationchange",function(){t(".tooltipstered").each(function(){t(this)[l]("hide")})}),t(o).on("scroll resize",function(){t(".tooltipstered").each(function(){t(this)[l]("reposition")})}),t(e).ajaxSuccess(function(){jQuery(".youtube").colorbox({iframe:!0,innerWidth:480,innerHeight:320}),jQuery(".vimeo").colorbox({iframe:!0,innerWidth:500,innerHeight:409})})}(jQuery,window,document);