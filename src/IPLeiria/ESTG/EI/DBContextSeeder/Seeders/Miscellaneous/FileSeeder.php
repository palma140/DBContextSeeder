<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use Dotenv\Util\Str;
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
    protected array $backupUsedFiles = [];

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
     * Backups the current state of used files
     */
    public function backupState(): void
    {
        $this->backupUsedFiles = $this->usedFiles;
    }

    /**
     * Restores the state of used files from backup
     */
    public function restoreState(): void
    {
        $this->usedFiles = $this->backupUsedFiles;

        // Clean destination directory from files that were copied after the backup point
        $currentFiles = File::allFiles($this->destination);
        $backupCount = count($this->backupUsedFiles);

        foreach ($currentFiles as $index => $file) {
            if ($index >= $backupCount) {
                File::delete($file->getPathname());
            }
        }
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

        // Se o campo deve ser único, usar apenas arquivos não utilizados
        if ($this->isUnique()) {
            $availableFiles = array_diff($this->sourceFiles, $this->usedFiles);

            // Se não há mais arquivos únicos disponíveis, retornar null
            if (empty($availableFiles)) {
                return null;
            }

            // Embaralhar apenas os arquivos disponíveis
            $availableFiles = array_values($availableFiles);
            shuffle($availableFiles);
            $filesToCheck = $availableFiles;
        } else {
            // Se não precisa ser único, usar todos os arquivos aleatoriamente
            $filesToCheck = $this->sourceFiles;
            shuffle($filesToCheck);
        }

        foreach ($filesToCheck as $filePath) {
            $originalName = basename($filePath);

            // Aplicar callback de filtro se existir
            if ($this->callback && !$this->callback->__invoke($filePath, $originalName, $row)) {
                continue;
            }

            // Aplicar callback de renomeação se existir
            $renamed = $this->renameCallback?->__invoke($originalName, $row);
            $finalName = (!is_string($renamed) || trim($renamed) === '') ? $originalName : $renamed;

            // Copiar arquivo para destino
            File::copy($filePath, $this->destination . DIRECTORY_SEPARATOR . $finalName);

            // Marcar arquivo como usado apenas se o campo for único
            if ($this->isUnique()) {
                $this->usedFiles[] = $filePath;
            }

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
