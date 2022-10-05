<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('@data', dirname(dirname(__DIR__)) . '/uploads');
Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/frontend/web/uploads');


$whitelist = array(
    '127.0.0.1',
    '::1',
);
if (isset($_SERVER['SERVER_NAME'])) {
    if (!in_array($_SERVER['SERVER_NAME'], $whitelist)) {
        $Backend_URI = 'https://' . $_SERVER['SERVER_NAME'] . '/';
        $BaseURI = $Backend_URI.'/';
        $Signature_URI = $Backend_URI . "backend/web/uploads/user/signature/";
        $Backend_URI = $Backend_URI . "backend/web/uploads/user/photo/";
        
        #$FrontendBaseURI = 'http://' . $_SERVER['SERVER_NAME'] . ':8082/';
        if($_SERVER['SERVER_NAME'] == '192.168.1.95')
                $FrontendBaseURI = 'https://' . $_SERVER['SERVER_NAME'] . ':8080/';
        else
                $FrontendBaseURI = 'https://' . $_SERVER['SERVER_NAME'] . '/';
    } else {
        $Backend_URI = 'http://localhost:8080/faims/backend/web/uploads/user/photo/';
        $Signature_URI = 'http://localhost:8080/faims/backend/web/uploads/user/signaure/';
        $BaseURI = "http://localhost:8080/faims/backend/web/";
        $BaseURI2 = "http://localhost:8080/faims/frontend/web/";
        $FrontendBaseURI = "http://localhost:8080/faims/frontend/web/";
    }
    $GLOBALS['upload_url'] = $Backend_URI;
    $GLOBALS['signature_url'] = $Signature_URI;
    $GLOBALS['base_uri'] = $BaseURI;
    $GLOBALS['frontend_base_uri'] = $FrontendBaseURI;
}

