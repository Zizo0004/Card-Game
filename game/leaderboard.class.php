<?php
class storeScore{

  private $storage = "score.json";
 
  private $stored_scores; 
  private $new_score; 
  private $username;
  private $level1Points;
  private $level2Points;
  private $level3Points;
  private $totalScore;
  
  public function __construct($username ,$level1Points , $level2Points ,$level3Points,$totalScore){
  
      $this->stored_scores = json_decode(file_get_contents($this->storage), true);

      $this->level1Points = $level1Points;
      $this->level2Points = $level2Points;
      $this->level3Points = $level3Points;
      $this->totalScore = $totalScore;
      $this->username = $username;
 
      $this->new_score = [
          "username" => $this->username,
          "totalScore" => $this->totalScore,
          "level1Points" => $this->level1Points,
          "level2Points" => $this->level2Points,
          "level3Points" => $this->level3Points,
      ];
    
  
      $this->insertScore();
  }

  private function insertScore(){

      array_push($this->stored_scores, $this->new_score);
     
      if(file_put_contents($this->storage, json_encode($this->stored_scores))) {
     
        header('Location: leaderboard.php');
        
        exit();
       
      } else {
        return $this->error = "Something went wrong, please try again";
      }
     
  }
}

 ?>