<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AppSetup extends Command
{
    protected $signature = 'app:setup';

    protected $description = 'Setup the application by merging and extracting multi-part ZIP files.';

    public function handle(): void
    {
        $baseZipPath = 'imports/imports.zip';
        $tempZipPath = $this->mergeZipParts($baseZipPath);

        try {
            $this->extractZip($tempZipPath);
            $this->info('Application setup complete.');
        } finally {
            @unlink($tempZipPath);
        }
    }

    protected function mergeZipParts(string $baseZipPath): string
    {
        $tempZipPath = tempnam(sys_get_temp_dir(), 'mergedZip');
        if (! $tempZipPath) {
            throw new Exception('Failed to create a temporary file.');
        }

        $tempZipStream = fopen($tempZipPath, 'wb');
        if (! $tempZipStream) {
            throw new Exception('Cannot open temporary file for writing.');
        }

        $part = 1;
        while (Storage::disk('data')->exists($partialPath = $baseZipPath.'.'.str_pad($part, 3, '0', STR_PAD_LEFT))) {
            fwrite($tempZipStream, Storage::disk('data')->get($partialPath));
            $part++;
        }

        if ($part === 1) {
            fclose($tempZipStream);
            @unlink($tempZipPath);
            throw new Exception('No ZIP file parts found.');
        }

        fclose($tempZipStream);

        return $tempZipPath;
    }

    protected function extractZip(string $tempZipPath): void
    {
        $zip = new ZipArchive;
        if ($zip->open($tempZipPath) !== true) {
            throw new Exception('Failed to open merged ZIP file.');
        }

        if (! $zip->extractTo(base_path('data/imports'))) {
            $zip->close();
            throw new Exception('Failed to extract ZIP file.');
        }

        $zip->close();
    }
}
