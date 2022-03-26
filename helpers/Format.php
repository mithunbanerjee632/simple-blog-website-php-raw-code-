

<?php
  class Format{
     public function formatDate($date){
     	return date("j F, Y, g:i a",strtotime($date));
     }  

     public function textShorten($text, $limit=400){
     	$text = $text." ";
     	$text = substr($text,0,$limit);
     	$text = substr($text,0,strrpos($text,' ')); //full word nibe
     	$text = $text."........";
     	return $text;

     }

     public function validation($data){
        $data = trim($data);  //string trim korbe
        $data = stripcslashes($data);  // '/' remove korbe
        $data = htmlspecialchars($data); // '</>' remove korbe
        return $data;
     }

     public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];   //browsing path
        $title = basename($path, '.php');

        if($title == 'index'){
            $title = 'home';
        }elseif($title == 'contact'){
            $title = 'contact';
        }

        return $title = ucwords($title);

     }
  }

?>