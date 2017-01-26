<?php
namespace Gluon\Libraries;
use Gluon\Libraries\Cache;
use Gluon\Libraries\General;
/**
 *  
 *  Media
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2017 
 *
 * */
class Media {
    
    private $config = array();
    
	// ---
	
    private $errors;
    
	
	/**
	 * @param object $error_handler
	 * @return void
	 * */
    function __construct($error_handler)
    {
        $this->config['media'] = Cache::get_cache_byfile('app.yml.php');
        $this->errors = $error_handler;
    }
    /**
     * prepare for file upload base don $_FILES super global
     * @return mixed (array, bool)
     * */
    function upload_images()
    {
        $return = array();
        if($_FILES){
            $num = count($_FILES['files']['name']);
            //Just reorganizing the data so it's easier to interpret
            for($i = 0; $i < $num ; $i++){
                    $files[$i]['name'] = $_FILES['files']['name'][$i];
                    $files[$i]['save_name'] = $files[$i]['name'];
                    $files[$i]['type'] = $_FILES['files']['type'][$i];
                    $files[$i]['size'] = $_FILES['files']['size'][$i];
                    $files[$i]['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $files[$i]['error'] = null;
                    if($files[$i]['size'] > $this->config['file_size_limit'])
                        $files[$i]['error'] = General::message('error',array('error','upload','sizemax'));
                    if(!in_array($files[$i]['type'],$this->config['allowed_mimetypes']))
                        $files[$i]['error'] = General::message('error',array('error','upload','notallowed'));
            }
            
            foreach($files as $file){
                    if(!$file['error']){
                            $result[] = $this->saveFile($file, $this->config['upload_folder'].'/'.$file['type']);
                    }else{
                            $this->errors->set_error_message($file['error']);
                    }
            }
            return $return;
		}
        return false;
    }
    
    // ------ private functions
    
    /**
     * save uploaded file to disk 
     * @param array
     * @param $path
     * @return mixed (string, bool)
     * */
    private function saveFile($file,$path)
    {
        if(false === $this->checkFile($file['tmp_name'])) {
            return false;
        }
        $move = move_uploaded_file($file['tmp_name'], $path . $file['save_name']);
        if(false === $move) {
            $this->errors->set_error_message(General::message('error',array('error','upload','movefile')));
            return false;
        }
        return General::message('notice',array('notice','success','upload'));
    }
    /**
     * checks if file exists and does a simple check to ensure the file doesn't contain any PHP
     * - there are other methods for doing this ... not sure if they are better or not
     *   one method that should definetly work is resizing... this should be done anyways for multiple file sizes
     * @param string path to file
     * @return bool
     * */
    private function checkFile($file_path) {
        if(false == file_exists($file_path)) {
            $this->errors->set_error_message(General::message('notice',array('error','upload','upload')));
            return false;
        }
        // rethink this - there are better ways
        // - resize image for example
        $test = file_get_contents($file_path);
        if(strpos($test,'<?php') !== false) {
            $this->errors->set_error_message(General::message('notice',array('error','upload','malicious')));
            return false;
        }
        return true;
    }
}