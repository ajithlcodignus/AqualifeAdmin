<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename,$landscape="",$stream=TRUE)
{
    require_once("dompdf/dompdf_config.inc.php");
    $filename = $filename.".pdf";
    $dompdf = new DOMPDF();
//    $html = iconv('UTF-8','Windows-1250',$html);
    $dompdf->load_html($html);
    if($landscape=='true')
    {
        $dompdf->set_paper("a4", "landscape" );
    }
    $dompdf->render();
    if ($stream) 
    {
//        $dompdf->stream($filename);
        $dompdf->stream($filename,array("Attachment" => false));
    } 
    else
    {
        return $dompdf->output();
    }
}


function pdf_create_print($html, $filename,$landscape="",$stream=TRUE)
{
        require_once("dompdf/dompdf_config.inc.php");
    $filename = $filename.".pdf";
    $dompdf = new DOMPDF();

    $dompdf->load_html($html);
    if($landscape=='true')
    {
        $dompdf->set_paper("a4", "landscape" );
    }
    $dompdf->render();
    $output = $dompdf->output();
    file_put_contents('assets/print/print.pdf', $output);
}

function pdf_zip($html, $filename,$landscape="")
{
    require_once("dompdf/dompdf_config.inc.php");
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    if($landscape=='true')
    {
        $dompdf->set_paper("a4", "landscape" );
    }
    $dompdf->render();
    file_put_contents('assets/daily_pdfs/'.$filename, $dompdf->output()); 
    chmod('assets/daily_pdfs/'.$filename, 0777);
}

function pdf_email($html, $filename,$landscape="")
{
    require_once("dompdf/dompdf_config.inc.php");
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    if($landscape=='true')
    {
        $dompdf->set_paper("a4", "landscape" );
    }
    $dompdf->render();
    if (!is_file('assets/email_pdfs/'.$filename)) 
    {
        file_put_contents('assets/email_pdfs/'.$filename, $dompdf->output()); 
    }
    chmod('assets/email_pdfs/'.$filename, 0777);
}

?>
