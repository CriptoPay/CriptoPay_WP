<?php
require_once(CP_DON_PLUGINPATH."/inc/config.php");
class CP_DON_core {
    
    private $CP_usuario;                //Usuario en Cripto-Pay.com
    private $CP_token;                  //Token accesso a la cuenta
    public static $CP_direcciones;      //Array de direcciones de donaci?n
    public $pluginStatus;               //Estado del plugin

    public function __construct() {
            // Load all hooks
            $this->loadAllHooks();
            
            if(get_option('CP_usuario')==false || get_option('CP_apikey') == false){
                $this->pluginStatus = false;
                add_action('admin_notices', array($this,'Alerta'));
            }else{
                $this->pluginStatus = true;
            }
    }
    
    public function addLocalization() {
        load_plugin_textdomain("criptopay", false, CP_DON_PLUGINPATH."/languages");
    }
    
    function w_p_control(){
        if(isset($_POST['cp_p_divisa'])){
            $div_activas = array();
            foreach($_POST['cp_p_divisa'] as $divisa=>$act){
                $div_activas[] = $divisa;
            }
            update_option('w_p_divisas', $div_activas);
            
            if(isset($_POST['cp_p_titulo'])){
                update_option('w_p_titulo', $_POST['cp_p_titulo']);
            }else{
                update_option('w_p_titulo', " ");
            }
        }
        $m_titulo = get_option('w_p_titulo');
        $m_divisas = get_option('w_p_divisas');
        global $CriptoPay_Divisas;
        if(!is_array($m_divisas)){
            foreach ($CriptoPay_Divisas as $divisa){
                $m_divisas[] = $divisa['abr'];
            }
            update_option('w_p_divisas', $m_divisas);
        }
echo <<< HTML
        <p>
            <label for="cp_p_titulo">Título:</label>
            <input class="widefat" id="cp_p_titulo" name="cp_p_titulo" type="text" value="$m_titulo">
        </p>
        <p>
        <label for="cp_p_divisas">Selecciona las imágenes a mostrar:</label>
HTML;
        foreach ($CriptoPay_Divisas as $divisa){
            if(in_array($divisa['abr'],$m_divisas)){
                echo '<br><input class="widefat" type="checkbox" id="cp_p_divisa['.$divisa['abr'].']" name="cp_p_divisa['.$divisa['abr'].']" checked="checked"/> '.$divisa['divisa'];
            }else{
                echo '<br><input class="widefat" type="checkbox" id="cp_p_divisa['.$divisa['abr'].']" name="cp_p_divisa['.$divisa['abr'].']"/> '.$divisa['divisa'];
            }
        }
        echo '</p>';       
    }
    
    function w_d_control(){
        echo 'Control 1';
    }
    
