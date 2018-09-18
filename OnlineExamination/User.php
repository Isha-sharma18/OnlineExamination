<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
include_once("dbConnection.php");


class User extends DatabaseConnection {    
    
    public function __construct()  
    {
        $this->con = parent::FunctionName();
    }
    /*** for login process ***/

    public function check_login($email, $password){
        
        $query = "SELECT name FROM user WHERE email = '$email' and password = '$password'";
        $result = mysqli_query($this->con, $query);
        $count=mysqli_num_rows($result);
        if($count==1){
            while($row = mysqli_fetch_array($result)) {
	            $name = $row['name'];
            }
            
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            header("location:account.php?q=1");
        }
        else
        header("location:$ref?w=Wrong Username or Password");

    }

    public function getQuiz(){
        
        $query = "SELECT * FROM quiz ORDER BY date DESC";
        $result = mysqli_query($this->con, $query);
        return $result;
    }

    public function getQuestions($eid, $sn){
        
        $query = "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' ";
        $result = mysqli_query($this->con, $query);
        return $result;
    }

    public function getOptions($qid){
        
        $query= "SELECT * FROM options WHERE qid='$qid' ";
        $result = mysqli_query($this->con, $query);
        return $result;
    }

    public function getHistory($eid, $email){
        
        $query=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " );
        $result = mysqli_query($this->con, $query);
        return $result;
    }

    public function getRank($email){
        
        $query="SELECT * FROM rank WHERE  email='$email' ";
        $result = mysqli_query($this->con, $query);
        return $result;
    }

    public function getHistoryFromEmail($email){
        $query="SELECT * FROM history WHERE email='$email' ORDER BY date DESC ";
        $result = mysqli_query($this->con, $query);
        return $result;
    }

    public function getquiz_title($email){
        $query = "SELECT * FROM history WHERE email='$email' ORDER BY date DESC " ;
        $result = mysqli_query($this->con, $query);
        return $result;
    }

   

    public function getscore( $eid, $email){
        $query="SELECT score FROM history WHERE eid='$eid' AND email='$email'";
        $result = mysqli_query($this->con, $query);
        return $result;
    }

    public function getUserFromEmail( $e){
        $query="SELECT * FROM user WHERE email='$e' ";
        $result = mysqli_query($this->con, $query);
        return $result;
    }


}

?>