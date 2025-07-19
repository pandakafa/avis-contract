<?php

include '../inc/_connect.php';
include '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$id            = $_GET['id'];
$invoiceResult = str_pad( $id, 5, "0", STR_PAD_LEFT );
$pdfName       = $invoiceResult . '-proforma';
$link          = $root . '/pdf/generate-proforma.php?id=' . $id;
$options       = new Options();
$options->set( 'isRemoteEnabled', true );
$options->setDpi( 100 );
$options->setIsHtml5ParserEnabled( true );
$options->setIsJavascriptEnabled( true );
$options->setIsPhpEnabled( true );
$options->setIsFontSubsettingEnabled( true );

$dompdf = new Dompdf( $options );

$dompdf->setPaper( 'A3' );

$dompdf->loadHtml( file_get_contents( $link ), 'UTF-8' );
$dompdf->set_option( 'isFontSubsettingEnabled', true );
$dompdf->set_option( 'enable_css_float', true );

$dompdf->render();

$dompdf->stream( $pdfName );

file_put_contents( '../uploads/pdf/' . $pdfName . '.pdf', $dompdf->output() );