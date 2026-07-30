<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesImageUploads
{
    protected function storeImage(UploadedFile $file, string $folder): string
    {
        $path = $file->store($folder, 'public');

        $this->optimizeStoredImage($path);

        return $path;
    }

    protected function replaceImage(?UploadedFile $file, string $folder, ?string $existingPath): ?string
    {
        if (! $file) {
            return $existingPath;
        }

        $this->deleteImage($existingPath);

        return $this->storeImage($file, $folder);
    }

    protected function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Cap uploaded images to a sane max width and re-encode them at a
     * reasonable quality, in place. Never blocks the upload — any failure
     * (unsupported format, missing GD, corrupt file) just leaves the
     * original file as-is.
     */
    protected function optimizeStoredImage(string $path, int $maxWidth = 1920, int $jpegQuality = 82): void
    {
        if (! extension_loaded('gd')) {
            return;
        }

        try {
            $disk = Storage::disk('public');
            $fullPath = $disk->path($path);

            $info = @getimagesize($fullPath);

            if (! $info) {
                return;
            }

            [$width, $height, $type] = $info;

            if (! in_array($type, [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP], true)) {
                return;
            }

            $source = @imagecreatefromstring(file_get_contents($fullPath));

            if (! $source) {
                return;
            }

            if (in_array($type, [IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP], true)) {
                imagealphablending($source, false);
                imagesavealpha($source, true);
            }

            if ($type === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
                $exif = @exif_read_data($fullPath);

                if (! empty($exif['Orientation'])) {
                    $rotated = match ($exif['Orientation']) {
                        3 => imagerotate($source, 180, 0),
                        6 => imagerotate($source, -90, 0),
                        8 => imagerotate($source, 90, 0),
                        default => null,
                    };

                    if ($rotated) {
                        imagedestroy($source);
                        $source = $rotated;
                        $width = imagesx($source);
                        $height = imagesy($source);
                    }
                }
            }

            if ($width > $maxWidth) {
                $newWidth = $maxWidth;
                $newHeight = (int) round($height * ($maxWidth / $width));

                $resized = imagecreatetruecolor($newWidth, $newHeight);

                if (in_array($type, [IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP], true)) {
                    imagealphablending($resized, false);
                    imagesavealpha($resized, true);
                }

                imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagedestroy($source);
                $source = $resized;
            }

            match ($type) {
                IMAGETYPE_JPEG => imagejpeg($source, $fullPath, $jpegQuality),
                IMAGETYPE_PNG => imagepng($source, $fullPath, 6),
                IMAGETYPE_GIF => imagegif($source, $fullPath),
                IMAGETYPE_WEBP => imagewebp($source, $fullPath, $jpegQuality),
            };

            imagedestroy($source);
        } catch (\Throwable) {
            // Optimization is a nice-to-have; never let it block an upload.
        }
    }
}
