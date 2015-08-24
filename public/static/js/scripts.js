$(document).ready(function(){

    //форма расылки
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


    //Добавление и удаление списков рассылки
    $('.addgroup').submit(function(e){
        e.preventDefault();
        var btn = $(this).children('button');
        btn.button('loading');

        $.get($(this).attr('action'), {type: btn.val()}).success(function(data) {

            if(data.status=="true") {
                if(data.doing=="added") {
                    btn.button('reset');
                    btn.removeClass('btn-primary');
                    btn.button('delete');
                    btn.addClass('btn-danger');
                    btn.val('delete');
                }
                if(data.doing=="deleted") {
                    btn.button('reset');
                    btn.removeClass('btn-danger');
                    btn.button('add');
                    btn.addClass('btn-primary');
                    btn.val('add');
                }
                //added alert
            }

            if(data.status=="false") {
                btn.button('reset');
                $(".main").prepend('' +
                    '<div class="alert alert-danger fade in">' +
                        '<p>'+data.message+'</p>' +
                    '</div>' +
                    '');

            }
        });



    });

});