	$this->load->library('excel');


	$this->excel->getActiveSheet()->SetCellValue("A1", "UK");
    $this->excel->getActiveSheet()->SetCellValue("A2", "USA");

    $this->excel->getActiveSheet()->addNamedRange( 
        new PHPExcel_NamedRange(
            'countries', 
            $this->excel->getActiveSheet(), 
            'A1:A2'
        ) 
    );

$this->excel->getActiveSheet()->SetCellValue("B1", "London");
    $this->excel->getActiveSheet()->SetCellValue("B2", "Birmingham");
    $this->excel->getActiveSheet()->SetCellValue("B3", "Leeds");
    $this->excel->getActiveSheet()->addNamedRange( 
        new PHPExcel_NamedRange(
            'UK', 
            $this->excel->getActiveSheet(), 
            'B1:B3'
        ) 
    );

$this->excel->getActiveSheet()->SetCellValue("C1", "Atlanta");
    $this->excel->getActiveSheet()->SetCellValue("C2", "New York");
    $this->excel->getActiveSheet()->SetCellValue("C3", "Los Angeles");
    $this->excel->getActiveSheet()->addNamedRange( 
        new PHPExcel_NamedRange(
            'USA', 
            $this->excel->getActiveSheet(), 
            'C1:C3'
        ) 
    );

$objValidation = $this->excel->getActiveSheet()->getActiveSheet()->getCell('A1')->getDataValidation();
    $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
    $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
    $objValidation->setAllowBlank(false);
    $objValidation->setShowInputMessage(true);
    $objValidation->setShowErrorMessage(true);
    $objValidation->setShowDropDown(true);
    $objValidation->setErrorTitle('Input error');
    $objValidation->setError('Value is not in list.');
    $objValidation->setPromptTitle('Pick from list');
    $objValidation->setPrompt('Please pick a value from the drop-down list.');
    $objValidation->setFormula1("=countries"); //note this!


    $objValidation = $this->excel->getActiveSheet()->getActiveSheet()->getCell('B1')->getDataValidation();
    $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
    $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
    $objValidation->setAllowBlank(false);
    $objValidation->setShowInputMessage(true);
    $objValidation->setShowErrorMessage(true);
    $objValidation->setShowDropDown(true);
    $objValidation->setErrorTitle('Input error');
    $objValidation->setError('Value is not in list.');
    $objValidation->setPromptTitle('Pick from list');
    $objValidation->setPrompt('Please pick a value from the drop-down list.');
    $objValidation->setFormula1('=INDIRECT($A$1)'); 
