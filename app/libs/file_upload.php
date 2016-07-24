<?php
namespace app\libs;

class File_Upload
{

  private $path;
  
  function __construct($name, $path)
  {
    if (!empty($_FILES[$name]["tmp_name"])) {
      $this->path = $path;
      $this->tmp = $_FILES[$name]["tmp_name"];
      $this->size = $_FILES[$name]["size"];

      $imageinfo = getimagesize($_FILES[$name]["tmp_name"]);
      $mime_ar = explode("/", $imageinfo["mime"]);
      $this->mime = $mime_ar[1];
      $this->namefile = "image-".uniqid();
      $this->dir = $_SERVER['DOCUMENT_ROOT']."/".$path;
    }

  }

  public function go()
  {
    if (is_uploaded_file($this->tmp)) {

      $status = $this->isVoidImg();
      $register = \AppRegister::init();
      
      //Сохранение загруженного изображения с расширением, которое возвращает функция getimagesize()
       //Расширение изображения
      if ($status == true) {

        //Функция, перемещает файл из временной, в указанную вами папку
        if (move_uploaded_file($this->tmp, $this->dir.$this->namefile.".".$this->mime)) {
          return $this->namefile.".".$this->mime;
        } else{
          $register->set("err", "Произошла ошибка при загрузке файла");
          return false;
        }
      }
      
    }
    return false;

  }

  private function isVoidImg(){
    $register = \AppRegister::init();
    if($this->size > 1000000)
    {
      $register->set("err", "Изображение не загружено. Допустимый размер файла 1 Мб");
      return false;
    } elseif ($this->mime != "gif" && $this->mime != "jpeg" && $this->mime !="png" && $this->mime != "jpg") {
      $register->set("err", "Загружаемый файл не является изображением");
      return false;
    }
    return true;
  }

}







