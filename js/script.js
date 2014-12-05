$(function(){
    $('input[placeholder]').placeholder(/*{ color: '#bada55' }*/);
    $( document ).tooltip();
});
function popup(message, func){
    ($('#popup').length?$('#popup'):$('<div id="popup"/>').html('<span class="button"><span>X</span></span>'+message)).bPopup({autoClose: 2000,modalColor:"#fff", opacity:.7, closeClass:'button', position: ['50%', '50%'], onClose: function() { if(func)func(); }});  
}
function info(message){
    $('<div/>').html(message).dialog({
        dialogClass: 'dialog-info',
        title: 'INFORMACIÓN',
        modal: true,
        resizable: false,
        draggable: true,
        closeOnEscape: true,
        width: 300,
        height: 'auto',
        show: { effect: "fade", duration: 500 },
        hide: { effect: "fade", duration: 500 },
        close:function(){
            $(this).dialog('destroy');
            $(this).remove();
        },
        open:function(){
            var dialogo = $(this);
            setTimeout(function(){
                $(dialogo).dialog('close');
            },3000)
        }
    });
    
}
function error(message, callback){
    $('<div/>').html(message).dialog({
        dialogClass: 'dialog-error',
        title: 'ERROR',
        modal: true,
        resizable: false,
        draggable: true,
        closeOnEscape: true,
        width: 300,
        height: 'auto',
        show: { effect: "bounce", duration: 800 },
        hide: { effect: "fade", duration: 500 },
        close:function(){
            $(this).dialog('destroy');
            $(this).remove();
            if(callback)callback();
        }
    });
}
function confirm(message, callback){
    $('<div/>').html(message).dialog({
        dialogClass: 'dialog-info',
        title: 'CONFIRMAR',
        modal: true,
        resizable: false,
        draggable: true,
        closeOnEscape: true,
        width: 300,
        height: 'auto',
        show: { effect: "highlight", duration: 500 },
        hide: { effect: "fade", duration: 500 },
        buttons: {
            "OK": function() {
                $(this).dialog('close');
                if(callback)callback();
            },
            "Cancelar": function(){
                $(this).dialog('close');
            }
        },
        close:function(){
            $(this).dialog('destroy');
            $(this).remove();
        }
    });
}