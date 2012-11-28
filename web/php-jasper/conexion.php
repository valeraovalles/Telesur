<?php
	
class JasperReport{


	public function generar($reporte,$parametros,$formato){

		require_once("http://localhost:8080/PHPJRU/java/Java.inc");

		try {

		    $jasperxml = new java("net.sf.jasperreports.engine.xml.JRXmlLoader");

		    $jasperDesign = $jasperxml->load(realpath("usuarios.jrxml"));
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
		$conn = $driverManager->getConnection("jdbc:postgresql://localhost/Telesur","postgres", "postgres");
		$jasperPrint = $fillManager->fillReport($report, $params, $conn);

		$exporter = new java("net.sf.jasperreports.engine.JRExporter");


		switch ($formato) {
		    case 'xls':
			$outputPath = realpath(".") . "\\" . "output.xls";

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
			header("Content-Disposition: attachment; filename=output.xls");
			break;
		    case 'csv':
			$outputPath = realpath(".") . "\\" . "output.csv";

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
			header("Content-Disposition: attachment; filename=output.csv");
			break;
		    case 'docx':
			$outputPath = realpath(".") . "\\" . "output.docx";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRDocxExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
		
			    
			} catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=output.docx");
			break;
		    case 'html':
			$outputPath = realpath(".") . "\\" . "output.html";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.JRHtmlExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
		
			    
			} catch (JavaException $ex) {
			    echo $ex;
			}
			break;
		    case 'pdf':
			$outputPath = realpath(".") . "\\" . "output.pdf";

			$exporter = new java("net.sf.jasperreports.engine.export.JRPdfExporter");
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
		
			header("Content-type: application/pdf");
			header("Content-Disposition: attachment; filename=output.pdf");
			break;
		    case 'ods':
			$outputPath = realpath(".") . "\\" . "output.ods";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.oasis.JROdsExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			 } catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
			header("Content-Disposition: attachment; filename=output.ods");
			break;
		    case 'odt':
			$outputPath = realpath(".") . "\\" . "output.odt";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.oasis.JROdtExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			 } catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: application/vnd.oasis.opendocument.text");
			header("Content-Disposition: attachment; filename=output.odt");
			break;
		    case 'txt':
			$outputPath = realpath(".") . "\\" . "output.txt";

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
			$outputPath = realpath(".") . "\\" . "output.rtf";

			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.JRRtfExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			} catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: application/rtf");
			header("Content-Disposition: attachment; filename=output.rtf");
			break;
		    case 'pptx':
			 $outputPath = realpath(".") . "\\" . "output.pptx";
			try {
			    $exporter = new java("net.sf.jasperreports.engine.export.ooxml.JRPptxExporter");
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
			    $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);
			} catch (JavaException $ex) {
			    echo $ex;
			}

			header("Content-type: aapplication/vnd.ms-powerpoint");
			header("Content-Disposition: attachment; filename=output.pptx");
		      break;
		}
		$exporter->exportReport();
		
		readfile($outputPath);
		unlink($outputPath);
	}
}

$a=new JasperReport;
$a->generar("general",array('titulo'=>'holax'),'pdf');
?>
