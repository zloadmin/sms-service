$(document).ready(function(){

    ////форма расылки
    //if($("#planing").prop("checked")) { $('.planing').show(); }
    if($("#smoothly_2").prop("checked")) { $('.setperiod').removeClass('invisible'); }
    //if($("#planing_type1").prop("checked")) { $('.planing_type1').show(); $('.planing_type2').hide(); }
    //if($("#planing_type2").prop("checked")) { $('.planing_type2').show(); $('.planing_type1').hide(); $('.period').show();}
    $("#smoothly_1").change(function(){
        $(".setperiod").addClass("invisible");
    });
    $("#smoothly_2").change(function(){
        $(".setperiod").removeClass("invisible");
    });

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




    //Make message

    function rus2translit(t){
var text=t;
t="";
for (var a=0;a<text.length;a++){
     if (text.charAt(a)=='а'){t=t+'a';  }
else if (text.charAt(a)=='б'){t=t+'b';}
else if (text.charAt(a)=='в'){t=t+'v';}
else if (text.charAt(a)=='г'){t=t+'g';}
else if (text.charAt(a)=='д'){t=t+'d';}
else if (text.charAt(a)=='е'){t=t+'e';}
else if (text.charAt(a)=='ё'){t=t+'yo';}
else if (text.charAt(a)=='ж'){t=t+'zh';}
else if (text.charAt(a)=='з'){t=t+'z';}
else if (text.charAt(a)=='и'){t=t+'i';}
else if (text.charAt(a)=='й'){t=t+'j';}
else if (text.charAt(a)=='к'){t=t+'k';}
else if (text.charAt(a)=='л'){t=t+'l';}
else if (text.charAt(a)=='м'){t=t+'m';}
else if (text.charAt(a)=='н'){t=t+'n';}
else if (text.charAt(a)=='о'){t=t+'o';}
else if (text.charAt(a)=='п'){t=t+'p';}
else if (text.charAt(a)=='р'){t=t+'r';}
else if (text.charAt(a)=='с'){t=t+'s';}
else if (text.charAt(a)=='т'){t=t+'t';}
else if (text.charAt(a)=='у'){t=t+'u';}
else if (text.charAt(a)=='ф'){t=t+'f';}
else if (text.charAt(a)=='х'){t=t+'x';}
else if (text.charAt(a)=='ц'){t=t+'c';}
else if (text.charAt(a)=='ч'){t=t+'ch';}
else if (text.charAt(a)=='ш'){t=t+'sh';}
else if (text.charAt(a)=='щ'){t=t+'shh';}
else if (text.charAt(a)=='ь'){t=t+'';}
else if (text.charAt(a)=='ы'){t=t+'y';}
else if (text.charAt(a)=='ъ'){t=t+"'";}
else if (text.charAt(a)=='э'){t=t+'e';}
else if (text.charAt(a)=='ю'){t=t+'yu';}
else if (text.charAt(a)=='я'){t=t+'ya';}
else if (text.charAt(a)=='А'){t=t+'A';  }
else if (text.charAt(a)=='Б'){t=t+'B';}
else if (text.charAt(a)=='В'){t=t+'V';}
else if (text.charAt(a)=='Г'){t=t+'G';}
else if (text.charAt(a)=='Д'){t=t+'D';}
else if (text.charAt(a)=='Е'){t=t+'E';}
else if (text.charAt(a)=='Ё'){t=t+'Yo';}
else if (text.charAt(a)=='Ж'){t=t+'Zh';}
else if (text.charAt(a)=='З'){t=t+'Z';}
else if (text.charAt(a)=='И'){t=t+'I';}
else if (text.charAt(a)=='Й'){t=t+'J';}
else if (text.charAt(a)=='К'){t=t+'K';}
else if (text.charAt(a)=='Л'){t=t+'L';}
else if (text.charAt(a)=='М'){t=t+'M';}
else if (text.charAt(a)=='Н'){t=t+'N';}
else if (text.charAt(a)=='О'){t=t+'O';}
else if (text.charAt(a)=='П'){t=t+'P';}
else if (text.charAt(a)=='Р'){t=t+'R';}
else if (text.charAt(a)=='С'){t=t+'S';}
else if (text.charAt(a)=='Т'){t=t+'T';}
else if (text.charAt(a)=='У'){t=t+'U';}
else if (text.charAt(a)=='Ф'){t=t+'F';}
else if (text.charAt(a)=='Х'){t=t+'X';}
else if (text.charAt(a)=='Ц'){t=t+'C';}
else if (text.charAt(a)=='Ч'){t=t+'Ch';}
else if (text.charAt(a)=='Ш'){t=t+'Sh';}
else if (text.charAt(a)=='Щ'){t=t+'Shh';}
else if (text.charAt(a)=='Ь'){t=t+'`';}
else if (text.charAt(a)=='Ы'){t=t+'Y';}
else if (text.charAt(a)=='Ъ'){t=t+"``";}
else if (text.charAt(a)=='Э'){t=t+'E';}
else if (text.charAt(a)=='Ю'){t=t+'Yu';}
else if (text.charAt(a)=='Я'){t=t+'Ya';}
else if (text.charAt(a)=='«'){t=t+'"';}
else {
        if (text.charAt(a)<'~') t=t+text.charAt(a);

    }

}

return t;
}


function print_ostatok()
{
    var txt=$(this).val();
    var sms_count_color='black';

    var reg=/[^\x00-\x80]/;
    var FindRu=reg.test(txt);

    if (FindRu) encoding_bits=16; else encoding_bits=7;
    var a=txt.length*encoding_bits;
    var cnt=txt.length;

    if ($(this).hasClass('placeholder')){
     a=0;
     cnt=0;
    }

    var sms_count=1;
    if (a<=1120){
        sms_count=1;
    }else{
        sms_count=Math.ceil(a/1072);
    }


    var max_sms_count=10;

    var sms_count_text;

    if (sms_count>max_sms_count){
        sms_count_text=' Превышен лимит';
        sms_count_color = 'red';
        $(this).val(txt.substr(0, Math.floor(max_sms_count*1072/encoding_bits)));

    }else{
        sms_count_color = 'black';
        sms_count_text='';
    }

    var text='';
    text = 'Всего введено: <font><b>'+cnt+'</b></font> символов, <font color="'+sms_count_color+'">Количество частей:   <b>'+(sms_count)+'</b>';
    text += '<b> '+sms_count_text+'</b> </font>';

    $('#SMSLengthCounter_message').html(text);
}

$(function(){
    $('#message').keyup(print_ostatok).keyup();
})

var sms_copy;
jQuery(function(){
    jQuery("#translit_button_message").click(function(){
        if (!sms_copy){
            sms_copy=jQuery("#message").val();
            jQuery("#message").val(rus2translit(sms_copy));
            $(this).text("Вернуть");
        }else{
            jQuery("#message").val(sms_copy);
            sms_copy="";
            $(this).text("В транслит");
        }
        $('#message').keyup();
        return false;
    });

});

});