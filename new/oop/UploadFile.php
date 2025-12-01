<?php

namespace oop;

class UploadFile
{
    private $allowedTypes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'mp4' => 'video/mp4',
        'webm' => 'video/webm',
        'mp3' => 'audio/mpeg',
        'pdf' => 'application/pdf'
    ];
    private $allowedMimes = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif',
        'image/webp',
        'video/mp4',
        'video/webm',
        'audio/mpeg',
        'application/pdf'
    ];

    private $targetDir;
    private $maxSize;
    private $file;
    private $ext;
    private $error_list;
    private $fileOrg;

    private $Suffix;

    public function __construct(
        $file,
        $Suffix = 'media_',
        $path = "/announcement/uploads/"
    )
    {
        $this->error_list = [];
        $this->file = $file['tmp_name'];
        $this->fileOrg = $file;

        $this->ext = strtolower(pathinfo($this->fileOrg['name'], PATHINFO_EXTENSION));
        $this->targetDir = $_SERVER['DOCUMENT_ROOT'] . $path;
        $this->maxSize = 10 * 1024 * 1024;
        $this->Suffix = $Suffix;
    }

    public function upload(): array
    {
        $file = $this->fileOrg;
        if ($this->check_file_type()) {
            $this->error_list["fileType"] = "File type is not allowed " . $file['name'];
        }
        if ($this->check_file_size()) {
            $this->error_list["fileSize"] = "File size is not allowed " . $file['name'] . "=" . $file['size'] / 1024 / 1024 . "MB while allowed is: " . $this->maxSize / 1024 / 1024 . "MB";
        }
        if ($this->check_file_mime()) {
            $this->error_list["fileMiMe"] = "File mime is not allowed " . $file['name'];
        }
        if ($this->error_list) {
            $report = [
                'ok' => 0,
                'error' => $this->error_list,
                'filename' => ''
            ];
            return $report;
        }
        $report = array(
            'ok' => 1,
            'error' => [],
            'filename' => $this->move()
        );
        return $report;
    }

    private function check_file_type(): bool
    {
        return in_array($this->ext, $this->allowedTypes);
    }

    private function check_file_size(): bool
    {
        $fileSize = filesize($this->file);
        return $fileSize > $this->maxSize;
    }

    private function check_file_mime(): bool
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $this->file);;
        return !in_array($mime_type, $this->allowedMimes);
    }

    private function move()
    {
        $target_filename = uniqid($this->Suffix) . '.' . $this->ext;
        $targetFilePath = $this->targetDir . $target_filename;
        if (move_uploaded_file($this->file, $targetFilePath)) {
            return $target_filename;
        } else {
            return false;
        }
    }

}