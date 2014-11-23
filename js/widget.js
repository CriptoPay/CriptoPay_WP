var QR_DONACIONES;
jQuery("#cp_w_d").bind("submit",function(e){
    e.preventDefault();
    var cantidad = jQuery("#cp_w_d #cantidad_donacion").val();
    var divisa_donacion = jQuery("#cp_w_d .divisa_donacion option:selected").val();
    var criptomoneda = jQuery("#cp_w_d .divisa_fiat option:selected").val()
    
    if(cantidad < 0.01 || cantidad == undefined || divisa_donacion == "undefined" || criptomoneda == "undefined"){
        alert("ERROR");
    }else{
        jQuery("#cp_don_qrcode img").hide();
        jQuery("#cp_don_qrcode .cargando").show();

        if(QR_DONACIONES != undefined){
            QR_DONACIONES.clear();
        }
        jQuery.post(
            CriptoPay.ajax_url, 
            {
                'action': 'cp_widget',
                'cantidad':   cantidad,
                'divisa_donacion': divisa_donacion,
                'criptomoneda': criptomoneda
            }, 
            function(response){
                if(!IsJsonString(response)){
                    jQuery("#cp_don_qrcode").append("<div class='alert error'>"+response+"</div>");
                }else{
                    respuesta = jQuery.parseJSON(response);
                    if(QR_DONACIONES == undefined){
                        QR_DONACIONES = new QRCode(document.getElementById("cp_don_qrcode"),{
                            text: "bitcoin:"+respuesta.direccion,
                            colorDark : "#000000",
                            colorLight : "#ffffff",
                            correctLevel : QRCode.CorrectLevel.H
                        });
                    }else{
                        QR_DONACIONES.makeCode(respuesta.divisa+":"+respuesta.direccion)
                    }
                    jQuery("#cp_don_qrcode .alert").remove()
                }
                jQuery("#cp_don_qrcode .cargando").hide();
            });
        }
    });
    
    function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}