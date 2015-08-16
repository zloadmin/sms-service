$(document).ready(function(){
    if($("#planing").prop("checked")) { $('.planing').show(); }
    if($("#smoothlyfalse").prop("checked")) { $('.setperiod').show(); }
    if($("#planing_type1").prop("checked")) { $('.planing_type1').show(); $('.planing_type2').hide(); }
    if($("#planing_type2").prop("checked")) { $('.planing_type2').show(); $('.planing_type1').hide(); $('.period').show();}


    var now = new Date();
    $('#date_timepicker_send').datetimepicker({
        format:'Y-m-d H:i:s',
        onShow:function( ct ){
            this.setOptions({
                minDate: now
            })
        },
        lang:$('html').attr('lang') ? $('html').attr('lang') : 'en'
    });
    $('#date_timepicker_start').datetimepicker({
            format:'Y-m-d H:i:s',
            onShow:function( ct ){
                this.setOptions({
                    minDate: now
                })
            },
            lang:$('html').attr('lang') ? $('html').attr('lang') : 'en'
        });
    $('#date_timepicker_end').datetimepicker({
            format:'Y-m-d H:i:s',
            onShow:function( ct ){
                this.setOptions({
                    minDate:$('#date_timepicker_start').val()?$('#date_timepicker_start').val():false
                })
            },
            lang:$('html').attr('lang') ? $('html').attr('lang') : 'en'
        });

});