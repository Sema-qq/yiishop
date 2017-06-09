<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'],'required'],
            [['image'],'file','extensions'=>'jpg,png']
        ];
    }

    //получаем картинку, валидируем его
    public function uploadFile(UploadedFile $file, $currentImage)
    {
        //получаем
        $this->image = $file;
        //валидируем
        if ($this->validate())
        {
            //удаляем если существует старая
            $this->deleteCurrentImage($currentImage);
            //сохраняем
            return $this->saveImage();
        }
    }

    //загружаем картинку в папку
    private function getFolder()
    {
        return Yii::getAlias('@web').'uploads/';
    }

    //генерируем название картинки, чтобы оно не могло повторяться
    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)).'.'.$this->image->extension);
    }

    //удаляем старую картинку при загрузке новой для одного и того же товара
    public function deleteCurrentImage($currentImage)
    {
        //удаляем только в случае существования старой картинки
        if ($this->fileExists($currentImage))
        {
            unlink($this->getFolder().$currentImage);
        }
    }

    //проверка картинки на существование
    private function fileExists($currentImage)
    {
        //проверяем на null и пустое значение передаваемой переменной
        if (!empty($currentImage) && $currentImage != null)
        {
            //возвращаем проверку на существование файла и вызываем метод загрузки картинки в папку
            return file_exists($this->getFolder().$currentImage);
        }
    }

    public function saveImage()
    {
        //генерируем название картинки
        $filename = $this->generateFilename();
        //сохраняем в папку
        $this->image->saveAs($this->getFolder().$filename);
        //возвращаем название картинки
        return $filename;
    }
}

