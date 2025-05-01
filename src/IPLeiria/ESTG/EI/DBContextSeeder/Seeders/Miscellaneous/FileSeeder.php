<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileSeeder extends FieldSeeder
{
    protected string $sourceDir;
    protected string $destinationDir;
    protected $fileNameCallback = null;
    protected array $fileList = [];
    protected bool $destinationCleaned = false;

    public function sourceFile(string $directory): static
    {
        if (!File::isDirectory($directory)) {
            throw new \InvalidArgumentException("Source directory '{$directory}' is invalid.");
        }

        $this->sourceDir = $directory;
        $this->fileList = collect(File::files($directory))
            ->map(fn($file) => $file->getPathname())
            ->all();

        if (empty($this->fileList)) {
            throw new \RuntimeException("No files found in '{$directory}'.");
        }

        return $this;
    }

    public function copyTo(string $directory): static
    {
        $this->destinationDir = $directory;
        return $this;
    }

    public function fileName(callable $callback): static
    {
        $this->fileNameCallback = $callback;
        return $this;
    }

    public function generateValue(): ?string
    {
        if (!$this->destinationCleaned) {
            $this->cleanDestinationDirectory();
            $this->destinationCleaned = true;
        }

        $filePath = $this->isUnique()
            ? self::$faker->unique()->randomElement($this->fileList)
            : self::$faker->randomElement($this->fileList);

        $originalName = pathinfo($filePath, PATHINFO_BASENAME);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        $newFileName = $this->fileNameCallback
            ? call_user_func($this->fileNameCallback, $originalName)
            : Str::random() . '.' . $extension;

        $targetPath = rtrim($this->destinationDir, '/') . '/' . $newFileName;

        File::ensureDirectoryExists($this->destinationDir);

        if (!File::copy($filePath, $targetPath)) {
            throw new \RuntimeException("Failed to copy '{$filePath}' to '{$targetPath}'");
        }

        return $newFileName;
    }

    protected function cleanDestinationDirectory(): void
    {
        if (File::exists($this->destinationDir)) {
            foreach (File::files($this->destinationDir) as $file) {
                File::delete($file->getPathname());
            }
        }
    }
}
