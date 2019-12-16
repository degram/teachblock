<?php
 
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $docFile;

    public function rules()
    {
        return [
            [['docFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'doc, docx, pdf, txt'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->docFile->saveAs('files/' . $this->docFile->baseName . '.' . $this->docFile->extension);
			\Yii::$app->db->createCommand()
              ->insert('lesson', ['lect' =>$this->docFile, 'id_course' => \Yii::$app->request->get('id') ])
              ->execute();
            return true;
        } else {
            return false;
        }
    }
	
}
