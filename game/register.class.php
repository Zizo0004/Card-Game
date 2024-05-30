<?php
class RegisterUser{
   // class properties.
   private $username;
   public $error;
   public $success;
   private $storage = "registered.json";
   private $stored_users; 
   private $new_user; 
   private $selectedEmoji;
   public function __construct($username ,$selectedEmoji){
    $this->username = filter_var(trim($username), FILTER_SANITIZE_STRING);
    $this->selectedEmoji = $selectedEmoji;
    $this->stored_users = json_decode(file_get_contents($this->storage), true);
    $this->new_user = [
       "username" => $this->username,
       "emoji" => $this->selectedEmoji,
    ];
    if($this->checkFieldValues()){
        $this->insertUser();
     }
   
    
 }
 private function checkFieldValues(){
   $invalid_chars = '/[!@#%&*()+=^{}\[\]\-;:\'\"<>?\/]/';
   if(empty($this->username)){
       $this->error = "Username is required.";
       return false;
   }elseif(preg_match($invalid_chars, $this->username)){
       $this->error = "Username contains invalid characters, please choose a different one.";
       return false;
   }else{
       return true;
   }
}
 private function usernameExists(){
    foreach ($this->stored_users as $user) {
       if($this->username == $user['username']){
       

          $this->error = "Username already taken, please choose a different one.";
          return true;
       }
       
    }
    return false;
 }
 private function insertUser(){

    if($this->usernameExists() == FALSE){
     

       array_push($this->stored_users, $this->new_user);
       if(file_put_contents($this->storage, json_encode($this->stored_users))){
         session_destroy();
         session_unset();
        session_start(); 
     

        $_SESSION['username'] = $this->username;
        $_SESSION['emoji'] = $this->selectedEmoji;
      

        header('Location: index.php');
        exit();
       }else{
     
          return $this->error = "Something went wrong, please try again";
       }
    }
 }
}
?>
