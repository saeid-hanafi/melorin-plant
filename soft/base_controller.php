<?php
/**
 * Class Base_Controller
 * This Controller Get Controller Names And Method Names And Run Theme
 */
class Base_Controller
{
    /**
     * @var string $controller Page Controller Name
     * @var string $method Controller Method Name And Model Name
     * @var string $PATH Controller Directory Address
     * @var object $object For Create Controller Object
     * @var array|mixed $args Controller Method Arguments
     */
    private $controller = "index";
    private $method     = "index";
    private $PATH       = "controllers/";
    private $object     = "";
    private $args       = [];

    /**
     * Base_Controller constructor.
     * Get Controller Name And Method Name And Its Arguments
     */
    public function __construct()
    {
        if (isset($_GET["param"]) && $this->checkInputs($_GET["param"]))
        {
            $param = $_GET["param"];
            if (stripos($param, "/"))
            {
                $paramArray = $this->explodeURL($param);
                if ($this->checkInputs($paramArray[0])) {
                    $controllerVal = $this->stringExistsAndValidation($paramArray[0]);
                    if ($controllerVal !== false) {
                       $this->controller = $controllerVal;
                    }
                    unset($paramArray[0]);
                }

                if ($this->checkInputs($paramArray[1])) {
                    $methodVal = $this->stringExistsAndValidation($paramArray[1]);
                    if ($methodVal !== false) {
                        $this->method = $methodVal;
                    }
                    unset($paramArray[1]);
                }

                if ($this->checkInputs($paramArray[2])) {
                    $this->args = $this->cleanArray($paramArray);
                }
            }else{
                $param = $this->stringExistsAndValidation($param);
                if ($param !== false) {
                    $this->controller = $param;
                }
            }
        }
        $this->PATH .= $this->controller . ".php";
        $this->methodLoader();
    }

    /**
     * @param $data
     * @return string
     * This Method Validate Data And Convert This To String
     */
    private function inputValidation($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data, ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5, "UTF-8", true);
        if (isset($data) && $data !== false && !empty($data) && strlen($data) > 0) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * @param $string
     * @return false|string
     * This Method Check That A String Is Valid Or Not And Exists Or Not
     */
    private function stringExistsAndValidation($string)
    {
        $string = $this->inputValidation($string);
        if (isset($string) && $string !== false && !empty($string) && strlen($string) > 0) {
            return $string;
        } else {
            return false;
        }
    }

    /**
     * @param $URL
     * @return false|string[]
     * This Method Explode URL And Change To Array By "/" Separator
     */
    private function explodeURL($URL) {
        return explode("/", $URL);
    }

    /**
     * @param $var
     * @return bool
     * This Method Check Input Exists
     */
    private function checkInputs($var)
    {
        if (isset($var) && !empty($var) && $var !== false && $var != "index.php") {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param array $array
     * @return array|mixed
     * This Method Clean Array Keys
     */
    private function cleanArray($array = []) {
        return array_values($array);
    }

    /**
     * @return mixed
     * This Method Require Once Controller File
     */
    private function requireControllerPath() {
        require_once ($this->PATH);
    }

    /**
     * This Method Create Controller Object
     */
    private function getObject() {
        $this->object = new $this->controller;
    }

    /**
     * @return false
     * This Method Call GetModel Method From Main Controller
     */
    private function getModelCallBack()
    {
        if (method_exists($this->object, "getModel")) {
            $this->object->getModel($this->controller);
        }else{
            return false;
        }
    }

    /**
     * @return bool
     * This Method Check Controller File Exists
     */
    private function validateFileName()
    {
        if (file_exists($this->PATH))
        {
            $this->requireControllerPath();
            $this->getObject();
            $this->getModelCallBack();
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool
     * This Method Check Controller Method Exists
     */
    private function validateMethod()
    {
        if (method_exists($this->object, $this->method)) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return false
     * This Method Load Controller For Load Pages
     */
    private function methodLoader()
    {
        if ($this->validateFileName() !== false && $this->validateMethod() !== false) {
            call_user_func_array([$this->object, $this->method], $this->args);
        }else{
            return false;
        }
    }
}
