<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class FileUploaderService
{
    public function uploadImage(UploadedFile $uploadedFile, array $options = []): File
    {
        $image = Image::read($uploadedFile);

        $maxWidth = $options['max_width'] ?? 800;
        $quality = $options['quality'] ?? 80;

        if ($image->width() > $maxWidth) {
            $image->scale($maxWidth);
        }

        $extension = $uploadedFile->getClientOriginalExtension() ?? 'jpg';
        $filename = Str::random(40) . '.' . $extension;
        $path = 'images/' . date('Y-m-d') . '-' . $filename;

        $encodedImage = $image->toJpeg($quality);
        Storage::disk('s3')->put($path, $encodedImage);

        return File::create([
            'disk' => 's3',
            'path' => $path,
            'filename' => $filename,
            'extension' => $extension,
            'mime' => $uploadedFile->getMimeType(),
            'size' => strlen($encodedImage),
            'fileable_type' => $options['fileable_type'] ?? null,
            'fileable_id' => $options['fileable_id'] ?? null,
        ]);
    }
}
