<div class="cwp_top_wrapper">
    
	<header id="cwp_top_header" class='clearfix'>
		<h1 class="top_logo">
                    <?php _e("Administración de Bitcoin & Altcoin", CP_DONACIONES_TEXTDOMAIN); ?>
		</h1>
		<span class="slogan"><?php _e("por", CP_DONACIONES_TEXTDOMAIN); ?> <a href="https://cripto-pay.com">Cripto-Pay.com</a></span>

		<div class="cwp_top_actions">
			<a href="https://twitter.com/criptopay" class="tweet-about-it"><span></span> <?php _e("Avisa a tu publico", CP_DONACIONES_TEXTDOMAIN); ?></a>
			<a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/cripto-pay#postform" class="leave-a-review"><span></span> <?php _e("Déjanos un comentario", CP_DONACIONES_TEXTDOMAIN); ?></a>		
		</div><!-- end .cwp_top_actions -->
	</header><!-- end .cwp_top_header -->

	<section class="cwp_top_container clearfix">

		<form action="" method="post" id="cp_data_form" class="clearfix">
			<input id="cwp_top_currenturl" type="hidden" value="">

			<fieldset class="option">
				<div class="left">
					<label for="CP_usuario"> <?php _e("Usuario", CP_DONACIONES_TEXTDOMAIN); ?> </label>
					<span class='description'> <?php _e("Email con el que te registraste", CP_DONACIONES_TEXTDOMAIN); ?> </span>
				</div><!-- end .left -->

				<div class='right'>
                                    <input type='email' placeholder='<?php _e("Email", CP_DONACIONES_TEXTDOMAIN); ?>' value='<?php echo  get_option('CP_usuario'); ?>' name='CP_usuario' id=''>
				</div><!-- end .right -->
			</fieldset><!-- end .option -->

			<fieldset class="option">
				<div class="left">
					<label for="CP_apikey"> <?php _e("API Key", CP_DONACIONES_TEXTDOMAIN); ?> </label>
                                        <span class='description'> <a href="https://cripto-pay.com/panel/api" target="_blank"><?php _e("Pulsa aquí para generar tu API key", CP_DONACIONES_TEXTDOMAIN); ?></a></span>
				</div><!-- end .left -->

				<div class='right'>
                                    <input type='text' placeholder='<?php _e("API KEY", CP_DONACIONES_TEXTDOMAIN); ?>' value='<?php echo  get_option('CP_apikey'); ?>' name='CP_apikey' id=''>
				</div><!-- end .right -->
			</fieldset><!-- end .option -->
                        
			<div class="cwp_top_footer">
				<a class="actualizar-datos" href="#"><span></span><?php _e("Guardar", CP_DONACIONES_TEXTDOMAIN); ?></a>
			</div><!-- end .cwp_top_footer -->
		</form><!-- end #cwp_top_form -->
	</section><!-- end .cwp_top_container -->
</div><!-- end .cwp_top_wrapper -->