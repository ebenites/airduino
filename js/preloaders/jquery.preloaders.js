/*
 * Creado por ebc erick benites erickpm: http://learn.jquery.com/plugins/basic-plugin-creation/
 * Generador de sprites.png: http://preloaders.net/en/popular (escoger APNG con javascript y solo considerar el sprites.png de dimension nxn)
 */
(function ( $ ) {

    $.fn.preloader = function( options ) {
        
        var element = this;
        
        var settings = $.extend({
            speed: '18',
            src: 'sprites.png', 
            frames: false,
            width: false, 
            height: false
        }, options );
        
        var genImage = new Image();
        genImage.onload=function (){
            
            var frames = (settings.frames)?settings.frames:genImage.width/genImage.height;
            var width = (settings.width)?settings.width:genImage.width/frames;
            var height = (settings.height)?settings.height:genImage.height;
            
            var slide = 0;
            
            element.css('width', width+'px');
            element.css('height', height+'px');
            element.css('background-image', 'url('+settings.src+')');
            
            var timer = setInterval(function(){
                element.css('background-position', (-slide)+'px 0');
                slide += width;
                if(slide >=  frames*width)
                    slide = 0;
                // Limpiar el intervalo cuando se elimina el loader con .remove()
                if(element.parent().length === 0)
                    clearInterval(timer);
            }, 1000/settings.speed);
            
            genImage = null;
            
        };
        genImage.onerror=function(){
            if(console) console.log('No se pudo cargar el preloader');
        };
        genImage.src=settings.src;
        
        return this;
    }

}( jQuery ));

$(function(){
	//How to use #loaderImage{position: absolute, (top/left or margins)}:
	//$('#loaderImage').preloader({src:'/campus/img/preloaders/sprites.png'});
});