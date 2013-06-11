<?php
	
class JasperReport{


	public function generar($reporte,$parametros,$formato,$nombre){

            //print_r($parametros);
            //exit(0);
       		require_once("http://localhost:8080/PHPJRU/java/Java.inc");

		try {

		    $jasperxml = new java("net.sf.jasperreports.engine.xml.JRXmlLoader");

		    $jasperDesign = $jasperxml->load(realpath($reporte));
		    $query = new java("net.sf.jasperreports.engine.design.JRDesignQuery");
		    //$query->setText("select * from sf_guard_user_profile");
		    //$jasperDesign->setQuery($query);
		    $compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");
		    $report = $compileManager->compileReport($jasperDesign);

		} catch (JavaException $ex) {
		    echo $ex;
		}

		$fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");

		$params = new Java("java.util.HashMap");

		foreach($parametros as $key=>$value){
			$params->put($key, $value);
		}

		$params->put(array('titulo'), array('hola'));

		$class = new JavaClass("java.lang.Class");
		$class->forName("org.postgresql.Driver");
		$driverManager = new JavaClass("java.sql.DriverManager");

		//db username and password
		$conn = $driverManager->getConnection("jdbc:postgresql://localhost/telesur","postgres", "postgres");
		$jasperPrint = $fillManager->fillReport($report, $params, $conn);

		$exporter = new java("net.sf.jasperreports.engine.JRExporter");


		switch ($formato) {
		    case 'xls':
			$outputPath = realpath(".") . "\\" .$nombre.".xls";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.JRXlsExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_ONE_PAGE_PER_SHEET, java("java.lang.Boolean")->TRUE);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_WHITE_PAGE_BACKGROUND, java("java.lang.Boolean")->FALSE);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRXlsExporterParameter")->IS_REMOVE_EMPTY_SPACE_BETWEEN_ROWS, java("java.lang.Boolean")->TRUE);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			} catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=".$nombre.".xls");
			break;
		    case 'csv':
			$outputPath = realpath(".") . "\\" .$nombre."outut.csv";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.JRCsvExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRCsvExporterParameter")->FIELD_DELIMITER, ",");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRCsvExporterParameter")->RECORD_DELIMITER, "\n");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRCsvExporterParameter")->CHARACTER_ENCODING, "UTF-8");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			 } catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: application/csv");
			header("Content-Disposition: attachment; filename=".$nombre.".csv");
			break;
		    case 'docx':
			$outputPath = realpath(".") . "\\" .$nombre.".docx";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRDocxExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
		
			    
			} catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=".$nombre.".docx");
			break;
		    case 'html':
			$outputPath = realpath(".") . "\\" .$nombre.".html";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.JRHtmlExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
		
			    
			} catch (JavaException $ex) {
			    echo $ex;
			}
			break;
		    case 'pdf':
			$outputPath = realpath(".") . "\\" .$nombre.".pdf";

			$exporter = new java("net.sf.jasperreports.engine.export.JRPdfExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
		
			header("Content-type: application/pdf");
			header("Content-Disposition: attachment; filename=".$nombre.".pdf");
			break;
		    case 'ods':
			$outputPath = realpath(".") . "\\" .$nombre.".ods";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.oasis.JROdsExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			 } catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
			header("Content-Disposition: attachment; filename=".$nombre.".ods");
			break;
		    case 'odt':
			$outputPath = realpath(".") . "\\" .$nombre.".odt";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.oasis.JROdtExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			 } catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: application/vnd.oasis.opendocument.text");
			header("Content-Disposition: attachment; filename=".$nombre.".odt");
			break;
		    case 'txt':
			$outputPath = realpath(".") . "\\" .$nombre.".txt";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.JRTextExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRTextExporterParameter")->PAGE_WIDTH, 120);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.export.JRTextExporterParameter")->PAGE_HEIGHT, 60);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			} catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: text/plain");
			break;
		    case 'rtf':
			$outputPath = realpath(".") . "\\" .$nombre.".rtf";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.JRRtfExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			} catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: application/rtf");
			header("Content-Disposition: attachment; filename=".$nombre.".rtf");
			break;
		    case 'pptx':
			 $outputPath = realpath(".") . "\\" .$nombre.".pptx";
			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRPptxExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			} catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: aapplication/vnd.ms-powerpoint");
			header("Content-Disposition: attachment; filename=".$nombre.".pptx");
		      break;
		}
		$exporter->exportReport();
		
		readfile($outputPath);
		unlink($outputPath);
	}
}

//$a=new JasperReport;
//$a->generar("general",array('titulo'=>'holax','titulo2'=>'jaja'),'pdf');
?>
