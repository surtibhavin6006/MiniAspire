<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 10/1/19
 * Time: 10:37 AM
 */

namespace App\CAbstract;


use App\Interfaces\RepositoryInterface;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class  RepositoryAbstract implements RepositoryInterface
{

    /**
     * @param $uploadPath
     * @param UploadedFile $file
     * @param string $fileName
     * @return string
     */
    public function uploadFile($uploadPath, UploadedFile $file, $fileName = "")
    {

        if(!empty($fileName)){

            Storage::putFileAs(
                $uploadPath,
                $file,
                $fileName
            );

            return $fileName;

        } else {

            $returnData = Storage::putFile(
                $uploadPath,
                $file
            );

            $explodeReturnData = explode("/",$returnData);

            $fileName = $explodeReturnData[count($explodeReturnData) - 1];

            return $fileName;

        }

    }

    public function uploadFiles(UploadedFile $files)
    {

    }

    /**
     * @param array $files
     */
    public function deleteFiles($files = array())
    {
        Storage::delete($files);
    }

}