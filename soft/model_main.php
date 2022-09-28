<?php
class Model_Main
{
    /**
     * @var mixed|string
     * @var $host string Host Name And Default Is Localhost
     * @var $dbName string DataBase Name And Default Is DB_php_unique
     * @var $username string DataBase's User Name
     * @var $dbPassword string DataBase's Password
     */
    private $host;
    private $dbName;
    private $username;
    private $dbPassword;

    /**
     * Model_Main constructor.
     * @param string $host
     * @param string $dbName
     * @param string $username
     * @param string $dbPassword
     */
    public function __construct($host = HOST, $dbName = DB_NAME, $username = USERNAME, $dbPassword = DB_PASSWORD)
    {
        $host       = self::stringExistsAndValidation($host);
        $dbName     = self::stringExistsAndValidation($dbName);
        $username   = self::stringExistsAndValidation($username);
        if ($host !== false && $dbName !== false && $username !== false && $dbPassword !== false)
        {
            $this->host         = $host;
            $this->dbName       = $dbName;
            $this->username     = $username;
            $this->dbPassword   = $dbPassword;
        }
    }

    /**
     * @param $data
     * @return string
     * This Method Validate Data And Convert This To String
     */
    public static function inputValidation($data)
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
    public static function stringExistsAndValidation($string)
    {
        $string = self::inputValidation($string);
        if (isset($string) && $string !== false && !empty($string) && strlen($string) > 0) {
            return $string;
        } else {
            return false;
        }
    }

    /**
     * @param $num
     * @param false $def
     * @return false|int
     * This Method Is For Validation Integers
     */
    public static function isIntValidation($num, $def = false)
    {
        if (isset($num) && is_numeric($num)) {
            return filter_var((int)$num, FILTER_VALIDATE_INT);
        } else {
            if (isset($def) && is_numeric($def)) {
                return filter_var((int)$def, FILTER_VALIDATE_INT);
            } else {
                return false;
            }
        }
    }

