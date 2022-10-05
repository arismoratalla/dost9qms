<?php

/*
 * Project Name: eulims * 
 * Copyright(C)2017 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 12 22, 17 , 4:06:42 PM * 
 * Module: UploadForm * 
 */

namespace backend\models;
use yii\base\Model;
use yii\web\UploadedFile;
/**
 * Description of UploadForm
 *
 * @author OneLab
 */
class UploadForm {
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('/uploads/user/photo/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
