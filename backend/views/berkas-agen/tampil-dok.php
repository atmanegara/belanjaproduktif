<?php
// $tes= str_replace('\\', '/',$file_berkas['lokasi_upload']);
// $mulai= strpos($tes,"/uploads");
$path_file=$file_berkas['lokasi_upload'];//'.'.substr($tes,$mulai);
$path_img = str_replace(" ","%20",$path_file).'/'. str_replace(" ","%20",$file_berkas['filename']);

echo \yii2assets\pdfjs\PdfJs::widget([
  'width'=>'500px',
  'height'=> '500px',
  'url'=> $path_img,
   
]);
?>

<style>
    .modal-content {
  position: absolute;
    }
  </style>