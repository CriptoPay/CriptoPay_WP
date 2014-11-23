jQuery(document).ready(function(){
    
    jQuery(".actualizar-datos").click(function(){
        jQuery.post(
        "/wp-admin/admin-ajax.php", 
        {
            'action': 'CP_admin_guardar',
            'data':   jQuery("#cp_data_form").serialize()
        }, 
        function(response){
            alert('The server responded: ' + response);
        }
        );  
    });
    
    });