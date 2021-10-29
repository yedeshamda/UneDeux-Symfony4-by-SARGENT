<?php

namespace App\Service;






use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\UnableToDeleteFile;
use League\Flysystem\UnableToReadFile;
use League\Flysystem\UnableToWriteFile;
use Psr\Log\LoggerInterface;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class UploaderHelper
{

    private $filesystem;
    /**
     * @var RequestStackContext
     */
    private $requestStackContext;
    /**
     * @var LoggerInterface
     */
    private $logger;
    private FlashBagInterface $flashBag;


    public function __construct(FilesystemOperator $publicUploadsFilesystem, FlashBagInterface $flashBag, LoggerInterface $logger, RequestStackContext $requestStackContext)
    {
        $this->filesystem = $publicUploadsFilesystem;
        $this->requestStackContext = $requestStackContext;
        $this->logger = $logger;
        $this->flashBag = $flashBag;
    }

    public function uploadImage(File $file, string $folderName, int $maxsize = 500): ?string
    {


        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }
        $hashName = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $file->guessExtension();

        // Check image format
        if ($file->guessExtension() != "jpg" && $file->guessExtension() != "png" && $file->guessExtension() != "jpeg"
            && $file->guessExtension() != "gif" && $file->guessExtension() != "pdf") {
            $this->flashBag->add("error", "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés");

            return null;


        }
        // Check image size
        $image_info = getimagesize($file);
        /*   $width = $image_info[0];
          $height = $image_info[1];
         if ($width < $maxsize || $height < $maxsize) {
              $this->flashBag->add("error", "La taille minimum requise est " . $maxsize . " x " . $maxsize . " px");


              return null;
          }*/
        $filesize = $file->getSize();
        if ($filesize > 5242880) {
            $this->flashBag->add("error", "Taille de fichier trop grande ( Max 15 MB )");


            return null;
        }

        $stream = fopen($file->getPathname(), 'r');
        try {
            $this->filesystem->writeStream(
                $folderName . '/' . $hashName,
                $stream

            );
            if (is_resource($stream)) {
                fclose($stream);
            }
        } catch (FilesystemException | UnableToWriteFile $exception) {
            throw new \Exception(sprintf('Could not write uploaded file "%s"', $hashName));

        }

     //   return ["name" => $hashName, "orginalName" => $originalFilename,"size" => $filesize];
        return  $hashName;

    }


    public function uploadRemoteImage(string $url, string $folderName, int $maxsize = 500): array
    {
        $infourl = pathinfo($url);
        $name = Urlizer::urlize(pathinfo($infourl['filename'], PATHINFO_FILENAME)) . '.' . $infourl['extension'];
        $hashName = Urlizer::urlize(pathinfo($infourl['filename'], PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $infourl['extension'];
        $binary_data = file_get_contents($url);
        $fileSize = strlen($binary_data);
        $im = imagecreatefromstring($binary_data);
        $imageinfo = getimagesize($im);
        $width = imagesx($im);
        $height = imagesy($im);
        $size = $imageinfo[3];
        try {
            $this->filesystem->write(
                $folderName . '/' . $hashName,
                $binary_data
            );

        } catch (FilesystemException | UnableToWriteFile $exception) {
            throw new \Exception(sprintf('Could not write uploaded file "%s"', $hashName));

        }

        return ["name" => $hashName, "orginalName" => $name, "width" => $width, "height" => $height, "size" => $fileSize];
    }

    public function uploadRemoteFacebookImage(string $url, string $path): string
    {
        $infourl = pathinfo($url);
        $hashName = Urlizer::urlize(pathinfo($infourl['filename'], PATHINFO_FILENAME)) . '-' . uniqid() . '.' . 'jpg';

        try {
            $this->filesystem->write(
                $path . '/' . $hashName,
                file_get_contents($url)
            );

        } catch (FilesystemException | UnableToWriteFile $exception) {
            throw new \Exception(sprintf('Could not write uploaded file "%s"', $hashName));

        }

        return $hashName;
    }

    public function deleteFile(string $path)
    {
        try {
            $this->filesystem->delete($path);

        } catch (FileNotFoundException $ex) {
            return true;
        } catch (FilesystemException | UnableToDeleteFile $exception) {
            throw new \Exception(sprintf('Error deleting "%s"', $path));

        }
        return true;
    }

    public function readStream(string $path)
    {
        try {
            $resource = $this->filesystem->readStream($path);
            return $resource;


        } catch (FilesystemException | UnableToReadFile $exception) {
            // handle the error
        }
        return false;

    }


    function compress_image($source_url, $destination_url, $quality = 85)
    {
        $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
        return imagejpeg($image, $destination_url, $quality);

    }

}