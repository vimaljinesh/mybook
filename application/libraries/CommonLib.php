<?php

class CommonLib{
    
    public function sendJson($arrData){
        header('Content-Type: application/json');
        die(json_encode($arrData));
    }
    
}

?>

