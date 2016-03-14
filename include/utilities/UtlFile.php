<?php

class UtlFile {

    private $allowedPaths = array(); // rutas permitidas para la descarga de archivos
    private $allowedExtensions = array(); // extensiones permitidas para la subida de archivos
    private $maxFileSize = 10000000;

    // Static initialization.
    public function setMaxSize($size) {
        $this->maxFileSize = $size;
    }

    public function setAllowedExtensions(array $allowedExtensions) {
        $this->allowedExtensions = $allowedExtensions;
    }

    public function setAllowedPaths(array $allowedPaths) {
        $this->allowedPaths = $allowedPaths;
    }

    public function download($filePath, $fileName, $fileNewName) {
        try {
            if (in_array(dirname($filePath . $fileName) . '/', $this->allowedPaths)) {
                header('Content-type: application/force-download');
                header("Content-Disposition: attachment; filename=$fileNewName");
                readfile($filePath . $fileName);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     *
     * @param array $FILE
     * @param string $type Tipo de upload: 'imagen', 'zip', 'audio', 'video' o null para todos los tipos.
     * @param string $path Upload path
     * @return <type>
     */
    public function uploadFile(array $FILE, $type, $path = '/temp') {
        switch ($type) {
            case 'imagen':
                $allowedExtrensions = array('jpg', 'jpeg', 'gif', 'bmp', 'png');
                break;
            case 'zip':
                $allowedExtrensions = array('zip');
                break;
            case 'audio':
                $allowedExtrensions = array('mp3');
                break;
            case 'video':
                $allowedExtrensions = array('flv', 'ogg', 'webm');
                break;
            case 'video-mp4':
                $allowedExtrensions = array('mp4');
                break;
            case 'pdf':
                $allowedExtrensions = array('pdf');
                break;
            default:
                $allowedExtrensions = array('jpg', 'jpeg', 'gif', 'bmp', 'png', 'zip', 'mp3', 'flv', 'mp4');
                break;
        }
        if (is_dir($path)) {
            $this->setAllowedExtensions($allowedExtrensions);
            return $this->upload($FILE, $path);
        } else {
            return false;
        }
    }

    public function uploadFileRandName(array $FILE, $path = "/temp/", $type = null) {

        $oldName = $FILE['name'];
        $fileExtension = self::getExtension($oldName);
        $newName = uniqid() . "." . $fileExtension;

        $this->setMaxSize(40000000);

        $result = $this->uploadFile($FILE, $type, $path);
        if ($result === true) {
            if (@rename($path . $oldName, $path . $newName)) {
                return array(
                    "name" => $newName,
                    "result" => true
                );
            } else {
                return array(
                    "code" => "File can't be moved",
                    "result" => true
                );
            }
        } else {
            return array(
                "code" => $result,
                "result" => false
            );
        }
    }

    public function upload($fileArray, $filePath, $filePrefix = '') {
        $result = "Unexpected error";
        try {
            $ext = strtolower(self::getExtension($fileArray['name']));
            if ($fileArray['tmp_name'] == '') {
                $result = "File not exits";
            } else if ($fileArray['size'] > $this->maxFileSize) {
                $result = "Max file allowed";
            } else if (!in_array($ext, $this->allowedExtensions)) {
                $result = "File extension not allowed";
            } else if ($fileArray['error'] == 0) {
                $filePath = $filePath . $filePrefix . $fileArray['name'];
                if (@move_uploaded_file($fileArray['tmp_name'], $filePath)) {
                    $result = true;
                }
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public static function sanitizeFilename($filename) {
        try {
            //$filename = ThefText::optimize($filename);
            $filename = ThefFwkText::noAccents($filename);
            $filename = preg_replace('/[^a-zA-Z0-9_. ]/', '', $filename);
            $filename = str_replace(' ', '-', $filename);
            $filename = strtolower($filename);
        } catch (Exception $ex) {
            throw $ex;
        }
        return $filename;
    }

    public static function uploadMultiple() {
        //TODO
    }

    public static function getExtension($fileName) {
        $extension = '';
        try {
            $extension = end(explode('.', $fileName));
        } catch (Exception $ex) {
            throw $ex;
        }
        return $extension;
    }

    public static function fileExists($path) {
        return file_exists($path) && !is_dir($path);
    }

}
