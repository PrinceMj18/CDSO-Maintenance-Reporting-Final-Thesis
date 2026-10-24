<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;

class BackupController extends Controller
{
    /**
     * Show backup and restore page.
     */
    public function index()
    {
        return view('admin.backup');
    }

    /**
     * Create database + uploaded files backup.
     */
    public function backup()
    {
        $backupDirectory = storage_path('app/backups');

        // Create backup directory if it doesn't exist
        if (!File::exists($backupDirectory)) {
            File::makeDirectory($backupDirectory, 0755, true);
        }

        $timestamp = now()->format('Y-m-d_H-i-s');

        $sqlFile = $backupDirectory . "/database_{$timestamp}.sql";
        $zipFile = $backupDirectory . "/CCA_Backup_{$timestamp}.zip";

        /*
        |--------------------------------------------------------------------------
        | Database Configuration
        |--------------------------------------------------------------------------
        */

        $host = env('DB_HOST', '127.0.0.1');
        $port = env('DB_PORT', '3307');
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        /*
        |--------------------------------------------------------------------------
        | MySQL 8.0 mysqldump
        |--------------------------------------------------------------------------
        */

        $mysqldump = 'C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump.exe';

        if (!file_exists($mysqldump)) {
            return back()->with(
                'error',
                'MySQL 8.0 mysqldump.exe was not found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create SQL Backup
        |--------------------------------------------------------------------------
        */

        $command = '"' . $mysqldump . '"'
            . ' --host=' . escapeshellarg($host)
            . ' --port=' . escapeshellarg($port)
            . ' --user=' . escapeshellarg($username)
            . ' --add-drop-table'
            . ' --routines'
            . ' --triggers'
            . ' --events';

        if ($password !== '') {
            $command .= ' --password=' . escapeshellarg($password);
        }

        $command .= ' ' . escapeshellarg($database)
            . ' > ' . escapeshellarg($sqlFile);

        exec($command, $output, $resultCode);

        if ($resultCode !== 0 || !file_exists($sqlFile) || filesize($sqlFile) === 0) {

            if (file_exists($sqlFile)) {
                unlink($sqlFile);
            }

            return back()->with(
                'error',
                'Database backup failed. Please check your MySQL configuration.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create ZIP
        |--------------------------------------------------------------------------
        */

        $zip = new ZipArchive();

        if ($zip->open(
            $zipFile,
            ZipArchive::CREATE | ZipArchive::OVERWRITE
        ) !== true) {

            unlink($sqlFile);

            return back()->with(
                'error',
                'Unable to create backup ZIP file.'
            );
        }

        // Add database SQL file
        $zip->addFile(
            $sqlFile,
            basename($sqlFile)
        );

        /*
        |--------------------------------------------------------------------------
        | Add Uploaded Maintenance Images
        |--------------------------------------------------------------------------
        */

        $publicStorage = storage_path('app/public');

        if (File::exists($publicStorage)) {

            $files = File::allFiles($publicStorage);

            foreach ($files as $file) {

                $relativePath = str_replace(
                    $publicStorage . DIRECTORY_SEPARATOR,
                    '',
                    $file->getPathname()
                );

                $zip->addFile(
                    $file->getPathname(),
                    'storage/' . str_replace('\\', '/', $relativePath)
                );
            }
        }

        $zip->close();

        /*
        |--------------------------------------------------------------------------
        | Remove Temporary SQL File
        |--------------------------------------------------------------------------
        */

        if (file_exists($sqlFile)) {
            unlink($sqlFile);
        }

        /*
        |--------------------------------------------------------------------------
        | Download Backup
        |--------------------------------------------------------------------------
        */

        return response()->download(
            $zipFile,
            basename($zipFile),
            [
                'Content-Type' => 'application/zip',
            ]
        )->deleteFileAfterSend(true);
    }

    /**
     * Restore database + uploaded files.
     */
    public function restore(Request $request)
    {
        $request->validate([
            'backup' => [
                'required',
                'file',
                'mimes:zip',
                'max:512000',
            ],
        ]);

        $backupDirectory = storage_path('app/backups');

        if (!File::exists($backupDirectory)) {
            File::makeDirectory($backupDirectory, 0755, true);
        }

        /*
        |--------------------------------------------------------------------------
        | Save Uploaded Backup
        |--------------------------------------------------------------------------
        */

        $uploadedBackup = $request->file('backup');

        $timestamp = now()->format('YmdHis');

        $zipPath = $backupDirectory . "/restore_{$timestamp}.zip";

        $uploadedBackup->move(
            $backupDirectory,
            basename($zipPath)
        );

        /*
        |--------------------------------------------------------------------------
        | Open ZIP
        |--------------------------------------------------------------------------
        */

        $zip = new ZipArchive();

        if ($zip->open($zipPath) !== true) {

            unlink($zipPath);

            return back()->with(
                'error',
                'The backup file could not be opened.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Find SQL File
        |--------------------------------------------------------------------------
        */

        $sqlFileName = null;

        for ($i = 0; $i < $zip->numFiles; $i++) {

            $fileName = $zip->getNameIndex($i);

            if (str_ends_with(
                strtolower($fileName),
                '.sql'
            )) {
                $sqlFileName = $fileName;
                break;
            }
        }

        if (!$sqlFileName) {

            $zip->close();
            unlink($zipPath);

            return back()->with(
                'error',
                'No database SQL file was found inside the backup.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Extract ZIP
        |--------------------------------------------------------------------------
        */

        $restoreDirectory = $backupDirectory
            . DIRECTORY_SEPARATOR
            . 'restore_'
            . now()->format('YmdHis');

        File::makeDirectory(
            $restoreDirectory,
            0755,
            true
        );

        $zip->extractTo($restoreDirectory);

        $zip->close();

        $sqlPath = $restoreDirectory
            . DIRECTORY_SEPARATOR
            . $sqlFileName;

        if (!file_exists($sqlPath)) {

            File::deleteDirectory($restoreDirectory);
            unlink($zipPath);

            return back()->with(
                'error',
                'The database SQL file could not be extracted.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Database Configuration
        |--------------------------------------------------------------------------
        */

        $host = env('DB_HOST', '127.0.0.1');
        $port = env('DB_PORT', '3307');
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        /*
        |--------------------------------------------------------------------------
        | MySQL 8.0 mysql.exe
        |--------------------------------------------------------------------------
        */

        $mysql = 'C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysql.exe';

        if (!file_exists($mysql)) {

            File::deleteDirectory($restoreDirectory);
            unlink($zipPath);

            return back()->with(
                'error',
                'MySQL 8.0 mysql.exe was not found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Restore Database
        |--------------------------------------------------------------------------
        */

        $command = '"' . $mysql . '"'
            . ' --host=' . escapeshellarg($host)
            . ' --port=' . escapeshellarg($port)
            . ' --user=' . escapeshellarg($username);

        if ($password !== '') {
            $command .= ' --password=' . escapeshellarg($password);
        }

        $command .= ' ' . escapeshellarg($database)
            . ' < ' . escapeshellarg($sqlPath);

        exec($command, $output, $resultCode);

        if ($resultCode !== 0) {

            File::deleteDirectory($restoreDirectory);
            unlink($zipPath);

            return back()->with(
                'error',
                'Database restore failed.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Restore Uploaded Files
        |--------------------------------------------------------------------------
        */

        $extractedStorage = $restoreDirectory
            . DIRECTORY_SEPARATOR
            . 'storage';

        if (File::exists($extractedStorage)) {

            $publicStorage = storage_path('app/public');

            File::ensureDirectoryExists($publicStorage);

            File::copyDirectory(
                $extractedStorage,
                $publicStorage
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Cleanup
        |--------------------------------------------------------------------------
        */

        File::deleteDirectory($restoreDirectory);

        if (file_exists($zipPath)) {
            unlink($zipPath);
        }

        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Database and uploaded files were successfully restored.'
        );
    }
}