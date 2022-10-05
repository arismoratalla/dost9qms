<?php

namespace common\components;
use kartik\mpdf\Pdf;
use Yii;
use yii\helpers\ReplaceArrayValue;

interface PDFEnum{
    const PDF_Browser="I";
    const PDF_Download="D";
    const PDF_File="F";
    const PDF_String="S";
}
/**
 * This PDF Class will generate PDF from YII2 Views
 * and can choose to where will the PDF be send[Browser, Download, File, String
 *
 * @author OneLab
 */
class MyPDF implements PDFEnum{
    
    static $pdf;
/**
     * 
     * @param string $content The generated Views that to be converted to PDF 
     */
    public function __construct($opt=null) {
       
    }
    /**
     * 
     * @param type $dest
     */
    public function renderPDF($dest=PDFEnum::PDF_Browser){
       
    } 
}
