<?php
/**
 * Class Main_Controller
 * This Controller Load All Views And Models
 */
class Main_Controller
{
    /**
     * @var object Model Name
     */
    public $models = "";

    /**
     * @param $url
     * @param array $data
     * @return false
     * This Method Is For Require Once All Pages View
     */
    public function views($url, $data = [])
    {
        $url = Model_Main::stringExistsAndValidation($url);
        if ($url !== false) {
            require_once ("views/".$url.".php");
        }else{
            return false;
        }
    }

    /**
     * @param $controllerName
     * @return false
     * This Method Is For Require Once And Call Page Model
     */
    public function getModel($controllerName)
    {
        $controllerName = Model_Main::stringExistsAndValidation($controllerName);
        if ($controllerName !== false)
        {
            require_once ("models/model_".$controllerName.".php");
            $modelName      = "model_".$controllerName;
            $this->models   = new $modelName;
        }else{
            return false;
        }
    }
}
