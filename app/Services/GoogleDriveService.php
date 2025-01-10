<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Google\Client;
use Google\Service\Drive;

class GoogleDriveService
{
    private $driveService;

    public function __construct()
    {
        $client = new Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->setAccessType('offline');
        $client->addScope(Drive::DRIVE);

        $refreshToken = env('GOOGLE_DRIVE_REFRESH_TOKEN');
        $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);

        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            $newAccessToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $client->setAccessToken($newAccessToken);
        }

        $this->driveService = new Drive($client);
    }

    public function createFolder($name, $parentId = null)
    {
        $folderMetadata = [
            'name' => $name,
            'mimeType' => 'application/vnd.google-apps.folder',
        ];

        if ($parentId) {
            $folderMetadata['parents'] = [$parentId];
        }

        try {
            $folder = $this->driveService->files->create(new Drive\DriveFile($folderMetadata), [
                'fields' => 'id',
            ]);
            return $folder;
        } catch (\Exception $e) {
            Log::error('Failed to create folder: ' . $e->getMessage());
            throw new \Exception("Failed to create folder: " . $e->getMessage());
        }
    }

    public function uploadFile($file, $parentId)
    {
        try {
            $fileMetadata = [
                'name' => $file->getClientOriginalName(),
                'parents' => [$parentId],
            ];

            $content = file_get_contents($file->getRealPath());

            $uploadedFile = $this->driveService->files->create(
                new Drive\DriveFile($fileMetadata),
                [
                    'data' => $content,
                    'mimeType' => $file->getMimeType(),
                    'uploadType' => 'multipart',
                ]
            );

            Log::info('File uploaded to Google Drive: ', ['id' => $uploadedFile->id]);
            return $uploadedFile;
        } catch (\Exception $e) {
            Log::error('Google Drive Upload Error: ' . $e->getMessage());
            throw new \Exception("Failed to upload file to Google Drive.");
        }
    }

    public function listFiles($query = [], $fields = 'files(id, name, mimeType)')
    {
        $parameters = array_merge(['fields' => $fields], $query);

        try {
            return $this->driveService->files->listFiles($parameters);
        } catch (\Exception $e) {
            Log::error('Failed to list files: ' . $e->getMessage());
            throw new \Exception("Failed to list files: " . $e->getMessage());
        }
    }

    // public function deleteFile($fileId)
    // {
    //     try {
    //         $this->driveService->files->delete($fileId);
    //         Log::info('File deleted from Google Drive: ' . $fileId);
    //     } catch (\Exception $e) {
    //         Log::error('Failed to delete file: ' . $e->getMessage());
    //         throw new \Exception("Failed to delete file: " . $e->getMessage());
    //     }
    // }

   






}

?>
