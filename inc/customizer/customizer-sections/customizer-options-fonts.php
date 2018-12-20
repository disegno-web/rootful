<?php

if ( class_exists( 'WP_Customize_Control' ) ) {
	
/**
	 * Google Font Select Custom Control
	 *
	 */
	class Rootful_Google_Font_Select extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'dropdown_select2';
		/**
		 * The type of Select2 Dropwdown to display. Can be either a single select dropdown or a multi-select dropdown. Either false for true. Default = false
		 */
		private $multiselect = false;
		/**
		 * The Placeholder value to display. Select2 requires a Placeholder value to be set when using the clearall option. Default = 'Please select...'
		 */
		private $placeholder = 'Please select...';
		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Check if this is a multi-select field
			if ( isset( $this->input_attrs['multiselect'] ) && $this->input_attrs['multiselect'] ) {
				$this->multiselect = true;
			}
			// Check if a placeholder string has been specified
			if ( isset( $this->input_attrs['placeholder'] ) && $this->input_attrs['placeholder'] ) {
				$this->placeholder = $this->input_attrs['placeholder'];
			}
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'rootful-select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', array( 'jquery' ), '4.0.6', true );
			wp_enqueue_script( 'rootful-custom-controls-js', trailingslashit( get_template_directory_uri() ) . 'js/customizer.js', array( 'rootful-select2-js' ), '1.0', true );
			wp_enqueue_style( 'rootful-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.1', 'all' );
			wp_enqueue_style( 'rootful-select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', array(), '4.0.6', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$defaultValue = $this->value();
			if ( $this->multiselect ) {
				$defaultValue = explode( ',', $this->value() );
			}
		?>
			<div class="dropdown_select2_control">
				<?php if( !empty( $this->label ) ) { ?>
					<label for="<?php echo esc_attr( $this->id ); ?>" class="customize-control-title">
						<?php echo esc_html( $this->label ); ?>
					</label>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-dropdown-select2" value="<?php echo esc_attr( $this->value() ); ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> />
				<select name="select2-list-<?php echo ( $this->multiselect ? 'multi[]' : 'single' ); ?>" class="customize-control-select2" data-placeholder="<?php echo $this->placeholder; ?>" <?php echo ( $this->multiselect ? 'multiple="multiple" ' : '' ); ?>>
					<?php
						if ( !$this->multiselect ) {
							// When using Select2 for single selection, the Placeholder needs an empty <option> at the top of the list for it to work (multi-selects dont need this)
							echo '<option></option>';
						}
						
						$font_list = array();
	
						if ( $handle = opendir(get_template_directory() . '/assets/fonts')) {

							while ( false !== ( $entry = readdir($handle))) {
								if ( $entry != "." && $entry != ".." ) {
									$search = " ";
									$replace = "-";
									$shortentry = str_replace($search, $replace, $entry);

									$entry_choice = $shortentry." => ".$entry;
									$symbol = "'";

									$entry_choice = $symbol . str_replace(' ', $symbol, $entry_choice ) . $symbol;
									
									echo '<option value="' . $shortentry . '" ' . ( in_array( esc_attr( $shortentry ), $defaultValue ) ? 'selected="selected"' : '' ) . '>' . esc_attr( $entry ) . '</option>';
								}
							}

							closedir( $handle );

						}

	 				?>
				</select>
			</div>
		<?php
		}
	}

}

add_action( 'customize_register', 'font_customizer_settings' );

