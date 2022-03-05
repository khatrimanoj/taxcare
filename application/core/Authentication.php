<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication {

    private $_db;

    public function __construct() {
//        parent::__construct();
        $this->CI = & get_instance();
        $this->CI->load->model("MY_model");
        global $db;
        $this->_db = $db;
    }

    public function is_logged_in() {
        global $CURRENT_USER_ROLE, $CURRENT_USER_STATE, $CURRENT_USER_DISTRICT;


        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            // set user role in global variable for first time
            if (!isset($CURRENT_USER_ROLE)) {
                $user = $this->getUser();
                if ($user) {
                    $CURRENT_USER_ROLE = $user['role'];
                    $CURRENT_USER_STATE = $user['State_ID'];
                    $CURRENT_USER_DISTRICT = $user['District_ID'];
                }
            }
            return true;
        }
    }

    /**
     * Get Current user ID
     * @return int
     */
    public function getUserId() {
        if (isset($_SESSION['memberID'])) {
            return $_SESSION['memberID'];
        }
        return 0;
    }

    public function getUser($memeberId = 0) {

        if ($memeberId == 0) {
            // get current password detail
            if (isset($_SESSION['memberID'])) {
                $memeberId = $_SESSION['memberID'];
            }
        }
        $stmt = $this->_db->prepare('SELECT * FROM tbl_admin_login WHERE memberID = :memberID');
        $stmt->execute(array('memberID' => $memeberId));
        $row = $stmt->fetch();
        return $row;
    }

    public function get_user_by_Name($username) {

        try {

            $stmt = $this->_db->prepare('SELECT * FROM tbl_admin_login WHERE username = :username');
            $stmt->execute(array('username' => $username));

            $row = $stmt->fetch();
            return $row;
        } catch (PDOException $e) {
            echo '<p class="error">' . $e->getMessage() . '</p>';
        }
    }

    public function get_user_role($memeberId) {
        $row = $this->getUser($memeberId);
        if ($row) {
            return $row['role'];
        }
    }

    public function _login($username, $password) {

//        showData($this->_db);

        $user_row = $this->get_user_by_Name($username);
        $hashed = $user_row['password'];
        if ($this->password_verify($password, $hashed) == 1) {
            if ($user_row['status'] != 1) {
                error_message('Your Account is Inactive. Please contact to administrator');
                return false;
            }
            if (checkLogin($user_row['memberID'])) {
                $stmt = $this->_db->prepare('UPDATE tbl_admin_login set LastLogin = NOW() WHERE username = :username');
                $stmt->execute(array('username' => $username));
                @ session_regenerate_id(); // regenerate session id
                $_SESSION['loggedin'] = true;
                $_SESSION['memberID'] = $user_row['memberID'];
                afterSuccessfulLogin($user_row['memberID']);
                userTrail($username, 1);
                return true;
            }
        }
        if ($user_row) {
            if (!checkLogin($user_row['memberID'])) {
                $error_msg = 'Your Account is Inactive for 20 minutes . Please try again later.';
                if (isset($_SESSION['block_time'])) {
                    $error_msg = 'Your Account is Inactive . Please try again after ' . $_SESSION['block_time'] . ' minutes.';
                }
                error_message($error_msg);
                userTrail($username, 0);
                return false;
                exit;
            }
        }


        error_message('Wrong username or password!');
        userTrail($username, 0);
    }

    public function hasPermission($permission) {
        global $USER_ROLES_PERMISSIONS, $CURRENT_USER_ROLE;

        if (isset($CURRENT_USER_ROLE)) {
            if ($CURRENT_USER_ROLE == 3 || $CURRENT_USER_ROLE == 4) {
                return true;     // if superadmin  return true
            }
            if (isset($USER_ROLES_PERMISSIONS[$CURRENT_USER_ROLE])) {
                return in_array($permission, $USER_ROLES_PERMISSIONS[$CURRENT_USER_ROLE]);
            }
        }
        return false;
    }

    /**
     *
     * @param type $username
     * @return boolean
     */
    public function isUsernameExist($username, $excludeMemberId = 0) {
        if ($excludeMemberId != 0) {
            $stmt = $this->_db->prepare('SELECT * FROM tbl_admin_login WHERE '
                    . 'username = :username and memberID != :memberID  ');
            $stmt->execute(array('username' => $username, 'memberID' => $excludeMemberId));
        } else {
            $stmt = $this->_db->prepare('SELECT * FROM tbl_admin_login WHERE username = :username');
            $stmt->execute(array('username' => $username));
        }
        $row = $stmt->fetch();
        if ($row) {
            return true;
        }
        return false;
    }

    /**
     *
     * @param type $email
     * @return boolean
     */
    public function isUserEmailExist($email, $excludeMemberId = 0) {
        if ($excludeMemberId != 0) {
            $stmt = $this->_db->prepare('SELECT * FROM tbl_admin_login WHERE '
                    . 'email = :email and memberID != :memberID  ');
            $stmt->execute(array('email' => $email, 'memberID' => $excludeMemberId));
        } else {
            $stmt = $this->_db->prepare('SELECT * FROM tbl_admin_login WHERE email = :email');
            $stmt->execute(array('email' => $email));
        }
        $row = $stmt->fetch();
        if ($row) {
            return true;
        }
        return false;
    }

    public function logout() {
        session_destroy();
    }

    public function password_verify($password, $hash) {
        if (!function_exists('crypt')) {
            trigger_error("Crypt must be loaded for password_verify to function", E_USER_WARNING);
            return false;
        }
        $ret = crypt($password, $hash);
        if (!is_string($ret) || strlen($ret) != strlen($hash) || strlen($ret) <= 13) {
            return false;
        }

        $status = 0;
        for ($i = 0; $i < strlen($ret); $i++) {
            $status |= (ord($ret[$i]) ^ ord($hash[$i]));
        }

        return $status === 0;
    }

    
    public function password_hash($password, $algo, array $options = array()) {
        if (!function_exists('crypt')) {
            trigger_error("Crypt must be loaded for password_hash to function", E_USER_WARNING);
            return null;
        }
        if (!is_string($password)) {
            trigger_error("password_hash(): Password must be a string", E_USER_WARNING);
            return null;
        }
        if (!is_int($algo)) {
            trigger_error("password_hash() expects parameter 2 to be long, " . gettype($algo) . " given", E_USER_WARNING);
            return null;
        }
        switch ($algo) {
            case PASSWORD_BCRYPT :
                // Note that this is a C constant, but not exposed to PHP, so we don't define it here.
                $cost = 10;
                if (isset($options['cost'])) {
                    $cost = $options['cost'];
                    if ($cost < 4 || $cost > 31) {
                        trigger_error(sprintf("password_hash(): Invalid bcrypt cost parameter specified: %d", $cost), E_USER_WARNING);
                        return null;
                    }
                }
                // The length of salt to generate
                $raw_salt_len = 16;
                // The length required in the final serialization
                $required_salt_len = 22;
                $hash_format = sprintf("$2y$%02d$", $cost);
                break;
            default :
                trigger_error(sprintf("password_hash(): Unknown password hashing algorithm: %s", $algo), E_USER_WARNING);
                return null;
        }
        if (isset($options['salt'])) {
            switch (gettype($options['salt'])) {
                case 'NULL' :
                case 'boolean' :
                case 'integer' :
                case 'double' :
                case 'string' :
                    $salt = (string) $options['salt'];
                    break;
                case 'object' :
                    if (method_exists($options['salt'], '__tostring')) {
                        $salt = (string) $options['salt'];
                        break;
                    }
                case 'array' :
                case 'resource' :
                default :
                    trigger_error('password_hash(): Non-string salt parameter supplied', E_USER_WARNING);
                    return null;
            }
            if (strlen($salt) < $required_salt_len) {
                trigger_error(sprintf("password_hash(): Provided salt is too short: %d expecting %d", strlen($salt), $required_salt_len), E_USER_WARNING);
                return null;
            } elseif (0 == preg_match('#^[a-zA-Z0-9./]+$#D', $salt)) {
                $salt = str_replace('+', '.', base64_encode($salt));
            }
        } else {
            $buffer = '';
            $buffer_valid = false;
            if (function_exists('mcrypt_create_iv') && !defined('PHALANGER')) {
                $buffer = @mcrypt_create_iv($raw_salt_len, MCRYPT_DEV_URANDOM);
                if ($buffer) {
                    $buffer_valid = true;
                }
            }
            if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes')) {
                $buffer = openssl_random_pseudo_bytes($raw_salt_len);
                if ($buffer) {
                    $buffer_valid = true;
                }
            }
            if (!$buffer_valid && is_readable('/dev/urandom')) {
                $f = fopen('/dev/urandom', 'r');
                $read = strlen($buffer);
                while ($read < $raw_salt_len) {
                    $buffer .= fread($f, $raw_salt_len - $read);
                    $read = strlen($buffer);
                }
                fclose($f);
                if ($read >= $raw_salt_len) {
                    $buffer_valid = true;
                }
            }
            if (!$buffer_valid || strlen($buffer) < $raw_salt_len) {
                $bl = strlen($buffer);
                for ($i = 0; $i < $raw_salt_len; $i++) {
                    if ($i < $bl) {
                        $buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
                    } else {
                        $buffer .= chr(mt_rand(0, 255));
                    }
                }
            }
            $salt = str_replace('+', '.', base64_encode($buffer));
        }
        $salt = substr($salt, 0, $required_salt_len);

        $hash = $hash_format . $salt;

        $ret = crypt($password, $hash);

        if (!is_string($ret) || strlen($ret) <= 13) {
            return false;
        }

        return $ret;
    }

}
