<?php

namespace App\Support;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaUploader
{
    public static function uploadImage(UploadedFile $file, string $directory = 'uploads', ?string $altText = null): int
    {
        $disk = 'public';
        $stored = self::storeAsWebpWhenPossible($file, $directory, $disk);
        $path = $stored['path'];
        $filename = $stored['filename'];
        $mimeType = $stored['mime_type'];
        $size = $stored['size'];

        $media = Media::query()->create([
            'disk' => $disk,
            'path' => $path,
            'filename' => $filename,
            'mime_type' => $mimeType,
            'size' => $size,
            'alt_text' => $altText,
        ]);

        return $media->id;
    }

    private static function storeAsWebpWhenPossible(UploadedFile $file, string $directory, string $disk): array
    {
        if (! self::supportsWebpConversion()) {
            return self::storeOriginal($file, $directory, $disk);
        }

        $image = self::createImageResource($file);

        if (! $image) {
            return self::storeOriginal($file, $directory, $disk);
        }

        $filenameWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $webpFilename = Str::slug($filenameWithoutExtension);
        if ($webpFilename === '') {
            $webpFilename = Str::random(20);
        }

        $webpPath = trim($directory, '/').'/'.$webpFilename.'-'.Str::random(10).'.webp';
        $temporaryPath = tempnam(sys_get_temp_dir(), 'hekaya_webp_');

        if ($temporaryPath === false) {
            imagedestroy($image);

            return self::storeOriginal($file, $directory, $disk);
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        $written = imagewebp($image, $temporaryPath, 85);
        imagedestroy($image);

        if (! $written) {
            @unlink($temporaryPath);

            return self::storeOriginal($file, $directory, $disk);
        }

        Storage::disk($disk)->put($webpPath, file_get_contents($temporaryPath));
        $size = Storage::disk($disk)->size($webpPath);
        @unlink($temporaryPath);

        return [
            'path' => $webpPath,
            'filename' => $filenameWithoutExtension.'.webp',
            'mime_type' => 'image/webp',
            'size' => $size,
        ];
    }

    private static function createImageResource(UploadedFile $file): mixed
    {
        $realPath = $file->getRealPath();

        if (! $realPath || ! is_file($realPath)) {
            return null;
        }

        return match ($file->getMimeType()) {
            'image/jpeg', 'image/jpg' => function_exists('imagecreatefromjpeg') ? @imagecreatefromjpeg($realPath) : null,
            'image/png' => function_exists('imagecreatefrompng') ? @imagecreatefrompng($realPath) : null,
            'image/gif' => function_exists('imagecreatefromgif') ? @imagecreatefromgif($realPath) : null,
            'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($realPath) : null,
            'image/bmp', 'image/x-ms-bmp' => function_exists('imagecreatefrombmp') ? @imagecreatefrombmp($realPath) : null,
            'image/avif' => function_exists('imagecreatefromavif') ? @imagecreatefromavif($realPath) : null,
            default => self::createImageFromString($realPath),
        };
    }

    private static function createImageFromString(string $realPath): mixed
    {
        $contents = @file_get_contents($realPath);

        if ($contents === false) {
            return null;
        }

        return @imagecreatefromstring($contents);
    }

    private static function supportsWebpConversion(): bool
    {
        return function_exists('imagewebp') && function_exists('imagecreatetruecolor');
    }

    private static function storeOriginal(UploadedFile $file, string $directory, string $disk): array
    {
        $path = $file->store($directory, $disk);

        return [
            'path' => $path,
            'filename' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ];
    }
}
