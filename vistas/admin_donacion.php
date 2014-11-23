<div class="wrap">
    <h2>Cripto-Pay.com | <?php _e("Donaciones", CP_DONACIONES_TEXTDOMAIN); ?></h2>

    <form action="" method="get">


        <table class="wp-list-table widefat fixed">
            <thead>
                <tr>
                    <th scope="col" id="cb" class="manage-column column-cb check-column" style=""></th>
                    <th scope="col" id="username" class="manage-column column-username sortable desc" style=""><?php _e("Cantidad", CP_DONACIONES_TEXTDOMAIN); ?></th>
                    <th scope="col" id="name" class="manage-column column-name sortable desc" style=""><?php _e("Fecha y Hora", CP_DONACIONES_TEXTDOMAIN); ?></th>
                    <th scope="col" id="email" class="manage-column column-email sortable desc" style=""><?php _e("Divisa", CP_DONACIONES_TEXTDOMAIN); ?></th>
                    <th scope="col" id="role" class="manage-column column-role" style=""><?php _e("Confirmaciones", CP_DONACIONES_TEXTDOMAIN); ?></th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th scope="col" id="cb" class="manage-column column-cb check-column" style=""></th>
                    <th scope="col" id="username" class="manage-column column-username sortable desc" style=""><?php _e("Cantidad", CP_DONACIONES_TEXTDOMAIN); ?></th>
                    <th scope="col" id="name" class="manage-column column-name sortable desc" style=""><?php _e("Fecha y Hora", CP_DONACIONES_TEXTDOMAIN); ?></th>
                    <th scope="col" id="email" class="manage-column column-email sortable desc" style=""><?php _e("Divisa", CP_DONACIONES_TEXTDOMAIN); ?></th>
                    <th scope="col" id="role" class="manage-column column-role" style=""><?php _e("Confirmaciones", CP_DONACIONES_TEXTDOMAIN); ?></th>
            </tfoot>

            <tbody id="the-list" data-wp-lists="list:user">
<?php
global $CP_donaciones;
if(count($CP_donaciones)>=1 && is_array($CP_donaciones)){
            $formato_fecha = get_option('date_format');

foreach ($CP_donaciones as $donacion){
                echo '<tr class="alternate">';
                echo '    <th scope="row" class="check-column"></th>';
                echo '    <td class="username column-username">'.$donacion['cantidad'].' '.$donacion['divisa'].'</td>';
                echo '    <td class="name column-name">'.date($formato_fecha,$donacion['time']).'</td>';
                echo '    <td class="email column-email">'.$donacion['criptomoneda'].'</td>';
                echo '    <td class="role column-role">'.$donacion['confirmaciones'].'</td>';
                echo '</tr>';
}
}else{
                echo '<tr class="alternate">';
                echo '    <th scope="row" class="check-column"></th>';
                echo '    <td class="username column-username" colspan="4" style="text-align:center">No has recibido aún ninguna donación aún.</td>';
                echo '</tr>';
}
?>                        
            </tbody>
        </table>
    </form>

    <br class="clear">
</div>
