<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

$fontname = $_POST['fontName'];
$fontweight = $_POST['fontWeight'];
$correct_fontName = str_replace(' ', '-', $fontname);

if ( !file_exists( get_template_directory() . '/assets/fonts/'.$correct_fontName.'-'.$fontweight ) ) {
	/* Create new directory according to the fontname */
	mkdir( get_template_directory() . '/assets/fonts/'.$correct_fontName.'-'.$fontweight, 0700 );
}

$target_dir = get_template_directory() . '/assets/fonts/'.$correct_fontName.'-'.$fontweight.'/';

foreach ( $_FILES as $FILE ) {
		
	$target_file = $target_dir . basename($FILE['name']);
	$uploadOk = 1;
	$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	// Check if file exists
	if ( file_exists( $target_file ) ) {
		echo "Diese Schrift ist bereits hochgeladen.";
		$uploadOk = 0;
	}
	// Check if file is too large
	if ( $FILE['size'] > 5000000 ) {
		echo "Die gewünschte Datei ist zu groß.";
		$uploadOk = 0;
	}
	// Check if filetype is according to the font format
	if ( $fileType != "eot" && $fileType != "ttf" && $fileType != "woff" && $fileType != "svg" && $fileType != "woff2" ) {
		echo "Der Dateityp ist ungültig";
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 
	if ( $uploadOk == 0 ) {
		echo "Tut uns Leid, aber die Datei kann leider nicht hochgeladen werden.";
	} else {
		if ( move_uploaded_file($FILE["tmp_name"], $target_file ) ) {
			echo "Die Datei ".basename( $FILE["name"]). " wurde erfolgreich hochgeladen.";
		} else {
			echo "Diese Datei kann leider nicht hochgeladen werden.";
		}
	}
}
