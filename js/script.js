$(function(){
    $('input[placeholder]').placeholder(/*{ color: '#bada55' }*/);
    $( document ).tooltip();
    $.ionSound({
            sounds: [{name: "quake"}], //bell_ring, quake, sirena, tornado. //http://soundbible.com/tags-alert.html, http://media.io/
            path: "js/ion.sound/sounds/",
            preload: true
    });
    $('#menu a').colorbox({iframe:true, width:'520px', height:'75%', opacity: 0.5});
});
function popup(message, func){
    ($('#popup').length?$('#popup'):$('<div id="popup"/>').html('<span class="button"><span>X</span></span>'+message)).bPopup({autoClose: 2000,modalColor:"#fff", opacity:.7, closeClass:'button', position: ['50%', '50%'], onClose: function() { if(func)func(); }});  
}

