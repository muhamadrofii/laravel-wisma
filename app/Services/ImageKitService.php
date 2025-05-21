<?php

namespace App\Services;

use ImageKit\ImageKit;

class ImageKitService
{
    protected $imageKit;

    public function __construct()
    {
        $this->imageKit = new ImageKit(
            config('services.imagekit.public_key'),
            config('services.imagekit.private_key'),
            config('services.imagekit.url_endpoint')
        );
    }

    public function upload($file, $fileName, $folder = null)
    {
            // Langsung gunakan $file sebagai path string
            $uploadFile = fopen($file, 'r');

            // return $this->imageKit->upload([
            //     'file' => $uploadFile,
            //     'fileName' => $fileName,
            // ]);

            $data = [
                'file' => $uploadFile,
                'fileName' => $fileName,
            ];
        
            if ($folder) {
                $data['folder'] = $folder;
            }
        
            return $this->imageKit->upload($data);
    }

    public function delete($fileId)
    {
        return $this->imageKit->deleteFile($fileId);
    }

}
