<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use Illuminate\Support\Facades\File;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * FileSeeder is responsible for seeding file names from a source directory into the database,
 * copying the corresponding files into a destination directory.
 *
 * It supports a filtering callback to control which files are accepted
 * and a renaming callback to customize the copied file names.
 */
class FileSeeder extends FieldSeeder
{
    protected string $source;
    protected string $destination;
    protected ?\Closure $callback;
    protected ?\Closure $renameCallback;
    protected array $sourceFiles = [];
    protected array $usedFiles = [];
    protected bool $initialized = false;

    /**
     * FileSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The parent table seeder.
     * @param string $field The database field this seeder applies to.
     * @param string $source Directory path where source files are located.
     * @param string $destination Directory path where files should be copied.
     * @param \Closure|null $callback A filtering callback that receives ($path, $originalName, $row) and must return true to accept the file.
     * @param \Closure|null $renameCallback A callback that receives ($originalName, $row) and returns the new file name.
     * @param string|null $memoryLimit Optional memory limit override (e.g., '512M', '1G').
     */
    public function __construct(
        TableSeeder $tableSeeder,
        string $field,
        string $source,
        string $destination,
        ?\Closure $callback = null,
        ?\Closure $renameCallback = null,
        ?string $memoryLimit = null
    ) {
        if ($memoryLimit !== null) {
            ini_set('memory_limit', $memoryLimit);
        }

        parent::__construct($tableSeeder, $field);
        $this->source = $source;
        $this->destination = $destination;
        $this->callback = $callback;
        $this->renameCallback = $renameCallback;
    }

    /**
     * Initializes the file system state: prepares the destination directory and lists source files.
     */
    protected function initialize(): void
    {
        if ($this->initialized) {
            return;
        }

        File::ensureDirectoryExists($this->destination);
        File::cleanDirectory($this->destination);

        $this->sourceFiles = collect(File::allFiles($this->source))
            ->map(fn($file) => $file->getPathname())
            ->toArray();

        $this->usedFiles = [];
        $this->initialized = true;
    }

    /**
     * Generates the value for a database row and copies the corresponding file to the destination.
     *
     * @param array $row The full row data, allowing access to other fields for context.
     * @return string|null The file name that was copied and inserted into the field, or null if no valid file was found.
     */
    protected function generateValueWithRow(array $row): mixed
    {
        $this->initialize();

        $remainingFiles = array_diff($this->sourceFiles, $this->usedFiles);
        shuffle($remainingFiles);

        foreach ($remainingFiles as $filePath) {
            $originalName = basename($filePath);

            if ($this->callback && !$this->callback->__invoke($filePath, $originalName, $row)) {
                continue;
            }

            $renamed = $this->renameCallback?->__invoke($originalName, $row);

            $finalName = (!is_string($renamed) || trim($renamed) === '') ? $originalName : $renamed;

            File::copy($filePath, $this->destination . DIRECTORY_SEPARATOR . $finalName);
            $this->usedFiles[] = $filePath;

            return $finalName;
        }

        return null;
    }

    /**
     * This method is not used in this implementation.
     *
     * @return mixed
     */
    protected function generateValue(): mixed
    {
        return null;
    }
}
