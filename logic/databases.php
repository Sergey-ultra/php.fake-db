<?php

class Databases
{
   public static function create ($filepath)
   {
       file_put_contents($filepath, '');
   }
   public static function write ($filepath, $filetype, $data)
   {
       $file = fopen($filepath, 'a');
       if ($filetype == 'csv'){
           fputcsv($file, $data);
       }
       if ($filetype == 'json'){
           $tempArray =  self::read ($filepath, $filetype);
           if ($tempArray){
               $data = array_merge($tempArray, $data);
           }
           $jsonData = json_encode($data);
           file_put_contents($filepath, $jsonData);
       }
       fclose($file);
   }

   public static function read ($filepath, $filetype)
   {
       switch ($filetype) {
           case'csv':
               if (($file = fopen($filepath, "r")) !== FALSE) {
                   while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
                       $dataArray[] = $data;
                   }
               }
               fclose($file);
               break;
           case 'json':
               $string = file_get_contents($filepath);
               // Превращаем строку в объект
               $dataArray = json_decode($string, true);
               break;
       }

       return $dataArray;
   }
}

