<?php
class NewsContr extends News{

    private $title;
    private $description;
     private $id;
    public function __construct($title = null, $description = null, $id = null)
{
    $this->title=$title;
    $this->description=$description;
        $this->id=$id;
}   


public function create(){
   
    if($this->empty_inputs()!==false)
    {  $_SESSION['empty'] = "Fill All Fields";
          header("Location: ../Views/News.php");
          exit();
    }
    
    $this->create_news($this->title,$this->description);
}

public function update(){
   
    if($this->empty_inputs()!==false)
    {$_SESSION['empty'] = "Fill All Fields";
          header("Location: ../Views/News.php?error=empty");
          exit();
    }
    
    $this->update_news($this->id,$this->title,$this->description);
}
public function delete(){

    $this->delete_news($this->id);
}
private function empty_inputs()
{
$result;

if( empty($this->title) || empty($this->description)) {
        $result = true;
    }
     else {
        $result = false;
    }

return  $result;
}    
public function show(){
    
     $this->show_news();
}
}