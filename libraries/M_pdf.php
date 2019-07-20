<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


   include_once APPPATH.'/third_party/mpdf60/mpdf.php';

     /**
      * Class : M_pdf(PDFController)
      * PDF Class to generate pdf
      */
      class M_pdf 
      {
      	public $param;

      	public $pdf;

      	/**
      	 *This is default constructer of class
      	 *@param string $param : This is 
      	 */

      	function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
      	{
      		$this->param = $param;

      		$this->pdf = new mPDF($this->param);
      		
      	}
      } 