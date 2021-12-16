<?php

/**
 *
 * @package Main SIRED
 * @since 1.0
 */
declare(strict_types=1);

namespace models;

class ManagerFile
{
	const DIRECTORY_UPLOAD = DIRECTORY_STORAGE;

	private function getCurrentMonthName() : string
	{
		$months = array("01" => "enero", "02" => "febrero", "03" => "marzo", "04" => "abril", "05" => "mayo", "06" => "junio", "07" => "julio", "08" => "agosto", "09" => "setiembre", "10" => "octubre", "11" => "noviembre", "12" => "diciembre");
		$currentMonthNumber = date("m");
		$currentMonthName = "";
		foreach ($months as $key => $value) {
			if ( $currentMonthNumber == $key) 
				$currentNameMonth = $value;			
		}
		return $currentNameMonth;
	}

	private function imageResize($imageResourceId, $width, $height) 
	{
		$targetWidth = 260;
		$targetHeight = 260;
		$targetLayer = imagecreatetruecolor($targetWidth, $targetHeight);
		imagecopyresampled($targetLayer, $imageResourceId,0,0,0,0, $targetWidth, $targetHeight, $width, $height);
		return $targetLayer;
	}

	public function uploadProductFile($fileTmpPath, $fileName, $fileSize, $fileType, $rolName) : string
	{

		$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
		$fileName = pathinfo($fileName, PATHINFO_FILENAME);

		$fileExtensionsAllowed = array('pdf', 'jpg', 'jpeg', 'png', 'xls', 'xlsx');
		if (!in_array($fileExtension, $fileExtensionsAllowed)) {
			header("location: index.php?error=1");
			exit;
		}

		// var $rootDirectory is root directory domain, if use subdirectory change is value ej. $rootDirectory = $_SERVER['DOCUMENT_ROOT'] .'/sired';
		//$rootDirectory = $_SERVER['DOCUMENT_ROOT'] .'/sired';
		$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
		$dirNameYearReport = date("Y");;
		$dirNameMonthReport = $this->getCurrentMonthName();
		$dirNameRolReport = $rolName;

		$uploadYearDirectory = $rootDirectory . self::DIRECTORY_UPLOAD . "/" . $dirNameYearReport;
		if ( !file_exists($uploadYearDirectory . '/') ) 
			mkdir($uploadYearDirectory, 0777);

		$uploadRolDirectory = $rootDirectory . self::DIRECTORY_UPLOAD . "/" . $dirNameYearReport . "/" . $dirNameRolReport;
		if ( !file_exists($uploadRolDirectory . '/') ) 
			mkdir($uploadRolDirectory, 0777);		

		$uploadMonthDirectory = $rootDirectory . self::DIRECTORY_UPLOAD . "/" . $dirNameYearReport . "/" . $dirNameRolReport . "/" . $dirNameMonthReport . "/";
		if ( !file_exists($uploadMonthDirectory . '/') ) 
			mkdir($uploadMonthDirectory, 0777);

		$location_upload_filename = $uploadMonthDirectory . $fileName;

        $sourceProperties = getimagesize($fileTmpPath);
        $folderPath = $location_upload_filename;
        
		if ( $sourceProperties != FALSE ) {
			$imageType = $sourceProperties[2];

			switch ($imageType) {

				case IMAGETYPE_PNG:
					$imageResourceId = imagecreatefrompng($fileTmpPath); 
					$targetLayer = $this->imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
					imagepng($targetLayer, $location_upload_filename . "_thumbnail.". $fileExtension);
					break;

				case IMAGETYPE_GIF:
					$imageResourceId = imagecreatefromgif($fileTmpPath); 
					$targetLayer = $this->imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
					imagegif($targetLayer, $location_upload_filename . "_thumbnail.". $fileExtension);
					break;

				case IMG_JPG:
					$imageResourceId = imagecreatefromjpeg($fileTmpPath); 
					$targetLayer = $this->imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
					imagejpeg($targetLayer, $location_upload_filename . "_thumbnail.". $fileExtension);
					break;

				case IMAGETYPE_JPEG:
					$imageResourceId = imagecreatefromjpeg($fileTmpPath); 
					$targetLayer = $this->imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
					imagejpeg($targetLayer, $location_upload_filename . "_thumbnail.". $fileExtension);
					break;

				default:
					echo "Invalid Image type.";
					exit;
					break;
			}
		}

        move_uploaded_file($fileTmpPath, $location_upload_filename . ".". $fileExtension);
        echo "Image Upload Successfully.";

		$location_filename = $dirNameYearReport . "/" . $dirNameRolReport . "/" . $dirNameMonthReport . '/' . $fileName . '.'. $fileExtension;	
		return 	$location_filename;
	}

}
