<?php

namespace frontend\modules\docman\components;

use Yii;
use yii\httpclient\Client;

class SynologyService {

const NAS_URL = 'http://192.168.1.20:5000';
const LOGIN_ENDPOINT = '/webapi/auth.cgi';
const LIST_ENDPOINT = '/webapi/entry.cgi';
const UPLOAD_ENDPOINT = '/webapi/upload.cgi';

    public static function login($username, $password) {
        $url = self::NAS_URL . self::LOGIN_ENDPOINT . '?' . http_build_query([
            'api' => 'SYNO.API.Auth',
            'version' => '3',
            'method' => 'login',
            'account' => $username,
            'passwd' => $password,
            'session' => 'FileStation',
            'format' => 'cookie'
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // If you're using HTTPS and the certificate is not verified
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle error
            \Yii::error("Login error: " . curl_error($ch));
            return "Login error: " . curl_error($ch);
        }

        curl_close($ch);

        $responseData = json_decode($response, true);

        if (isset($responseData['data']['sid'])) {
            return $responseData['data']['sid'];
        } else {
            // Handle error
            \Yii::error("Login error: " . $response);
            return "Login error: " . $response;
        }
    }
    /*public static function login($username, $password) {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl(self::NAS_URL . self::LOGIN_ENDPOINT)
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
    }*/
       
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