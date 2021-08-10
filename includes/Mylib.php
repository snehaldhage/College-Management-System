<?php
class Mylib
{
    private static $obj;
    private $conn;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db_name = 'db_college';
    protected static $dbdriver = 'mysqli';
    //private constructor prevent object formation outside the class using new keyword
    //The db connection is established in the private constructor
    protected function __construct($dbdriver)
    {
        switch ($dbdriver) {
            case 'pdo':
                $this->conn = new PDO("mysql:host={$this->host};
                        dbname={$this->db_name}", $this->user, $this->pass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                break;
            case 'mysqli':
                $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db_name);
                break;
            case 'mongodb':
                /*$db = new Mongo('mongodb://localhost', array(
                'username' => 'abc',
                'password' => 'abc@123',
                'db'       => 'abc'
                ));*/
                break;
            default:
                $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db_name);
        }
    }

    protected function encrypt_decrypt($string, $action = 'ec')
    {
        // ADDED BY Bharat as on 31.10.2018
        $output = false; // to encrypt decrypt string using sha256
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'B3G6D5Dt8S2r09D7C9';
        $secret_iv = '1eSN7G7H6HD5g9N3Z2';
        // hash
        $key = hash('sha256', $secret_key);
        if (!empty($string)) {
            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            if ($action == 'ec') {
                $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                $output = base64_encode($output);
            } else if ($action == 'dc') {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
        } else {
            $output = '';
        }
        return $output;
    }
    public function validate_user($return = false)
    {
        if (!isset($_SESSION['login_id'])) {
            if (!$return) {
                header('Location: ' . self::base_url());
            } else {
                return -1;
            }
        }
    }
    /**
     * A method to return singleton instance of current class
     * @return object
     */
    public static function getInstance()
    {
        if (!isset(self::$obj)) {
            self::$obj = new Mylib(self::$dbdriver);
        }
        return self::$obj;
    }
    /**
     * A method to return db connection
     * @return dbconnection resource
     */
    public function getConnection()
    {
        return $this->conn;
    }

    public function executeQuery($query)
    {
        return mysqli_query($this->conn, $query);
    }
    public function base_url($page = '')
    {
        return __site_url . $page;
    }
    public function insert_data($table, $insert_data, $insert_id = false, $array_new_data = array())
    {
        $value = '';
        $field = '';
        foreach ($insert_data as $column => $val) {
            $value = $value . "'" . $val . "',";
            $field = $field . '`' . $column . "`,";
        }
        foreach ($array_new_data as $column => $v) {
            $value = $value . $v . ",";
            $field = $field . '`' . $column . "`,";
        }
        $field = substr($field, 0, strlen($field) - 1);
        $value = substr($value, 0, strlen($value) - 1);
        $query = "INSERT INTO $table($field) VALUES ($value)";
        $result = self::executeQuery($query);
        if ($insert_id) {
            $result = mysqli_insert_id($this->conn);
        }
        return $result;
    }
    public function update_data($table, $update_data, $where_array, $update_new_data = array())
    {
        $data = '';
        foreach ($update_data as $k => $v) {
            $data = $data . "`" . $k . "`='" . $v . "',";
        }
        foreach ($update_new_data as $k => $v) {
            $data = $data . "`" . $k . "`=" . $v . ",";
        }
        if (is_array($where_array) && !empty($where_array)) {
            $where = '';
            foreach ($where_array as $k => $v) {
                $where = $where . "`" . $k . "`='" . $v . "' AND"; //`id`='1'
            }
            $where = substr($where, 0, strlen($where) - 3);
        } else {
            $where = $where_array;
        }
        $data = substr($data, 0, strlen($data) - 1);
        $query = "UPDATE $table SET $data WHERE $where";
        //echo $query; die;
        return self::executeQuery($query);
    }
    public function delete_data($table, $where)
    {
        $query = "DELETE FROM $table WHERE $where";
        return self::executeQuery($query);
    }

    public function read_data($config)
    {
        $fields = isset($config['fields']) ? $config['fields'] : '*'; //$config['fields'];
        $table = isset($config['table']) ? $config['table'] : $config['table_name'];
        $where = isset($config['where']) ? $config['where'] : null;
        $joins = isset($config['joins']) ? $config['joins'] : null;
        $order = isset($config['order']) ? $config['order'] : null;
        $start = isset($config['start']) ? $config['start'] : '0';
        $limit = isset($config['limit']) ? $config['limit'] : null;
        $group_by = isset($config['group_by']) ? $config['group_by'] : null;
        $distinct = isset($config['distinct']) ? $config['distinct'] : '0';
        $sql = "SELECT $fields FROM `$table` ";
        if ($joins != null) {
            $sql .= " $joins ";
        }
        if ($where != null) {
            $sql .= "WHERE $where";
        }
        //echo $sql; die;
        $query = self::executeQuery($sql);
        return mysqli_fetch_assoc($query);
    }

    public function send_mail($email, $message, $subject)
    {
        /* require_once 'mailer/class.phpmailer.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    // $mail->SMTPSecure = "ssl";
    $mail->Host = "mail.mypetroapp.me";
    $mail->Port = 587; //465;
    $mail->AddAddress($email);
    $mail->Username = "contact@mypetroapp.me";
    $mail->Password = 'qJ7q9~n8Z4$8';
    $mail->SetFrom('contact@mypetroapp.me', 'My Petro App');
    $mail->AddReplyTo("contact@mypetroapp.me", "My Petro App");
    $mail->AddBCC('contact@mypetroapp.me', 'My Petro App');
    $mail->Subject = $subject;
    $mail->MsgHTML($message);
    //$mail->AddAttachment( $file, 'file.zip' );   //to send attachment with email.
    $mail->Send(); */
    }
    public function upload_image($imgname, $dir, $index)
    {
        if ($imgname != '') {
            if (!is_dir($dir)) {
                $imgpath = mkdir($dir, 0777, true);
                $imgpath = $dir . '/';
            } else {
                $imgpath = $dir . '/';
            }
            if ($imgname != '') {
                if (move_uploaded_file($_FILES["$index"]["tmp_name"], "$imgpath" . $imgname)) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function _is_duplicate_entry($table, $check_duplicate)
    {
        $sql = 'SELECT * FROM `' . $table . '` WHERE `is_deleted`="0"';
        $where = ' AND';
        foreach ($check_duplicate as $k => $v) {
            $where = $where . "`" . $k . "`='" . $v . "' AND"; //`id`='1'
        }
        $where = substr($where, 0, strlen($where) - 3);
        $sql .= $where;
        //echo $sql; die;
        $query = self::executeQuery($sql);
        if(mysqli_num_rows($query)>0){
         return false;
        }else{
         return true;
        }
    }

}