function font_customizer_settings( $wp_customize ) {
	
	$wp_customize -> add_panel( 'typografie', array(
		'title'	=>	'Typografie',
		'description'	=>	'Typografische Einstellungen zum Aussehen der Webseite.',
		'priority'	=>	190,
	) );
	
	$wp_customize -> add_section( 'schriftarten', array(
		'title'	=>	'Schriftarten',
		'panel'	=>	'typografie',
	) );
		
	$wp_customize -> add_setting( 'google_font_dropdown', array(
		'default'	=>	'',
		'transport'	=>	'refresh',
		'sanitize_callback'	=>	'rootful_text_sanitization',
	));
	
	$wp_customize -> add_control( new Rootful_Google_Font_Select( $wp_customize, 'google_font_dropdown', array(
		'label'	=>	'Schriftauswahl',
		'description'	=>	'Welche Schriften sollen zur Benutzung auf dieser Webseite verfügbar sein?',
		'section'	=>	'schriftarten',
		'input_attrs' => array(
			'placeholder' => 'Schriften..',
			'multiselect' => true,
		),
	)));

	
	$wp_customize -> add_setting( 'schrift_fliesstext', array(
		'default'	=>	'',
		'transport'	=>	'refresh',
		'sanitize_callback'	=>	'rootful_text_sanitization',
	));
	
	$wp_customize -> add_control( new Rootful_Google_Font_Select( $wp_customize, 'schrift_fliesstext', array(
		'label'	=>	'Fließtext',
		'section'	=>	'schriftarten',
		'input_attrs' => array(
			'placeholder' => 'Schriften..',
			'multiselect' => true,
		),
	)));
	
	$wp_customize -> add_setting( 'schrift_menu', array(
		'default'	=>	'',
		'transport'	=>	'refresh',
		'sanitize_callback'	=>	'rootful_text_sanitization',
	));
	
	$wp_customize -> add_control( new Rootful_Google_Font_Select( $wp_customize, 'schrift_menu', array(
		'label'	=>	'Menü',
		'section'	=>	'schriftarten',
		'input_attrs' => array(
			'placeholder' => 'Schriften..',
			'multiselect' => true,
		),
	)));
	
	$wp_customize -> add_setting( 'schrift_ueberschriften', array(
		'default'	=>	'',
		'transport'	=>	'refresh',
		'sanitize_callback'	=>	'rootful_text_sanitization',
	));
	
	$wp_customize -> add_control( new Rootful_Google_Font_Select( $wp_customize, 'schrift_ueberschriften', array(
		'label'	=>	'Überschriften',
		'section'	=>	'schriftarten',
		'input_attrs' => array(
			'placeholder' => 'Schriften..',
			'multiselect' => true,
		),
	)));
	
	
	/* Schriftgröße */

	$wp_customize -> add_section( 'schriftgroesse', array(
		'title'	=>	'Schriftgröße',
		'panel'	=>	'typografie',
	) );
	
	$wp_customize -> add_setting( 'groesse_fliesstext', array(
		'default'	=>	16,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'groesse_fliesstext', array(
		'label'	=>	'Schriftgröße Fließtext (px)',
		'section'	=>	'schriftgroesse',
		'input_attrs'	=>	array(
			'min'	=>	11,
			'max'	=>	40,
			'step'	=>	1,
		),
	)));
	
	$wp_customize -> add_setting( 'groesse_menu', array(
		'default'	=>	16,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'groesse_menu', array(
		'label'	=>	'Schriftgröße Menü (px)',
		'section'	=>	'schriftgroesse',
		'input_attrs'	=>	array(
			'min'	=>	11,
			'max'	=>	40,
			'step'	=>	1,
		),
	)));
	
	$wp_customize -> add_setting( 'groesse_footer', array(
		'default'	=>	14,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'groesse_footer', array(
		'label'	=>	'Schriftgröße Footer (px)',
		'section'	=>	'schriftgroesse',
		'input_attrs'	=>	array(
			'min'	=>	11,
			'max'	=>	40,
			'step'	=>	1,
		),
	)));
	
	$wp_customize -> add_setting( 'groesse_h1', array(
		'default'	=>	40,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'groesse_h1', array(
		'label'	=>	'Schriftgröße H1 (px)',
		'section'	=>	'schriftgroesse',
		'input_attrs'	=>	array(
			'min'	=>	20,
			'max'	=>	70,
			'step'	=>	1,
		),
	)));
	
	$wp_customize -> add_setting( 'groesse_h2', array(
		'default'	=>	37,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'groesse_h2', array(
		'label'	=>	'Schriftgröße H2 (px)',
		'section'	=>	'schriftgroesse',
		'input_attrs'	=>	array(
			'min'	=>	20,
			'max'	=>	70,
			'step'	=>	1,
		),
	)));
	
	$wp_customize -> add_setting( 'groesse_h3', array(
		'default'	=>	33,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'groesse_h3', array(
		'label'	=>	'Schriftgröße H3 (px)',
		'section'	=>	'schriftgroesse',
		'input_attrs'	=>	array(
			'min'	=>	18,
			'max'	=>	65,
			'step'	=>	1,
		),
	)));
	
	$wp_customize -> add_setting( 'groesse_h4', array(
		'default'	=>	30,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'groesse_h4', array(
		'label'	=>	'Schriftgröße H4 (px)',
		'section'	=>	'schriftgroesse',
		'input_attrs'	=>	array(
			'min'	=>	18,
			'max'	=>	60,
			'step'	=>	1,
		),
	)));
	
	$wp_customize -> add_setting( 'groesse_h5', array(
		'default'	=>	28,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'groesse_h5', array(
		'label'	=>	'Schriftgröße H5 (px)',
		'section'	=>	'schriftgroesse',
		'input_attrs'	=>	array(
			'min'	=>	16,
			'max'	=>	55,
			'step'	=>	1,
		),
	)));
	
	$wp_customize -> add_setting( 'groesse_h6', array(
		'default'	=>	25,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'groesse_h6', array(
		'label'	=>	'Schriftgröße H6 (px)',
		'section'	=>	'schriftgroesse',
		'input_attrs'	=>	array(
			'min'	=>	16,
			'max'	=>	50,
			'step'	=>	1,
		),
	)));
	
	
	
	$wp_customize -> add_section( 'schriftstil', array(
		'title'	=>	'Schriftstil',
		'panel'	=>	'typografie',
	) );
	
	/* Schriftstil */
	
	$wp_customize -> add_setting( 'text_transform_fliesstext', array(
		'default'	=>	'none',
		'transport'	=>	'refresh',
		'sanitize_callback'	=>	'rootful_text_sanitization',
	)
	);
	
	// Add layout control
	$wp_customize -> add_control( new Rootful_Image_Radio_Button_Custom_Control( $wp_customize, 'text_transform_fliesstext', array(
		'label'	=>	'Fließtext',
		'section'	=>	'schriftstil',
		'choices'	=>	array(
			'none'	=>	array(
				'image'	=>	trailingslashit( get_template_directory_uri() ). '/inc/customizer/assets/img/rootful-text-transform_none.png',
				'name'	=>	'Klein- und Großschreibung'
			),
			'uppercase'	=>	array(
				'image'	=>	trailingslashit( get_template_directory_uri() ). '/inc/customizer/assets/img/rootful-text-transform_uppercase.png',
				'name'	=>	'Großschreibung'
			),
			'lowercase'	=>	array(
				'image'	=>	trailingslashit( get_template_directory_uri() ). '/inc/customizer/assets/img/rootful-text-transform_lowercase.png',
				'name'	=>	'Kleinschreibung'
			),
		)
	)));	
	
}