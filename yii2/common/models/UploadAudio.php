<?php
 
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadAudio extends Model
{
    /**
     * @var UploadedFile
     */
    public $audioFile;

    public function rules()
    {
        return [
            [['audioFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'mp3, wav'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->audioFile->saveAs('files/' . $this->audioFile->baseName . '.' . $this->audioFile->extension);
			\Yii::$app->db->createCommand()
              ->insert('lesson', ['audio' =>$this->audioFile, 'id_course' => \Yii::$app->request->get('id') ])
              ->execute();
            return true;
        } else {
            return false;
        }
    }
}
