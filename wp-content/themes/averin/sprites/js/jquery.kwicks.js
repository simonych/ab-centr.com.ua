/*
	Kwicks for jQuery (version 1.5.1)
	Copyright (c) 2008 Jeremy Martin
	http://www.jeremymartin.name/projects.php?project=kwicks
	
	Licensed under the MIT license:
		http://www.opensource.org/licenses/mit-license.php

	Any and all use of this script must be accompanied by this copyright/license notice in its present form.
*/

(function(d){d.fn.kwicks=function(n){var a=d.extend({isVertical:!1,sticky:!1,defaultKwick:0,event:"mouseover",spacing:0,duration:500},n),g=a.isVertical?"height":"width",h=a.isVertical?"top":"left";return this.each(function(){container=d(this);var b=container.children("li"),f=b.eq(0).css(g).replace(/px/,"");a.max?a.min=(f*b.size()-a.max)/(b.size()-1):a.max=f*b.size()-a.min*(b.size()-1);a.isVertical?container.css({width:b.eq(0).css("width"),height:f*b.size()+a.spacing*(b.size()-1)+"px"}):container.css({width:f*
b.size()+a.spacing*(b.size()-1)+"px",height:b.eq(0).css("height")});var m=[];for(i=0;i<b.size();i++){m[i]=[];for(j=1;j<b.size()-1;j++)m[i][j]=i==j?a.isVertical?j*a.min+j*a.spacing:j*a.min+j*a.spacing:(j<=i?j*a.min:(j-1)*a.min+a.max)+j*a.spacing}b.each(function(e){var c=d(this);e===0?c.css(h,"0px"):e==b.size()-1?c.css(a.isVertical?"bottom":"right","0px"):a.sticky?c.css(h,m[a.defaultKwick][e]):c.css(h,e*f+e*a.spacing);a.sticky&&(a.defaultKwick==e?(c.css(g,a.max+"px"),c.addClass("active")):c.css(g,a.min+
"px"));c.css({margin:0,position:"absolute"});c.bind(a.event,function(){var f=[],k=[];b.stop().removeClass("active");for(j=0;j<b.size();j++)f[j]=b.eq(j).css(g).replace(/px/,""),k[j]=b.eq(j).css(h).replace(/px/,"");var l={};l[g]=a.max;var d=a.max-f[e],n=f[e]/d;c.addClass("active").animate(l,{step:function(c){var l=d!=0?c/d-n:1;b.each(function(c){c!=e&&b.eq(c).css(g,f[c]-(f[c]-a.min)*l+"px");c>0&&c<b.size()-1&&b.eq(c).css(h,k[c]-(k[c]-m[e][c])*l+"px")})},duration:a.duration,easing:a.easing})})});a.sticky||
container.bind("mouseleave",function(){var e=[],c=[];b.removeClass("active").stop();for(i=0;i<b.size();i++)e[i]=b.eq(i).css(g).replace(/px/,""),c[i]=b.eq(i).css(h).replace(/px/,"");var d={};d[g]=f;var k=f-e[0];b.eq(0).animate(d,{step:function(d){d=k!=0?(d-e[0])/k:1;for(i=1;i<b.size();i++)b.eq(i).css(g,e[i]-(e[i]-f)*d+"px"),i<b.size()-1&&b.eq(i).css(h,c[i]-(c[i]-(i*f+i*a.spacing))*d+"px")},duration:a.duration,easing:a.easing})})})}})(jQuery);