<?php

namespace App\Services;


class FilesService
{
    //upload item image
    public function uploadImage($file)
    {
        $fileName = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('images/products'), $fileName);
        return $fileName;
    }

    //upload list image
    public function uploadListImages($files)
    {
        $listImage = [];

        foreach ($files as $file) {
            if ($file->isValid()) {
                $fileName = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('images/products'), $fileName);
                $listImage[] = $fileName;
            }
        }

        return json_encode($listImage);
    }
    //delete image
    public function deleteImage($fileName)
    {
        $filePath = public_path('images/products') . '/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    //delete images
    public function deleteImages($arrImage)
    {
        foreach (json_decode($arrImage) as $fileName) {
            $filePath = public_path('images/products') . '/' . $fileName;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}
