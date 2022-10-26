<div class="enigma_callout_area" id="callout">
	<div class="container">
		<div class="row">
			<?php 
			$fc_title = get_theme_mod( 'fc_title', __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. ','enigma') );
			if ( ! empty ( $fc_title ) ) { ?>
				<div class="col-md-9">
				<p>
					<?php 
					$fc_icon = get_theme_mod( 'fc_icon', __('fa fa-thumbs-up','enigma') );
					if ( ! empty ( $fc_icon ) ) { ?>
					<i class="<?php echo esc_attr( $fc_icon ) ?>"></i>
					<?php } echo esc_html( $fc_title);?>
				</p>
				</div>
			<?php } 
			$fc_btn_txt = get_theme_mod( 'fc_btn_txt', __('More Features','enigma') );
			if ( ! empty ( $fc_btn_txt ) ) { ?>
				<div class="col-md-3">
					<a href="<?php echo esc_url( get_theme_mod( 'fc_btn_link') ); ?>" class="enigma_callout_btn"><?php echo esc_html( $fc_btn_txt  ); ?></a>
				</div>
			<?php } ?>
		</div>		
	</div>
	<div class="enigma_callout_shadow"></div>
</div>