<?php

class FotoUploadController extends PluginController {

  public function index() {
    echo '';
  }

  public function remove($page_id) {
    use_helper('Dir');

    $path = FROG_ROOT . '/public/foto/' . $page_id . '/';
    if (is_dir($path)) {
      $dir = new Dir($path);
      $dir->remove();
    }


    $path = FROG_ROOT . '/public/gallery/' . $page_id . '/';
    if (is_dir($path)) {
      $dir = new Dir($path);
      $dir->remove();
    }
    
    echo 'success';
  }

  public function upload() {
    header('HTTP/1.0 200 OK');
    $targetPath = FROG_ROOT . '/public/foto/' . $_POST['page_id'] . '/';

    if (!is_dir($targetPath)) {
      mkdir(str_replace('//', '/', $targetPath), 0755, true);
    }
    $dir = opendir($targetPath);
    $i = 1;
    while (false !== ($file = readdir($dir))) {
      if (strpos($file, '.jpg', 1)) {
        $i++;
      }
    }
    $start = $i;

    if (!empty($_FILES)) {
      $tempFile = $_FILES['Filedata']['tmp_name'];
      $targetFile = str_replace('//', '/', $targetPath) . $start . '.jpg';

      move_uploaded_file($tempFile, $targetFile);
      echo (int) $start;
    }
  }

}