    function w_publi($args){
            echo $args['before_widget'];
            $m_titulo = get_option('w_p_titulo');
            $m_divisas = get_option('w_p_divisas');

            echo $args['before_title'] . $m_titulo . $args['after_title'];
            
            foreach ($m_divisas as $divisa){
                echo '<img src="'.CP_PLUGIN_URL.'/img/aceptado_'.$divisa.'_'.get_bloginfo('language').'.png">';
            }
            
            
            echo $args['after_widget'];
    }
    function w_donaciones($args){
        wp_enqueue_style( 'cp_w_css', CP_DON_PLUGINBASENAME . '/css/style.css');
        wp_enqueue_script( 'cp_w_js', CP_DON_PLUGINBASENAME . '/js/widget.js',array('jquery'));
        wp_enqueue_script( 'cp_qr');
        wp_localize_script( 'cp_w_js', 'CriptoPay',array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
        if($this->pluginStatus){
            echo $args['before_widget'];
            echo $args['before_title'] . 'Donaciones' . $args['after_title'];

            echo '
<form id="cp_w_d" class="cp_w_d">
    <label for="cantidad_donacion">Cantidad</label>
    <input id="cantidad_donacion" type="numeric" placeholder="7.50" required title="¿Cuanto quieres donar?">
    
    <label for="divisa_donacion">Divisa donaci&oacute;n</label>
    <select class="divisa_donacion" required title="¿De que?">
    <option value="" >Selecciona una divisa</option>
        <option value="EUR">EUR</option>
        <option value="USD">USD</option>
        <option value="BTC">bitcoin</option>
    </select>
    
    <label for="email_donacion">Email</label>
    <input id="email_donacion" type="email" placeholder="Email (opcional)">

    
    <label for="divisa_fiat">Criptomoneda para donar</label>
    <select class="divisa_fiat" required title="¿En que criptomoneda vas a donar?">
    <option value="" >Selecciona una divisa</option>
        <option value="BTC">bitcoin</option>
        <option value="PTC">pesetacoin</option>
        <option value="LTC">litecoin</option>
        <option value="SPA">spaincoin</option>
        <option value="DGC">dogecoin</option>
    </select>
    
    <input type="submit" value="Donar ahora!" />
    
    
    <div id="cp_don_qrcode" title="bitcoin:1j4h3E4nynMBWwMTeqP4fJhQEh3hPkRQb">
    <img class="cargando" src="http://i.imgur.com/OOy0a9n.gif" style="display:none"/>
    </div>
    <ul id="monedas_donacion">
        <li><img src="https://bitcoin.org/img/opengraph.png" /></li>
        <li><img src="http://cryptocur.com/wp-content/uploads/2012/11/new_litecoin_logo_large.png" /></li>
        <li><img src="http://i60.tinypic.com/2e0s9qt.jpg" /></li>
        <li><img src="http://dogecoin.com/imgs/dogecoin-300.png" /></li>        
    </ul>
    <img id="logo" src="https://cripto-pay.com/assets/img/logo.png" width="100%"/>
</form>
            
                ' ;
            echo $args['after_widget'];
        }elseif(current_user_can('manage_options')){
            echo $args['before_widget'];
            echo $args['before_title'] . 'Donaciones' . $args['after_title'];

            echo '<div class="cp_donaciones">'
            . 'Debes <a href="'.admin_url('admin.php?page=CriptoPay').'">configurar el plugin</a> para que pueda funcionar'
            . '</div>';
            echo $args['after_widget'];
        }
        
    }
    
    public function Alerta(){
        echo '<div class="error">
               <p>El plugin de Cripto-Pay.com necesita <a href="'.admin_url('admin.php?page=CriptoPay').'">actualizar los datos</a>.</p>
            </div>';        
    }
    
    public function addWidget(){
        wp_register_sidebar_widget('cp_w_donaciones','Donaciones Bitcoin y AltCoins (Cripto-Pay.com)', array($this, 'w_donaciones'));
        wp_register_widget_control('cp_w_donaciones','Donaciones Bitcoin y AltCoins (Cripto-Pay.com)', array($this, 'w_d_control'));
        
        wp_register_sidebar_widget('cp_w_publi','Botones criptomonedas aceptadas (Cripto-Pay.com)', array($this, 'w_publi'));
        wp_register_widget_control('cp_w_publi','Botones criptomonedas aceptadas (Cripto-Pay.com)', array($this, 'w_p_control'));
        
    }
    
    public function addAdminMenuPage(){        
        add_menu_page("Cripto-Pay.com Donaciones y Pagos", "Cripto-Pay.com", 'manage_options', "CriptoPay", array($this, 'PaginaAdmin'), '','99.87514');
        add_submenu_page("CriptoPay", "Donaciones", "Donaciones", 'manage_options', 'Donaciones', array($this, 'PaginaDonaciones'));
        //add_submenu_page("CriptoPay", "Pagos", "Pagos", 'manage_options', 'Pagos', array($this, 'PaginaPagos'));
    }
    
    
    public function PaginaAdmin(){
        require_once(CP_DON_PLUGINPATH."/vistas/admin.php");
    }
    public function PaginaDonaciones(){
        global $CP_donaciones;
        $CriptoPay = new CriptoPay(get_option('CP_usuario'),  get_option('CP_APIKEY'));
        $CP_donaciones = $CriptoPay->API('donaciones_recibidas');
        require_once(CP_DON_PLUGINPATH."/vistas/admin_donacion.php");
    }
    public function PaginaPagos(){
        require_once(CP_DON_PLUGINPATH."/vistas/admin.php");
    }
    
    
    public function loadAllHooks(){
        add_action( 'plugins_loaded', array($this, 'addLocalization') );
        
        //Agregamos la zona de Adminitraci?n
        add_action('admin_menu', array($this, 'addAdminMenuPage'));
        add_action('admin_enqueue_scripts', array($this, 'loadJC_admin'));
        
        //Habilitamos los Widgets
        add_action("widgets_init", array($this, 'addWidget'));
        add_action('wp_enqueue_scripts', array($this, 'loadJC_wp'));
        add_action('wp_ajax_cp_widget',array($this,'ajax_widget'));
        add_action('wp_ajax_nopriv_cp_widget',array($this,'ajax_widget'));
        
        
        add_action( 'plugins_loaded', array($this, 'addLocalization') );
        
        //Peticiones AJAX
        add_action('wp_ajax_CP_admin_guardar',array($this,'ajax_admin_guardar'));
        
        
        //add_action('wp_head','loadJS_all');
    }
    
    public function ajax_admin_guardar(){
        parse_str($_POST['data'],$data);
        if(!empty($data['CP_usuario']) && !empty($data['CP_apikey'])){
            update_option('CP_usuario', $data['CP_usuario']);
            update_option('CP_apikey', $data['CP_apikey']);
            //$this->VerificarAPI();
            die(_e("Datos actualizados",CP_TEXTDOMAIN));
        }else{
            die(_e("Los datos no han podido ser verificador",CP_TEXTDOMAIN));
        }
    }
        
    public function ajax_widget(){
       if(!isset($_POST['divisa_donacion']) || !isset($_POST['criptomoneda'])){
           die(__("No has seleccionado una divisa.", CP_TEXTDOMAIN));
       }
       if(!isset($_POST['cantidad']) || $_POST['cantidad']<0.01){
           die(__("Falta la cantidad que quieres donar.", CP_TEXTDOMAIN));
       }
       
       $CritoPay = new CriptoPay(get_option('CP_usuario'),  get_option('CP_APIKEY'));
       die($CritoPay->API('donacion',array("criptomoneda"=>$_POST['criptomoneda'],"cantidad"=>$_POST['cantidad'],"divisa_cantidad"=>$_POST['divisa_donacion']))); 
    }
    
    public function loadJC_admin(){
        if(isset($_GET['page'])){
            if ($_GET['page'] == "CriptoPay" || $_GET['page'] == "Donaciones" || $_GET['page'] == "Pagos") {

                //Estilos panel de control
                wp_register_style( 'cp_don_stylesheet', CP_DON_PLUGINBASENAME . '/css/style.css', false, '1.0.0' );
                wp_enqueue_style( 'cp_don_stylesheet' );

                // Register Main JS File
                wp_enqueue_script( 'cp_don_javascript', CP_DON_PLUGINBASENAME . '/js/master.js', array(), '1.0.0', true );
                wp_localize_script( 'cp_don_javascript', 'cp_don_ajaxload', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
            }
        }
    }
    
    public function loadJC_wp(){
        wp_register_style( 'cp_w_css', CP_DON_PLUGINBASENAME . '/css/widget.css', false, '1.0.0' );
        wp_register_script( 'cp_qr', CP_DON_PLUGINBASENAME . '/js/qrcode.min.js', false, '1.0.0');
    }
    
    public function loadJS_all(){
        //echo '<script type="text/javascript">var ajaxurl = '. admin_url('admin-ajax.php').';</script> ';
    }
}

if(class_exists('CP_DON_core')) {
	$CP_DON_core = new CP_DON_core;
}