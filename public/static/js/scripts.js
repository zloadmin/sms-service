$(document).ready(function(){
    if($("#planing").prop("checked")) { $('.planing').show(); }
    if($("#smoothlyfalse").prop("checked")) { $('.setperiod').show(); }
    if($("#planing_type1").prop("checked")) { $('.planing_type1').show(); $('.planing_type2').hide(); }
    if($("#planing_type2").prop("checked")) { $('.planing_type2').show(); $('.planing_type1').hide(); $('.period').show();}

});