    /**
     * @param $int
     * @param false $zero
     * @return false|int
     * This Method Check That The Integer Is Valid Or Not And Exists Or Not
     * If $zero Be False The Integer Should Be Bigger Than Zero, If $zero Be true The Integer Can Be Any Numbers
     */
    public static function intExistsAndValidation($int, $zero = false)
    {
        $int = self::isIntValidation($int);
        if ((isset($int) && $int !== false && !empty($int)) || ($int === 0)) {
            if ($zero === false) {
                if ($int > 0) {
                    return $int;
                } else {
                    return false;
                }
            } elseif ($zero === true) {
                return $int;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $array
     * @return array|false
     * This Method Check That The Array Be Exists
     */
    public static function arrayExists($array)
    {
        if (isset($array) && $array !== false && is_array($array) && count($array) > 0) {
            return $array;
        } else {
            return false;
        }
    }

    /**
     * @param $data
     * @return string
     * This Method Encode Html Codes For Security
     */
    public static function htmlEncodeValidation($data): string
    {
        $data = trim($data);
        $data = htmlspecialchars($data, ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5, "UTF-8", true);
        $data = htmlentities($data, ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5, "UTF-8", true);
        return $data;
    }

    /**
     * @param $data
     * @return string
     * This Method Decode Html Codes After Encoding
     */
    public static function htmlDecodeValidation($data): string
    {
        $data = html_entity_decode($data, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8");
        $data = htmlspecialchars_decode($data, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
        return $data;
    }

    /**
     * @param array $array
     * @return array|false
     * This Method Validate Integer Values Of Array
     */
    public static function validateIntValueArray($array = [])
    {
        $result = [];
        if (isset($array) && is_array($array) && count($array) > 0 && $array != false && !empty($array)) {
            foreach ($array as $key => $value) {
                $value = self::intExistsAndValidation($value);
                if ($value !== false) {
                    $result[$key] = $value;
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param array $array
     * @return array|false
     * This Method Validate String Values Of Array
     */
    public static function validateStringValueArray($array = [])
    {
        $result = [];
        if (isset($array) && is_array($array) && count($array) > 0 && $array != false && !empty($array)) {
            foreach ($array as $key => $value) {
                $value = self::stringExistsAndValidation($value);
                if ($value !== false) {
                    $result[$key] = $value;
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @return PDO
     * This Method Connect To DataBase
     */
    protected function connect(): PDO
    {
        $connection = false;
        $dsn        = "mysql:host=".$this->host.";dbname=".$this->dbName.";";
        $options    = [
            PDO::ATTR_PERSISTENT            => true,
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES UTF8",
        ];

        try {
            $connection = new PDO($dsn, $this->username, $this->dbPassword, $options);
            return $connection;
        }catch (PDOException $errException) {
            echo $errException->getMessage();
        }
    }

    /**
     * @param $connect
     * This Method DisConnect From DataBase
     */
    protected function disconnect($connect)
    {
        unset($connect);
    }

    /**
     * @param $query
     * @param array $param
     * @param false $fetch
     * @param param $fetchMode
     * @return array|false|mixed
     * This Method Select Rows From DataBase By Special Queries
     */
    public static function selectDBRows($query, $param = [], $fetch = false, $fetchMode = PDO::FETCH_ASSOC)
    {
        $finalRes       = false;
        $connectClass   = new Model_Main();
        $connect        = $connectClass->connect();
        $response       = $connect->prepare($query);

        if (isset($param) && is_array($param) && count($param) > 0)
        {
            foreach ($param as $key => $value) {
                $key = self::intExistsAndValidation($key, true);
                if ($key !== false) {
                    $response->bindValue($key + 1, $value);
                }
            }
        }

        $result = $response->execute();
        if ($response->rowCount() > 0 && isset($result) && $result !== false && !empty($result))
        {
            if ($fetch === false) {
                $finalRes = $response->fetchAll($fetchMode);
            }else{
                $finalRes = $response->fetch($fetchMode);
            }
        }else{
            $finalRes = false;
            $connectClass->disconnect($connect);
        }
        return $finalRes;
    }

    /**
     * @param $query
     * @param array $param
     * @return bool
     * This Method Insert Rows On The DataBase
     */
    public static function dataBaseActions($query, $param = []): bool
    {
        $connectClass   = new Model_Main();
        $connect        = $connectClass->connect();
        $response       = $connect->prepare($query);

        if (isset($param) && is_array($param) && count($param) > 0)
        {
            foreach ($param as $key => $value) {
                $key = self::intExistsAndValidation($key, true);
                if ($key !== false) {
                    $response->bindValue($key + 1, $value);
                }
            }
        }

        $result = $response->execute();
        if (isset($result) && $result !== false && !empty($result) && $response->rowCount() > 0) {
            return true;
        }else{
            $connectClass->disconnect($connect);
            return false;
        }
    }

    /**
     * This Method Load 404 Page
     */
    public static function notFoundPageLoader()
    {
        http_response_code(404);
        require_once ("views/notFound/index.php");
        die();
    }

    /**
     * @param $pageName
     * @param string $pageStatus
     * @return array|false|mixed
     * This Method Select All Information Of Pages By Page Name And Page Status From DataBase
     */
    public function getPagesInfo($pageName, $pageStatus = "publish")
    {
        $pageName   = self::stringExistsAndValidation($pageName);
        $pageStatus = self::stringExistsAndValidation($pageStatus);
        if ($pageName !== false && $pageStatus !== false)
        {
            $query = "SELECT * FROM `pages_info` WHERE `pageStatus` = ? AND `pageName` = ?";
            return self::selectDBRows($query, [$pageStatus, $pageName], true);
        }else{
            return false;
        }
    }

    /**
     * @return array|false|mixed
     * This Method Select Top Menu Information From DataBase
     */
    public function getTopMenu()
    {
        $query = "SELECT * FROM `main_menu_Info` WHERE `menuStatus` = ? ORDER BY `menuOrder` ASC";
        return self::selectDBRows($query, [1]);
    }

    /**
     * @param $settingName
     * @param string $settingDes
     * @return array|false
     * This Method Select Admin Setting Information From DataBase By Setting Name And Description
     */
    public function getAdminSettingInfo($settingName, $settingDes = "")
    {
        $settingName    = self::stringExistsAndValidation($settingName);
        $settingDes     = self::stringExistsAndValidation($settingDes);
        if ($settingName !== false && $settingDes === false) {
            $query = "SELECT * FROM `admin_setting_table` WHERE `setting_name` = ? AND `setting_status` = ?";
            return self::arrayExists(self::selectDBRows($query, [$settingName, 1], true));
        }elseif ($settingName !== false && $settingDes !== false) {
            $query = "SELECT * FROM `admin_setting_table` WHERE `setting_name` = ? AND `setting_des` = ? AND `setting_status` = ?";
            return self::arrayExists(self::selectDBRows($query, [$settingName, $settingDes, 1], true));
        }else{
            return false;
        }
    }

    /**
     * @param $mediaID
     * @return array|false
     * This Method Select Media All Information From DataBase By ID
     */
    public static function getMediaInfoByID($mediaID)
    {
        $mediaID = Model_Main::intExistsAndValidation($mediaID);
        if ($mediaID !== false) {
            $query = "SELECT * FROM `media_info_table` WHERE `media_id` = ? AND `media_status` = ?";
            return self::arrayExists(self::selectDBRows($query, [$mediaID, 1], true));
        }else{
            return false;
        }
    }

    /**
     * @param $mediaIDsArray
     * @return array|false
     * This method Get Media information By A Array Of IDs From DataBase
     */
    public static function getMediaInfoByIDsArray($mediaIDsArray)
    {
        $mediaIDsArray = self::arrayExists(self::validateIntValueArray($mediaIDsArray));
        if ($mediaIDsArray !== false) {
            $mediaIDs   = implode(",", $mediaIDsArray);
            $query      = "SELECT * FROM `media_info_table` WHERE `media_status` = ? AND `media_id` IN ({$mediaIDs})";
            return self::arrayExists(self::selectDBRows($query, [1]));
        }else{
            return false;
        }
    }

    /**
     * @return array
     * This Method Get Products Slides Information From DataBase
     */
    public function getProductsSliderSlidesID()
    {
        $finalRes   = [];
        $query      = "SELECT `link_url`, `img_id` FROM `products_slider_slides` WHERE `slide_status` = ? ORDER BY `slide_id` DESC";
        $result     = self::arrayExists(self::selectDBRows($query, [1]));
        if ($result !== false) {
            $key = 0;
            foreach ($result as $item)
            {
                $link_url   = self::stringExistsAndValidation(filter_var($item["link_url"], FILTER_VALIDATE_URL));
                $imgID      = self::intExistsAndValidation($item["img_id"]);
                if ($imgID !== false && $link_url !== false) {
                    $finalRes[$key]["link_url"] = $link_url;
                    $finalRes[$key]["img_id"]   = $imgID;
                }
                $key++;
            }
        }
        return $finalRes;
    }
}