<?php









if (isset($_POST['name']) && isset($_POST['message'])){
    $name='name='. $_POST['name'];
    $message='message='. $_POST['message'];
    $post = array(
        'name' => $_POST['name'],
        'message' => $_POST['message']
    );
}



$poster = 'http://touiteur.cefim-formation.org/send';//?'.$name."&".$message;
$retourtouitter = getdatafromouterspace($poster);








    function getdatafromouterspace($url){
        $message='';
        $name='';
        if (isset($_POST['name']) && isset($_POST['message'])){

            $post = array(
                'name' => $_POST['name'],
                'message' => $_POST['message']
            );
        }
    
        $data = http_build_query($post);
    
        $content = file_get_contents(
            $url,
            FALSE,
            stream_context_create(
                array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => "Content-type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($data) . "\r\n",
                        'content' => $data,
                    )
                )
            )
        );
        
        if (!$content) {
            $content='raté';
            // $content=json_encode(array('error', Kesako($content)));
        }
        // echo "php:".$data.PHP_EOL;
        // echo "php:".Kesako($content).PHP_EOL;
        echo $content;
    }
    // --------------------------------------------
    




    function Kesako($KasaKo){
        $message='';
        switch(gettype($KasaKo)){
            case 'NULL':
                $message = '';
            break;
            case 'boolean':
                $message = 'boolean';
            break;
            case 'integer':
                $message = 'integer';
            break;
            case 'string':
                $message = 'string';
            break;
            case 'array':
                $message = 'array';
            break;
            case 'object':
                $message = 'object';
            break;
            case 'resource':
                $message = 'resource';
            break;
            case 'unknown type':
                $message = 'unknown type';
            break;
        }
        return $message;
    }
?>