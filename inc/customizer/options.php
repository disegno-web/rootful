<?php

/* Enqueue Admin Stylesheet */

function rootful_admin_styles() {
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/inc/admin/admin-styles.css' );
}

add_action( 'admin_enqueue_scripts', 'rootful_admin_styles' );

/* ------------------ */
/* theme options page */
/* ------------------ */

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

// Einstellungen registrieren (http://codex.wordpress.org/Function_Reference/register_setting)
function theme_options_init(){
	register_setting( 'rootful_options', 'rootful_theme_options', 'rootful_validate_options' );
}

// Seite in der Dashboard-Navigation erstellen
function theme_options_add_page() {
	add_theme_page('rootful', 'rootful', 'edit_theme_options', 'theme-optionen', 'rootful_theme_options_page' ); // Seitentitel, Titel in der Navi, Berechtigung zum Editieren (http://codex.wordpress.org/Roles_and_Capabilities) , Slug, Funktion 
}

// Optionen-Seite erstellen
function rootful_theme_options_page() {
global $select_options, $radio_options;
if ( ! isset( $_REQUEST['settings-updated'] ) )
	$_REQUEST['settings-updated'] = false; ?>

<div class="wrap"> 
<?php screen_icon(); ?><h2>Rootful</h2> 
	
<div class="tab">
	<button class="tablinks active" onclick="openToggle(event, 'schriften')">Schriften laden</button>
</div>
		
			<script>
			function openToggle( evt, toggleName ) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for ( i = 0; i < tabcontent.length; i++ ) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for ( i = 0; i < tablinks.length; i++ ) {
					tablinks[i].className = tablinks[i].className.replace(" active", "" );
				}

				document.getElementById(toggleName).style.display = "block";
				evt.currentTarget.className += " active";
			}
			</script>

				<div id="schriften" class="tabcontent" style="display: block">

					<h1>Schriften hochladen</h1>
					
					<h2 class="important">Achtung: Es kann immer nur eine Schriftfamilie auf einmal hochgeladen werden.</h2>
							
							<h2 class="tut">schritt eins.</h2>
							<h2 class="explanation">Möchtest du Google Fonts DSGVO-konform in deine Webseite einbinden, gehe bitte auf folgende Seite, wähle die entsprechende Schrift und die gewünschten Schriftschnitte aus und klicke dann auf den Downloadlink.</h2>

							<p class="my-personal-submit"><a id="submit" class="button button-primary" target="_blank" href="https://google-webfonts-helper.herokuapp.com/fonts">Zum Google Webfonts Helper</a></p>


							<form method="post" action="/wp-admin/options-general.php?page=font-processing" enctype="multipart/form-data">

								<h2 class="tut">schritt zwei.</h2>
								<h2 class="explanation">Wähle die Schriftdateien aus, die du hochladen möchtest.</h2>

								<div class="full-row">
										<label class="fontLabel" for="fontFileEOT">EOT-Datei</label>  
										<input type="file" name="fontFileEOT" id="fontFileToUpload"></div>

										<div class="full-row">
										<label  class="fontLabel" for="fontFileWOFF2">WOFF2-Datei</label>  
										<input type="file" name="fontFileWOFF2" id="fontFileToUpload" required></div>

										<div class="full-row">
										<label  class="fontLabel" for="fontFileWOFF">WOFF-Datei</label>  
										<input type="file" name="fontFileWOFF" id="fontFileToUpload" required></div>

										<div class="full-row">
										<label  class="fontLabel" for="fontFileTTF">TTF-Datei</label>  
										<input type="file" name="fontFileTTF" id="fontFileToUpload"></div>

										<div class="full-row">
										<label  class="fontLabel" for="fontFileSVG">SVG-Datei</label>  
										<input type="file" name="fontFileSVG" id="fontFileToUpload"></div>

										<h2 class="tut">schritt drei.</h2>
										<h2 class="explanation">Vergebe einen Schriftnamen (meist der vorgegebene Name), der auch im Stylesheet verwendet werden kann.</h2>

										<input type="text" name="fontName" id="fontName" placeholder="z.B. Open Sans" required>	

										<h2 class="tut">schritt vier.</h2>
										<h2 class="explanation">Gib den Schriftschnitt an, den du hochlädst (300, 400, 600, 700,..) </h2>
										<select id="fontName" name="fontWeight" required>
											<option value="100">100</option>
											<option value="200">200</option>
											<option value="300">300</option>
											<option value="400">Regular</option>
											<option value="500">500</option>
											<option value="600">600</option>
											<option value="700">700</option>
										</select>

										<p class="my-personal-submit">
											<input id="submit" class="button button-primary" type="submit" name="submit" value="Schriften hochladen" />
										</p>

									</form>  


						</div>
					</div>	
	
<?php }

// Strip HTML-Code:
// Hier kann definiert werden, ob HTML-Code in einem Eingabefeld 
// automatisch entfernt werden soll. Soll beispielsweise im 
// Copyright-Feld KEIN HTML-Code erlaubt werden, kommentiert die Zeile 
// unten wieder ein. http://codex.wordpress.org/Function_Reference/wp_filter_nohtml_kses
function rootful_validate_options( $input ) {
	// $input['copyright'] = wp_filter_nohtml_kses( $input['copyright'] );
	return $input;
}

?>