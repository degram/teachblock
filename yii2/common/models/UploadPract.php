<?php
 
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadPract extends Model
{
    /**
     * @var UploadedFile
     */
    public $docFilePract;

    public function rules()
    {
        return [
            [['docFilePract'], 'file', 'skipOnEmpty' => false, 'extensions' => 'doc, docx, pdf, txt'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->docFilePract->saveAs('files/' . $this->docFilePract->baseName . '.' . $this->docFilePract->extension);
			\Yii::$app->db->createCommand()
              ->insert('lesson', ['pract' =>$this->docFilePract, 'id_course' => \Yii::$app->request->get('id') ])
              ->execute();
            return true;
        } else {
            return false;
        }
    }
	
}