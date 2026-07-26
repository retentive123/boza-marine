<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesImageUploads
{
    protected function storeImage(UploadedFile $file, string $folder): string
    {
        return $file->store($folder, 'public');
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
}
