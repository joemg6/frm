!function(){jQuery.color={},jQuery.color.make=function(t,i,e,a){var n={};return n.r=t||0,n.g=i||0,n.b=e||0,n.a=null!=a?a:1,n.add=function(t,i){for(var e=0;e<t.length;++e)n[t.charAt(e)]+=i;return n.normalize()},n.scale=function(t,i){for(var e=0;e<t.length;++e)n[t.charAt(e)]*=i;return n.normalize()},n.toString=function(){return n.a>=1?"rgb("+[n.r,n.g,n.b].join(",")+")":"rgba("+[n.r,n.g,n.b,n.a].join(",")+")"},n.normalize=function(){function t(t,i,e){return t>i?t:i>e?e:i}return n.r=t(0,parseInt(n.r),255),n.g=t(0,parseInt(n.g),255),n.b=t(0,parseInt(n.b),255),n.a=t(0,n.a,1),n},n.clone=function(){return jQuery.color.make(n.r,n.b,n.g,n.a)},n.normalize()},jQuery.color.extract=function(t,i){var e;do{if(e=t.css(i).toLowerCase(),""!=e&&"transparent"!=e)break;t=t.parent()}while(!jQuery.nodeName(t.get(0),"body"));return"rgba(0, 0, 0, 0)"==e&&(e="transparent"),jQuery.color.parse(e)},jQuery.color.parse=function(i){var e,a=jQuery.color.make;if(e=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(i))return a(parseInt(e[1],10),parseInt(e[2],10),parseInt(e[3],10));if(e=/rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]+(?:\.[0-9]+)?)\s*\)/.exec(i))return a(parseInt(e[1],10),parseInt(e[2],10),parseInt(e[3],10),parseFloat(e[4]));if(e=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(i))return a(2.55*parseFloat(e[1]),2.55*parseFloat(e[2]),2.55*parseFloat(e[3]));if(e=/rgba\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\s*\)/.exec(i))return a(2.55*parseFloat(e[1]),2.55*parseFloat(e[2]),2.55*parseFloat(e[3]),parseFloat(e[4]));if(e=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(i))return a(parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16));if(e=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(i))return a(parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16));var n=jQuery.trim(i).toLowerCase();return"transparent"==n?a(255,255,255,0):(e=t[n],a(e[0],e[1],e[2]))};var t={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0]}}(),function(t){function e(e,n,o,r){function l(t,i){i=[ni].concat(i);for(var e=0;e<t.length;++e)t[e].apply(this,i)}function s(){for(var i=0;i<r.length;++i){var e=r[i];e.init(ni),e.options&&t.extend(!0,E,e.options)}}function c(i){t.extend(!0,E,i),null==E.grid.borderColor&&(E.grid.borderColor=E.grid.color),E.xaxis.noTicks&&null==E.xaxis.ticks&&(E.xaxis.ticks=E.xaxis.noTicks),E.yaxis.noTicks&&null==E.yaxis.ticks&&(E.yaxis.ticks=E.yaxis.noTicks),E.grid.coloredAreas&&(E.grid.markings=E.grid.coloredAreas),E.grid.coloredAreasColor&&(E.grid.markingsColor=E.grid.coloredAreasColor),E.lines&&t.extend(!0,E.series.lines,E.lines),E.points&&t.extend(!0,E.series.points,E.points),E.bars&&t.extend(!0,E.series.bars,E.bars),E.shadowSize&&(E.series.shadowSize=E.shadowSize);for(var e in ai)E.hooks[e]&&E.hooks[e].length&&(ai[e]=ai[e].concat(E.hooks[e]));l(ai.processOptions,[E])}function u(t){q=m(t),d(),h()}function m(i){for(var e=[],a=0;a<i.length;++a){var n=t.extend(!0,{},E.series);i[a].data?(n.data=i[a].data,delete i[a].data,t.extend(!0,n,i[a]),i[a].data=n.data):n.data=i[a],e.push(n)}return e}function f(t,i){var e=t[i];return e&&1!=e?"number"==typeof e?K[i.charAt(0)+e+i.slice(1)]:e:K[i]}function d(){var i,e=q.length,a=[],n=[];for(i=0;i<q.length;++i){var o=q[i].color;null!=o&&(--e,"number"==typeof o?n.push(o):a.push(t.color.parse(q[i].color)))}for(i=0;i<n.length;++i)e=Math.max(e,n[i]+1);var r=[],l=0;for(i=0;r.length<e;){var s;s=E.colors.length==i?t.color.make(100,100,100):t.color.parse(E.colors[i]);var c=l%2==1?-1:1;s.scale("rgb",1+c*Math.ceil(l/2)*.2),r.push(s),++i,i>=E.colors.length&&(i=0,++l)}var u,m=0;for(i=0;i<q.length;++i){if(u=q[i],null==u.color?(u.color=r[m].toString(),++m):"number"==typeof u.color&&(u.color=r[u.color].toString()),null==u.lines.show){var d,h=!0;for(d in u)if(u[d].show){h=!1;break}h&&(u.lines.show=!0)}u.xaxis=f(u,"xaxis"),u.yaxis=f(u,"yaxis")}}function h(){function t(t,i,e){i<t.datamin&&(t.datamin=i),e>t.datamax&&(t.datamax=e)}var i,e,a,n,o,r,s,c,u,m,f,d=Number.POSITIVE_INFINITY,h=Number.NEGATIVE_INFINITY;for(c in K)K[c].datamin=d,K[c].datamax=h,K[c].used=!1;for(i=0;i<q.length;++i)o=q[i],o.datapoints={points:[]},l(ai.processRawData,[o,o.data,o.datapoints]);for(i=0;i<q.length;++i){o=q[i];var p=o.data,x=o.datapoints.format;if(x||(x=[],x.push({x:!0,number:!0,required:!0}),x.push({y:!0,number:!0,required:!0}),o.bars.show&&x.push({y:!0,number:!0,required:!1,defaultValue:0}),o.datapoints.format=x),null==o.datapoints.pointsize)for(null==o.datapoints.pointsize&&(o.datapoints.pointsize=x.length),s=o.datapoints.pointsize,r=o.datapoints.points,insertSteps=o.lines.show&&o.lines.steps,o.xaxis.used=o.yaxis.used=!0,e=a=0;e<p.length;++e,a+=s){f=p[e];var g=null==f;if(!g)for(n=0;s>n;++n)u=f[n],m=x[n],m&&(m.number&&null!=u&&(u=+u,isNaN(u)&&(u=null)),null==u&&(m.required&&(g=!0),null!=m.defaultValue&&(u=m.defaultValue))),r[a+n]=u;if(g)for(n=0;s>n;++n)u=r[a+n],null!=u&&(m=x[n],m.x&&t(o.xaxis,u,u),m.y&&t(o.yaxis,u,u)),r[a+n]=null;else if(insertSteps&&a>0&&null!=r[a-s]&&r[a-s]!=r[a]&&r[a-s+1]!=r[a+1]){for(n=0;s>n;++n)r[a+s+n]=r[a+n];r[a+1]=r[a-s+1],a+=s}}}for(i=0;i<q.length;++i)o=q[i],l(ai.processDatapoints,[o,o.datapoints]);for(i=0;i<q.length;++i){o=q[i],r=o.datapoints.points,s=o.datapoints.pointsize;var b=d,v=d,k=h,y=h;for(e=0;e<r.length;e+=s)if(null!=r[e])for(n=0;s>n;++n)u=r[e+n],m=x[n],m&&(m.x&&(b>u&&(b=u),u>k&&(k=u)),m.y&&(v>u&&(v=u),u>y&&(y=u)));if(o.bars.show){var T="left"==o.bars.align?0:-o.bars.barWidth/2;o.bars.horizontal?(v+=T,y+=T+o.bars.barWidth):(b+=T,k+=T+o.bars.barWidth)}t(o.xaxis,b,k),t(o.yaxis,v,y)}for(c in K)K[c].datamin==d&&(K[c].datamin=null),K[c].datamax==h&&(K[c].datamax=null)}function p(){function i(i,e){var a=document.createElement("canvas");return a.width=i,a.height=e,t.browser.msie&&(a=window.G_vmlCanvasManager.initElement(a)),a}if($=e.width(),ti=e.height(),e.html(""),"static"==e.css("position")&&e.css("position","relative"),0>=$||0>=ti)throw"Invalid dimensions for plot, width = "+$+", height = "+ti;t.browser.msie&&window.G_vmlCanvasManager.init_(document),B=t(i($,ti)).appendTo(e).get(0),J=B.getContext("2d"),V=t(i($,ti)).css({position:"absolute",left:0,top:0}).appendTo(e).get(0),X=V.getContext("2d"),X.stroke()}function x(){_=t([V,B]),E.grid.hoverable&&_.mousemove(A),E.grid.clickable&&_.click(D),l(ai.bindEvents,[_])}function g(){function a(t,i){function e(t){return t}var a,n,o=i.transform||e,r=i.inverseTransform;t==K.xaxis||t==K.x2axis?(a=t.scale=ii/(o(t.max)-o(t.min)),n=o(t.min),t.p2c=o==e?function(t){return(t-n)*a}:function(t){return(o(t)-n)*a},t.c2p=r?function(t){return r(n+t/a)}:function(t){return n+t/a}):(a=t.scale=ei/(o(t.max)-o(t.min)),n=o(t.max),t.p2c=o==e?function(t){return(n-t)*a}:function(t){return(n-o(t))*a},t.c2p=r?function(t){return r(n-t/a)}:function(t){return n-t/a})}function n(i,a){var n,o,r=[];if(i.labelWidth=a.labelWidth,i.labelHeight=a.labelHeight,i==K.xaxis||i==K.x2axis){if(null==i.labelWidth&&(i.labelWidth=$/(i.ticks.length>0?i.ticks.length:1)),null==i.labelHeight){for(r=[],n=0;n<i.ticks.length;++n)o=i.ticks[n].label,o&&r.push('<div class="tickLabel" style="float:left;width:'+i.labelWidth+'px">'+o+"</div>");if(r.length>0){var l=t('<div style="position:absolute;top:-10000px;width:10000px;font-size:smaller">'+r.join("")+'<div style="clear:left"></div></div>').appendTo(e);i.labelHeight=l.height(),l.remove()}}}else if(null==i.labelWidth||null==i.labelHeight){for(n=0;n<i.ticks.length;++n)o=i.ticks[n].label,o&&r.push('<div class="tickLabel">'+o+"</div>");if(r.length>0){var l=t('<div style="position:absolute;top:-10000px;font-size:smaller">'+r.join("")+"</div>").appendTo(e);null==i.labelWidth&&(i.labelWidth=l.width()),null==i.labelHeight&&(i.labelHeight=l.find("div").height()),l.remove()}}null==i.labelWidth&&(i.labelWidth=0),null==i.labelHeight&&(i.labelHeight=0)}function o(){var t=E.grid.borderWidth;for(i=0;i<q.length;++i)t=Math.max(t,2*(q[i].points.radius+q[i].points.lineWidth/2));Z.left=Z.right=Z.top=Z.bottom=t;var e=E.grid.labelMargin+E.grid.borderWidth;K.xaxis.labelHeight>0&&(Z.bottom=Math.max(t,K.xaxis.labelHeight+e)),K.yaxis.labelWidth>0&&(Z.left=Math.max(t,K.yaxis.labelWidth+e)),K.x2axis.labelHeight>0&&(Z.top=Math.max(t,K.x2axis.labelHeight+e)),K.y2axis.labelWidth>0&&(Z.right=Math.max(t,K.y2axis.labelWidth+e)),ii=$-Z.left-Z.right,ei=ti-Z.bottom-Z.top}var r;for(r in K)b(K[r],E[r]);if(E.grid.show){for(r in K)v(K[r],E[r]),k(K[r],E[r]),n(K[r],E[r]);o()}else Z.left=Z.right=Z.top=Z.bottom=0,ii=$,ei=ti;for(r in K)a(K[r],E[r]);E.grid.show&&w(),U()}function b(t,i){var e=+(null!=i.min?i.min:t.datamin),a=+(null!=i.max?i.max:t.datamax),n=a-e;if(0==n){var o=0==a?1:.01;null==i.min&&(e-=o),(null==i.max||null!=i.min)&&(a+=o)}else{var r=i.autoscaleMargin;null!=r&&(null==i.min&&(e-=n*r,0>e&&null!=t.datamin&&t.datamin>=0&&(e=0)),null==i.max&&(a+=n*r,a>0&&null!=t.datamax&&t.datamax<=0&&(a=0)))}t.min=e,t.max=a}function v(i,e){var n;n="number"==typeof e.ticks&&e.ticks>0?e.ticks:i==K.xaxis||i==K.x2axis?.3*Math.sqrt($):.3*Math.sqrt(ti);var o,r,l,s,c,u,m,f=(i.max-i.min)/n;if("time"==e.mode){var d={second:1e3,minute:6e4,hour:36e5,day:864e5,month:2592e6,year:525949.2*60*1e3},h=[[1,"second"],[2,"second"],[5,"second"],[10,"second"],[30,"second"],[1,"minute"],[2,"minute"],[5,"minute"],[10,"minute"],[30,"minute"],[1,"hour"],[2,"hour"],[4,"hour"],[8,"hour"],[12,"hour"],[1,"day"],[2,"day"],[3,"day"],[.25,"month"],[.5,"month"],[1,"month"],[2,"month"],[3,"month"],[6,"month"],[1,"year"]],p=0;for(null!=e.minTickSize&&(p="number"==typeof e.tickSize?e.tickSize:e.minTickSize[0]*d[e.minTickSize[1]]),c=0;c<h.length-1&&!(f<(h[c][0]*d[h[c][1]]+h[c+1][0]*d[h[c+1][1]])/2&&h[c][0]*d[h[c][1]]>=p);++c);o=h[c][0],l=h[c][1],"year"==l&&(u=Math.pow(10,Math.floor(Math.log(f/d.year)/Math.LN10)),m=f/d.year/u,o=1.5>m?1:3>m?2:7.5>m?5:10,o*=u),e.tickSize&&(o=e.tickSize[0],l=e.tickSize[1]),r=function(t){var i=[],e=t.tickSize[0],n=t.tickSize[1],o=new Date(t.min),r=e*d[n];"second"==n&&o.setUTCSeconds(a(o.getUTCSeconds(),e)),"minute"==n&&o.setUTCMinutes(a(o.getUTCMinutes(),e)),"hour"==n&&o.setUTCHours(a(o.getUTCHours(),e)),"month"==n&&o.setUTCMonth(a(o.getUTCMonth(),e)),"year"==n&&o.setUTCFullYear(a(o.getUTCFullYear(),e)),o.setUTCMilliseconds(0),r>=d.minute&&o.setUTCSeconds(0),r>=d.hour&&o.setUTCMinutes(0),r>=d.day&&o.setUTCHours(0),r>=4*d.day&&o.setUTCDate(1),r>=d.year&&o.setUTCMonth(0);var l,s=0,c=Number.NaN;do if(l=c,c=o.getTime(),i.push({v:c,label:t.tickFormatter(c,t)}),"month"==n)if(1>e){o.setUTCDate(1);var u=o.getTime();o.setUTCMonth(o.getUTCMonth()+1);var m=o.getTime();o.setTime(c+s*d.hour+(m-u)*e),s=o.getUTCHours(),o.setUTCHours(0)}else o.setUTCMonth(o.getUTCMonth()+e);else"year"==n?o.setUTCFullYear(o.getUTCFullYear()+e):o.setTime(c+r);while(c<t.max&&c!=l);return i},s=function(i,a){var n=new Date(i);if(null!=e.timeformat)return t.plot.formatDate(n,e.timeformat,e.monthNames);var o=a.tickSize[0]*d[a.tickSize[1]],r=a.max-a.min,l=e.twelveHourClock?" %p":"";return fmt=o<d.minute?"%h:%M:%S"+l:o<d.day?r<2*d.day?"%h:%M"+l:"%b %d %h:%M"+l:o<d.month?"%b %d":o<d.year?r<d.year?"%b":"%b %y":"%y",t.plot.formatDate(n,fmt,e.monthNames)}}else{var x=e.tickDecimals,g=-Math.floor(Math.log(f)/Math.LN10);null!=x&&g>x&&(g=x),u=Math.pow(10,-g),m=f/u,1.5>m?o=1:3>m?(o=2,m>2.25&&(null==x||x>=g+1)&&(o=2.5,++g)):o=7.5>m?5:10,o*=u,null!=e.minTickSize&&o<e.minTickSize&&(o=e.minTickSize),null!=e.tickSize&&(o=e.tickSize),i.tickDecimals=Math.max(0,null!=x?x:g),r=function(t){var i,e=[],n=a(t.min,t.tickSize),o=0,r=Number.NaN;do i=r,r=n+o*t.tickSize,e.push({v:r,label:t.tickFormatter(r,t)}),++o;while(r<t.max&&r!=i);return e},s=function(t,i){return t.toFixed(i.tickDecimals)}}i.tickSize=l?[o,l]:o,i.tickGenerator=r,i.tickFormatter=t.isFunction(e.tickFormatter)?function(t,i){return""+e.tickFormatter(t,i)}:s}function k(i,e){if(i.ticks=[],i.used){if(null==e.ticks)i.ticks=i.tickGenerator(i);else if("number"==typeof e.ticks)e.ticks>0&&(i.ticks=i.tickGenerator(i));else if(e.ticks){var a=e.ticks;t.isFunction(a)&&(a=a({min:i.min,max:i.max}));var n,o;for(n=0;n<a.length;++n){var r=null,l=a[n];"object"==typeof l?(o=l[0],l.length>1&&(r=l[1])):o=l,null==r&&(r=i.tickFormatter(o,i)),i.ticks[n]={v:o,label:r}}}null!=e.autoscaleMargin&&i.ticks.length>0&&(null==e.min&&(i.min=Math.min(i.min,i.ticks[0].v)),null==e.max&&i.ticks.length>1&&(i.max=Math.max(i.max,i.ticks[i.ticks.length-1].v)))}}function y(){J.clearRect(0,0,$,ti);var t=E.grid;t.show&&!t.aboveData&&M();for(var i=0;i<q.length;++i)C(q[i]);l(ai.draw,[J]),t.show&&t.aboveData&&M()}function T(t,i){var e,a,n,o=i+"axis",r=i+"2axis";return t[o]?(e=K[o],a=t[o].from,n=t[o].to):t[r]?(e=K[r],a=t[r].from,n=t[r].to):(e=K[o],a=t[i+"1"],n=t[i+"2"]),null!=a&&null!=n&&a>n?{from:n,to:a,axis:e}:{from:a,to:n,axis:e}}function M(){var i;J.save(),J.translate(Z.left,Z.top),E.grid.backgroundColor&&(J.fillStyle=G(E.grid.backgroundColor,ei,0,"rgba(255, 255, 255, 0)"),J.fillRect(0,0,ii,ei));var e=E.grid.markings;if(e)for(t.isFunction(e)&&(e=e({xmin:K.xaxis.min,xmax:K.xaxis.max,ymin:K.yaxis.min,ymax:K.yaxis.max,xaxis:K.xaxis,yaxis:K.yaxis,x2axis:K.x2axis,y2axis:K.y2axis})),i=0;i<e.length;++i){var a=e[i],n=T(a,"x"),o=T(a,"y");null==n.from&&(n.from=n.axis.min),null==n.to&&(n.to=n.axis.max),null==o.from&&(o.from=o.axis.min),null==o.to&&(o.to=o.axis.max),n.to<n.axis.min||n.from>n.axis.max||o.to<o.axis.min||o.from>o.axis.max||(n.from=Math.max(n.from,n.axis.min),n.to=Math.min(n.to,n.axis.max),o.from=Math.max(o.from,o.axis.min),o.to=Math.min(o.to,o.axis.max),(n.from!=n.to||o.from!=o.to)&&(n.from=n.axis.p2c(n.from),n.to=n.axis.p2c(n.to),o.from=o.axis.p2c(o.from),o.to=o.axis.p2c(o.to),n.from==n.to||o.from==o.to?(J.beginPath(),J.strokeStyle=a.color||E.grid.markingsColor,J.lineWidth=a.lineWidth||E.grid.markingsLineWidth,J.moveTo(n.from,o.from),J.lineTo(n.to,o.to),J.stroke()):(J.fillStyle=a.color||E.grid.markingsColor,J.fillRect(n.from,o.to,n.to-n.from,o.from-o.to))))}J.lineWidth=1,J.strokeStyle=E.grid.tickColor,J.beginPath();var r,l=K.xaxis;for(i=0;i<l.ticks.length;++i)r=l.ticks[i].v,r<=l.min||r>=K.xaxis.max||(J.moveTo(Math.floor(l.p2c(r))+J.lineWidth/2,0),J.lineTo(Math.floor(l.p2c(r))+J.lineWidth/2,ei));for(l=K.yaxis,i=0;i<l.ticks.length;++i)r=l.ticks[i].v,r<=l.min||r>=l.max||(J.moveTo(0,Math.floor(l.p2c(r))+J.lineWidth/2),J.lineTo(ii,Math.floor(l.p2c(r))+J.lineWidth/2));for(l=K.x2axis,i=0;i<l.ticks.length;++i)r=l.ticks[i].v,r<=l.min||r>=l.max||(J.moveTo(Math.floor(l.p2c(r))+J.lineWidth/2,-5),J.lineTo(Math.floor(l.p2c(r))+J.lineWidth/2,5));for(l=K.y2axis,i=0;i<l.ticks.length;++i)r=l.ticks[i].v,r<=l.min||r>=l.max||(J.moveTo(ii-5,Math.floor(l.p2c(r))+J.lineWidth/2),J.lineTo(ii+5,Math.floor(l.p2c(r))+J.lineWidth/2));if(J.stroke(),E.grid.borderWidth){var s=E.grid.borderWidth;J.lineWidth=s,J.strokeStyle=E.grid.borderColor,J.strokeRect(-s/2,-s/2,ii+s,ei+s)}J.restore()}function w(){function t(t,e){for(var a=0;a<t.ticks.length;++a){var n=t.ticks[a];!n.label||n.v<t.min||n.v>t.max||i.push(e(n,t))}}e.find(".tickLabels").remove();var i=['<div class="tickLabels" style="font-size:8px;color:'+E.grid.color+'">'],a=E.grid.labelMargin+E.grid.borderWidth;t(K.xaxis,function(t,i){return'<div style="position:absolute;top:'+(Z.top+ei+a)+"px;left:"+Math.round(Z.left+i.p2c(t.v)-i.labelWidth/2)+"px;width:"+i.labelWidth+'px;text-align:center" class="tickLabel"></div>'}),t(K.yaxis,function(t,i){return'<div style="position:absolute;top:'+Math.round(Z.top+i.p2c(t.v)-i.labelHeight/2)+"px;right:"+(Z.right+ii+a)+"px;width:"+i.labelWidth+'px;text-align:right" class="tickLabel">'+t.label+"</div>"}),t(K.x2axis,function(t,i){return'<div style="position:absolute;bottom:'+(Z.bottom+ei+a)+"px;left:"+Math.round(Z.left+i.p2c(t.v)-i.labelWidth/2)+"px;width:"+i.labelWidth+'px;text-align:center" class="tickLabel">'+t.label+"</div>"}),t(K.y2axis,function(t,i){return'<div style="position:absolute;top:'+Math.round(Z.top+i.p2c(t.v)-i.labelHeight/2)+"px;left:"+(Z.left+ii+a)+"px;width:"+i.labelWidth+'px;text-align:left" class="tickLabel">'+t.label+"</div>"}),i.push("</div>"),e.append(i.join(""))}function C(t){t.lines.show&&W(t),t.bars.show&&F(t),t.points.show&&S(t)}function W(t){function i(t,i,e,a,n){var o=t.points,r=t.pointsize,l=null,s=null;J.beginPath();for(var c=r;c<o.length;c+=r){var u=o[c-r],m=o[c-r+1],f=o[c],d=o[c+1];if(null!=u&&null!=f){if(d>=m&&m<n.min){if(d<n.min)continue;u=(n.min-m)/(d-m)*(f-u)+u,m=n.min}else if(m>=d&&d<n.min){if(m<n.min)continue;f=(n.min-m)/(d-m)*(f-u)+u,d=n.min}if(m>=d&&m>n.max){if(d>n.max)continue;u=(n.max-m)/(d-m)*(f-u)+u,m=n.max}else if(d>=m&&d>n.max){if(m>n.max)continue;f=(n.max-m)/(d-m)*(f-u)+u,d=n.max}if(f>=u&&u<a.min){if(f<a.min)continue;m=(a.min-u)/(f-u)*(d-m)+m,u=a.min}else if(u>=f&&f<a.min){if(u<a.min)continue;d=(a.min-u)/(f-u)*(d-m)+m,f=a.min}if(u>=f&&u>a.max){if(f>a.max)continue;m=(a.max-u)/(f-u)*(d-m)+m,u=a.max}else if(f>=u&&f>a.max){if(u>a.max)continue;d=(a.max-u)/(f-u)*(d-m)+m,f=a.max}(u!=l||m!=s)&&J.moveTo(a.p2c(u)+i,n.p2c(m)+e),l=f,s=d,J.lineTo(a.p2c(f)+i,n.p2c(d)+e)}}J.stroke()}function e(t,i,e){for(var a,n=t.points,o=t.pointsize,r=Math.min(Math.max(0,e.min),e.max),l=0,s=!1,c=o;c<n.length;c+=o){var u=n[c-o],m=n[c-o+1],f=n[c],d=n[c+1];if(s&&null!=u&&null==f)J.lineTo(i.p2c(l),e.p2c(r)),J.fill(),s=!1;else if(null!=u&&null!=f){if(f>=u&&u<i.min){if(f<i.min)continue;m=(i.min-u)/(f-u)*(d-m)+m,u=i.min}else if(u>=f&&f<i.min){if(u<i.min)continue;d=(i.min-u)/(f-u)*(d-m)+m,f=i.min}if(u>=f&&u>i.max){if(f>i.max)continue;m=(i.max-u)/(f-u)*(d-m)+m,u=i.max}else if(f>=u&&f>i.max){if(u>i.max)continue;d=(i.max-u)/(f-u)*(d-m)+m,f=i.max}if(s||(J.beginPath(),J.moveTo(i.p2c(u),e.p2c(r)),s=!0),m>=e.max&&d>=e.max)J.lineTo(i.p2c(u),e.p2c(e.max)),J.lineTo(i.p2c(f),e.p2c(e.max)),l=f;else if(m<=e.min&&d<=e.min)J.lineTo(i.p2c(u),e.p2c(e.min)),J.lineTo(i.p2c(f),e.p2c(e.min)),l=f;else{var h=u,p=f;d>=m&&m<e.min&&d>=e.min?(u=(e.min-m)/(d-m)*(f-u)+u,m=e.min):m>=d&&d<e.min&&m>=e.min&&(f=(e.min-m)/(d-m)*(f-u)+u,d=e.min),m>=d&&m>e.max&&d<=e.max?(u=(e.max-m)/(d-m)*(f-u)+u,m=e.max):d>=m&&d>e.max&&m<=e.max&&(f=(e.max-m)/(d-m)*(f-u)+u,d=e.max),u!=h&&(a=m<=e.min?e.min:e.max,J.lineTo(i.p2c(h),e.p2c(a)),J.lineTo(i.p2c(u),e.p2c(a))),J.lineTo(i.p2c(u),e.p2c(m)),J.lineTo(i.p2c(f),e.p2c(d)),f!=p&&(a=d<=e.min?e.min:e.max,J.lineTo(i.p2c(f),e.p2c(a)),J.lineTo(i.p2c(p),e.p2c(a))),l=Math.max(f,p)}}}s&&(J.lineTo(i.p2c(l),e.p2c(r)),J.fill())}J.save(),J.translate(Z.left,Z.top),J.lineJoin="round";var a=t.lines.lineWidth,n=t.shadowSize;if(a>0&&n>0){J.lineWidth=n,J.strokeStyle="rgba(0,0,0,0.1)";var o=Math.PI/18;i(t.datapoints,Math.sin(o)*(a/2+n/2),Math.cos(o)*(a/2+n/2),t.xaxis,t.yaxis),J.lineWidth=n/2,i(t.datapoints,Math.sin(o)*(a/2+n/4),Math.cos(o)*(a/2+n/4),t.xaxis,t.yaxis)}J.lineWidth=a,J.strokeStyle=t.color;var r=I(t.lines,t.color,0,ei);r&&(J.fillStyle=r,e(t.datapoints,t.xaxis,t.yaxis)),a>0&&i(t.datapoints,0,0,t.xaxis,t.yaxis),J.restore()}function S(t){function i(t,i,e,a,n,o,r){for(var l=t.points,s=t.pointsize,c=0;c<l.length;c+=s){var u=l[c],m=l[c+1];null==u||u<o.min||u>o.max||m<r.min||m>r.max||(J.beginPath(),J.arc(o.p2c(u),r.p2c(m)+a,i,0,n,!1),e&&(J.fillStyle=e,J.fill()),J.stroke())}}J.save(),J.translate(Z.left,Z.top);var e=t.lines.lineWidth,a=t.shadowSize,n=t.points.radius;if(e>0&&a>0){var o=a/2;J.lineWidth=o,J.strokeStyle="rgba(0,0,0,0.1)",i(t.datapoints,n,null,o+o/2,Math.PI,t.xaxis,t.yaxis),J.strokeStyle="rgba(0,0,0,0.2)",i(t.datapoints,n,null,o/2,Math.PI,t.xaxis,t.yaxis)}J.lineWidth=e,J.strokeStyle=t.color,i(t.datapoints,n,I(t.points,t.color),0,2*Math.PI,t.xaxis,t.yaxis),J.restore()}function z(t,i,e,a,n,o,r,l,s,c,u){var m,f,d,h,p,x,g,b,v;u?(b=x=g=!0,p=!1,m=e,f=t,h=i+a,d=i+n,m>f&&(v=f,f=m,m=v,p=!0,x=!1)):(p=x=g=!0,b=!1,m=t+a,f=t+n,d=e,h=i,d>h&&(v=h,h=d,d=v,b=!0,g=!1)),f<l.min||m>l.max||h<s.min||d>s.max||(m<l.min&&(m=l.min,p=!1),f>l.max&&(f=l.max,x=!1),d<s.min&&(d=s.min,b=!1),h>s.max&&(h=s.max,g=!1),m=l.p2c(m),d=s.p2c(d),f=l.p2c(f),h=s.p2c(h),r&&(c.beginPath(),c.moveTo(m,d),c.lineTo(m,h),c.lineTo(f,h),c.lineTo(f,d),c.fillStyle=r(d,h),c.fill()),(p||x||g||b)&&(c.beginPath(),c.moveTo(m,d+o),p?c.lineTo(m,h+o):c.moveTo(m,h+o),g?c.lineTo(f,h+o):c.moveTo(f,h+o),x?c.lineTo(f,d+o):c.moveTo(f,d+o),b?c.lineTo(m,d+o):c.moveTo(m,d+o),c.stroke()))}function F(t){function i(i,e,a,n,o,r,l){for(var s=i.points,c=i.pointsize,u=0;u<s.length;u+=c)null!=s[u]&&z(s[u],s[u+1],s[u+2],e,a,n,o,r,l,J,t.bars.horizontal)}J.save(),J.translate(Z.left,Z.top),J.lineWidth=t.bars.lineWidth,J.strokeStyle=t.color;var e="left"==t.bars.align?0:-t.bars.barWidth/2,a=t.bars.fill?function(i,e){return I(t.bars,t.color,i,e)}:null;i(t.datapoints,e,e+t.bars.barWidth,0,a,t.xaxis,t.yaxis),J.restore()}function I(i,e,a,n){var o=i.fill;if(!o)return null;if(i.fillColor)return G(i.fillColor,a,n,e);var r=t.color.parse(e);return r.a="number"==typeof o?o:.4,r.normalize(),r.toString()}function U(){if(e.find(".legend").remove(),E.legend.show){var a,n,o=[],r=!1,l=E.legend.labelFormatter;for(i=0;i<q.length;++i)a=q[i],n=a.label,n&&(i%E.legend.noColumns==0&&(r&&o.push("</tr>"),o.push("<tr>"),r=!0),l&&(n=l(n,a)),o.push('<td class="legendColorBox"><div style="border:1px solid '+E.legend.labelBoxBorderColor+';padding:1px"><div style="width:4px;height:0;border:5px solid '+a.color+';overflow:hidden"></div></div></td><td class="legendLabel">'+n+"</td>"));if(r&&o.push("</tr>"),0!=o.length){var s='<table style="font-size:smaller;color:'+E.grid.color+'">'+o.join("")+"</table>";if(null!=E.legend.container)t(E.legend.container).html(s);else{var c="",u=E.legend.position,m=E.legend.margin;null==m[0]&&(m=[m,m]),"n"==u.charAt(0)?c+="top:"+(m[1]+Z.top)+"px;":"s"==u.charAt(0)&&(c+="bottom:"+(m[1]+Z.bottom)+"px;"),"e"==u.charAt(1)?c+="right:"+(m[0]+Z.right)+"px;":"w"==u.charAt(1)&&(c+="left:"+(m[0]+Z.left)+"px;");var f=t('<div class="legend">'+s.replace('style="','style="position:absolute;'+c+";")+"</div>").appendTo(e);if(0!=E.legend.backgroundOpacity){var d=E.legend.backgroundColor;null==d&&(d=E.grid.backgroundColor,d=d&&"string"==typeof d?t.color.parse(d):t.color.extract(f,"background-color"),d.a=1,d=d.toString());var h=f.children();t('<div style="position:absolute;width:'+h.width()+"px;height:"+h.height()+"px;"+c+"background-color:"+d+';"> </div>').prependTo(f).css("opacity",E.legend.backgroundOpacity)}}}}}function H(t,i,e){var a,n,o=E.grid.mouseActiveRadius,r=o*o+1,l=null;for(a=0;a<q.length;++a)if(e(q[a])){var s=q[a],c=s.xaxis,u=s.yaxis,m=s.datapoints.points,f=s.datapoints.pointsize,d=c.c2p(t),h=u.c2p(i),p=o/c.scale,x=o/u.scale;if(s.lines.show||s.points.show)for(n=0;n<m.length;n+=f){var g=m[n],b=m[n+1];if(null!=g&&!(g-d>p||-p>g-d||b-h>x||-x>b-h)){var v=Math.abs(c.p2c(g)-t),k=Math.abs(u.p2c(b)-i),y=v*v+k*k;r>=y&&(r=y,l=[a,n/f])}}if(s.bars.show&&!l){var T="left"==s.bars.align?0:-s.bars.barWidth/2,M=T+s.bars.barWidth;for(n=0;n<m.length;n+=f){var g=m[n],b=m[n+1],w=m[n+2];null!=g&&(q[a].bars.horizontal?d<=Math.max(w,g)&&d>=Math.min(w,g)&&h>=b+T&&b+M>=h:d>=g+T&&g+M>=d&&h>=Math.min(w,b)&&h<=Math.max(w,b))&&(l=[a,n/f])}}}return l?(a=l[0],n=l[1],f=q[a].datapoints.pointsize,{datapoint:q[a].datapoints.points.slice(n*f,(n+1)*f),dataIndex:n,series:q[a],seriesIndex:a}):null}function A(t){E.grid.hoverable&&N("plothover",t,function(t){return 0!=t.hoverable})}function D(t){N("plotclick",t,function(t){return 0!=t.clickable})}function N(t,i,a){var n=_.offset(),o={pageX:i.pageX,pageY:i.pageY},r=i.pageX-n.left-Z.left,l=i.pageY-n.top-Z.top;K.xaxis.used&&(o.x=K.xaxis.c2p(r)),K.yaxis.used&&(o.y=K.yaxis.c2p(l)),K.x2axis.used&&(o.x2=K.x2axis.c2p(r)),K.y2axis.used&&(o.y2=K.y2axis.c2p(l));var s=H(r,l,a);if(s&&(s.pageX=parseInt(s.series.xaxis.p2c(s.datapoint[0])+n.left+Z.left),s.pageY=parseInt(s.series.yaxis.p2c(s.datapoint[1])+n.top+Z.top)),E.grid.autoHighlight){for(var c=0;c<oi.length;++c){var u=oi[c];u.auto!=t||s&&u.series==s.series&&u.point==s.datapoint||O(u.series,u.point)}s&&L(s.series,s.datapoint,t)}e.trigger(t,[o,s])}function P(){ri||(ri=setTimeout(j,30))}function j(){ri=null,X.save(),X.clearRect(0,0,$,ti),X.translate(Z.left,Z.top);var t,i;for(t=0;t<oi.length;++t)i=oi[t],i.series.bars.show?R(i.series,i.point):Q(i.series,i.point);X.restore(),l(ai.drawOverlay,[X])}function L(t,i,e){"number"==typeof t&&(t=q[t]),"number"==typeof i&&(i=t.data[i]);var a=Y(t,i);-1==a?(oi.push({series:t,point:i,auto:e}),P()):e||(oi[a].auto=!1)}function O(t,i){null==t&&null==i&&(oi=[],P()),"number"==typeof t&&(t=q[t]),"number"==typeof i&&(i=t.data[i]);var e=Y(t,i);-1!=e&&(oi.splice(e,1),P())}function Y(t,i){for(var e=0;e<oi.length;++e){var a=oi[e];if(a.series==t&&a.point[0]==i[0]&&a.point[1]==i[1])return e}return-1}function Q(i,e){var a=e[0],n=e[1],o=i.xaxis,r=i.yaxis;if(!(a<o.min||a>o.max||n<r.min||n>r.max)){var l=i.points.radius+i.points.lineWidth/2;X.lineWidth=l,X.strokeStyle=t.color.parse(i.color).scale("a",.5).toString();var s=1.5*l;X.beginPath(),X.arc(o.p2c(a),r.p2c(n),s,0,2*Math.PI,!1),X.stroke()}}function R(i,e){X.lineWidth=i.bars.lineWidth,X.strokeStyle=t.color.parse(i.color).scale("a",.5).toString();var a=t.color.parse(i.color).scale("a",.5).toString(),n="left"==i.bars.align?0:-i.bars.barWidth/2;z(e[0],e[1],e[2]||0,n,n+i.bars.barWidth,0,function(){return a},i.xaxis,i.yaxis,X,i.bars.horizontal)}function G(i,e,a,n){if("string"==typeof i)return i;for(var o=J.createLinearGradient(0,a,0,e),r=0,l=i.colors.length;l>r;++r){var s=i.colors[r];"string"!=typeof s&&(s=t.color.parse(n).scale("rgb",s.brightness),s.a*=s.opacity,s=s.toString()),o.addColorStop(r/(l-1),s)}return o}var q=[],E={colors:["#fc6b38","#afd8f8","#cb4b4b","#4da74d","#9440ed"],legend:{show:!0,noColumns:1,labelFormatter:null,labelBoxBorderColor:"#FFF",container:null,position:"ne",margin:5,backgroundColor:null,backgroundOpacity:.85},xaxis:{mode:null,transform:null,inverseTransform:null,min:null,max:null,autoscaleMargin:null,ticks:null,tickFormatter:null,labelWidth:null,labelHeight:null,tickDecimals:null,tickSize:null,minTickSize:null,monthNames:null,timeformat:null,twelveHourClock:!1},yaxis:{autoscaleMargin:.02},x2axis:{autoscaleMargin:null},y2axis:{autoscaleMargin:.02},series:{points:{show:!1,radius:3,lineWidth:2,fill:!0,fillColor:"#ffffff"},lines:{lineWidth:1,fill:!1,fillColor:"null",steps:!1},bars:{show:!1,lineWidth:2,barWidth:3,fill:!0,fillColor:null,align:"center",horizontal:!1},shadowSize:3},grid:{show:!0,aboveData:!1,color:"#2473f2",backgroundColor:null,tickColor:"#d8e5f2",labelMargin:5,borderWidth:0,borderColor:null,markings:null,markingsColor:"#f4f4f4",markingsLineWidth:2,clickable:!1,hoverable:!1,autoHighlight:!0,mouseActiveRadius:10},hooks:{}},B=null,V=null,_=null,J=null,X=null,K={xaxis:{},yaxis:{},x2axis:{},y2axis:{}},Z={left:0,right:0,top:0,bottom:0},$=0,ti=0,ii=0,ei=0,ai={processOptions:[],processRawData:[],processDatapoints:[],draw:[],bindEvents:[],drawOverlay:[]},ni=this;ni.setData=u,ni.setupGrid=g,ni.draw=y,ni.getPlaceholder=function(){return e},ni.getCanvas=function(){return B},ni.getPlotOffset=function(){return Z},ni.width=function(){return ii},ni.height=function(){return ei},ni.offset=function(){var t=_.offset();return t.left+=Z.left,t.top+=Z.top,t},ni.getData=function(){return q},ni.getAxes=function(){return K},ni.getOptions=function(){return E},ni.highlight=L,ni.unhighlight=O,ni.triggerRedrawOverlay=P,ni.pointOffset=function(t){return{left:parseInt(f(t,"xaxis").p2c(+t.x)+Z.left),top:parseInt(f(t,"yaxis").p2c(+t.y)+Z.top)}},ni.hooks=ai,s(ni),c(o),p(),u(n),g(),y(),x();var oi=[],ri=null}function a(t,i){return i*Math.floor(t/i)}t.plot=function(i,a,n){var o=new e(t(i),a,n,t.plot.plugins);return o},t.plot.plugins=[],t.plot.formatDate=function(t,i,e){var a=function(t){return t=""+t,1==t.length?"0"+t:t},n=[],o=!1,r=t.getUTCHours(),l=12>r;null==e&&(e=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]),-1!=i.search(/%p|%P/)&&(r>12?r-=12:0==r&&(r=12));for(var s=0;s<i.length;++s){var c=i.charAt(s);if(o){switch(c){case"h":c=""+r;break;case"H":c=a(r);break;case"M":c=a(t.getUTCMinutes());break;case"S":c=a(t.getUTCSeconds());break;case"d":c=""+t.getUTCDate();break;case"m":c=""+(t.getUTCMonth()+1);break;case"y":c=""+t.getUTCFullYear();break;case"b":c=""+e[t.getUTCMonth()];break;case"p":c=l?"am":"pm";break;case"P":c=l?"AM":"PM"}n.push(c),o=!1}else"%"==c?o=!0:n.push(c)}return n.join("")}}(jQuery);