<?php

class Users extends Model{
  private $_isLoggedIn, $_sessionName, $_cookieName;
  public static $currentLoggedInUser = null;

  public function __construct($user = ''){
    $table = 'users';
    parent::__construct($table);
    $this->_sessionName = CURRENT_USER_SESSION_NAME;
    $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
    $this->_softDelete = true;
    if ($user != '') {
      if (is_int($user)) {
        $u = $this->_db->findFirst('users', ['condition'=>'id = ?', 'bind'=>[$user]]);
      }else{
        $u = $this->_db->findFirst('users', ['condition'=>'username = ?', 'bind'=>[$user]]);
      }
      if ($u) {
        foreach ($u as $key => $value) {
          $this->key = $value;
        }
      }
    }
  }

  public function findByUserName($username){
    return $user = $this->findFirst(['condition'=>'username = ?', 'bind'=>[$username]]);
  }

  public function login($rememberMe = false){
    Session::set($this->_sessionName, $this->id);
    if ($rememberMe) {
      $hash = md5(uniqid() + rand(0, 100));
      $user_agent = Session::uagent_no_version();
      Cookie::set($this->$_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
      $fields = ['session'=>$hash, 'user_agent'=>$user_agent, 'user_id'=>$this->id];
      $this->_db->query("DELETE FROM user_session WHERE user_id = ? AND user_agent = ?, [$this->id, $user_agent]");
      $this->_db->insert('user_session', $field);
    }
  }

  public function logout(){
    $userSession = UserSession::getFromCookie();
    if ($userSession) {
      $userSession->delete();
    }
    $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user->_agent]);
    Session::delete(CURRENT_USER_SESSION_NAME);
    if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)){
      Cookie::delete(REMEMBER_ME_COOKIE_NAME);
    }
    self::$currentLoggedInUser = null;
    return true;
  }

  public function registerNewUser($params){
    $this->assign($params);
    $this->password = password_hash($this->password,PASSWORD_DEFAULT);
    $this->save();
  }

  public static function loginUserFromCookie(){
    $userSession = UserSession::getFromCookie();
    #$user_session_model = new UserSessions();
    #$user_session = $user_session_model->findFirst([
    #  'condition' => "user_agent = ? AND session = ?",
    #  'bind' => [Session::uagent_no_version(),Cookie::get(REMEMBER_ME_COOKIE_NAME)]
    #]);
    if ($user_session->user_id != '') {
      $user = new self($user_session->user_id);
    }
    if ($user) {
      $user->login();
    }

    return $user;
  }

  public static function currentLoggedInUser(){
    if(!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)){
        $u = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
        self::$currentLoggedInUser = $u;
    }
    return self::$currentLoggedInUser;
  }
}
