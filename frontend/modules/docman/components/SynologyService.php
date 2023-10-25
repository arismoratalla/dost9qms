<?php

namespace frontend\modules\docman\components;

use Yii;
use yii\httpclient\Client;

class SynologyService {

const NAS_URL = 'https://dost9.ph:5001';
const LOGIN_ENDPOINT = '/webapi/auth.cgi';
const LIST_ENDPOINT = '/webapi/entry.cgi';
const UPLOAD_ENDPOINT = '/webapi/upload.cgi';

    public static function login($username, $password) {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl(self::NAS_URL . self::LOGIN_ENDPOINT)
            ->addOptions([
                'sslVerifyPeer' => false,  // Disable SSL peer verification (not recommended for production)
                'sslCafile' => Yii::getAlias('@uploads') . '/docman/ca/syno-ca-cert.pem'  // Path to the CA certificate
            ])
            ->setData([
                'api' => 'SYNO.API.Auth',
                'version' => '3',
                'method' => 'login',
                'account' => $username,
                'passwd' => $password,
                'session' => 'FileStation',
                'format' => 'cookie'
            ])
            ->send();

        if ($response->isOk && isset($response->data['data']['sid'])) {
            return $response->data['data']['sid'];
        } else {
            // Handle error
            \Yii::error("Login error: " . $response->content);
            return "Login error: " . $response->content; // return detailed error message
        }
    }
       
    public static function getFolderContents($sid, $folderPath) {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl(self::NAS_URL . self::LIST_ENDPOINT)
            ->setData([
                'api' => 'SYNO.FileStation.List',
                'version' => '2',
                'method' => 'list',
                'folder_path' => $folderPath,
                '_sid' => $sid
            ])
            ->send();

        if ($response->isOk) {
            return $response->data;
        } else {
            // Handle error
            \Yii::error("Error retrieving folder contents: " . $response->content);
            return $response->content;
        }
    }

    public static function downloadFile($sid, $filePath) {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl(self::NAS_URL . self::LIST_ENDPOINT)  // Use the same LIST_ENDPOINT as it's the entry point for multiple FileStation services.
            ->setData([
                'api' => 'SYNO.FileStation.Download',
                'version' => '2',
                'method' => 'download',
                'path' => $filePath,
                'mode' => 'download',  // This mode will provide direct file download.
                '_sid' => $sid
            ])
            ->send();

        if ($response->isOk) {
            // For a download API, you'd typically get the raw content of the file.
            // Depending on your needs, you might want to stream the content to the user or save it somewhere.
            // Here, we'll return the raw content for simplicity.
            return $response->content;
        } else {
            // Handle error
            \Yii::error("Error downloading file: " . $response->content);
            return $response->content;
        }
    }

    public static function uploadFile($sid, $localFilePath, $destinationPath) {
        $client = new Client();
        
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl(self::NAS_URL . self::UPLOAD_ENDPOINT)
            ->addHeaders(['content-type' => 'multipart/form-data'])
            ->setData([
                'api' => 'SYNO.FileStation.Upload',
                'version' => '2',
                'method' => 'upload',
                'overwrite' => 'true', // Overwrite the file if it already exists. Adjust as needed.
                'path' => $destinationPath,
                '_sid' => $sid
            ])
            ->addFile('file', $localFilePath)  // 'file' is the field name Synology expects for the uploaded file
            ->send();
    
        if ($response->isOk) {
            return $response->data; // You might want to extract and return a specific detail, e.g., the file path in Synology.
        } else {
            // Handle error
            \Yii::error("Error uploading file: " . $response->content);
            return $response->content;
        }
    }
    /*
    public static function uploadFile($sid, $destinationPath, $sourceFilePath)
    {
        $client = new Client();
        
        $data = [
            'api' => 'SYNO.FileStation.Upload',
            'version' => '2',
            'method' => 'upload',
            'path' => dirname($destinationPath),
            'create_parents' => true,
            '_sid' => $sid,
            'overwrite' => true  // Overwrites if a file with the same name exists, adjust this based on your requirements
        ];
        
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl(self::NAS_URL . self::LIST_ENDPOINT)
            ->addFile('file', $sourceFilePath)
            ->setData($data)
            ->send();
            
        if ($response->isOk) {
            // The API returns true in 'success' key if the upload is successful
            if (isset($response->data['success']) && $response->data['success']) {
                return ['success' => true];
            } else {
                $message = isset($response->data['error']['details']) ? $response->data['error']['details'] : 'Unknown upload error';
                return ['success' => false, 'message' => $message];
            }
        } else {
            \Yii::error("Error uploading file to Synology: " . $response->content);
            return ['success' => false, 'message' => 'Failed to upload file.'];
        }
    }*/
}