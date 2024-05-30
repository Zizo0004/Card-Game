<?php include('navbar.php');
if (!isset($_SESSION['username'])) {
   header('Location: index.php');
   exit();
}

$data = file_get_contents('php://input');
if ($data) {
  $formData = json_decode($data, true);
  $level1Points = $formData['level1Points'] ?? 0;
  $level2Points = $formData['level2Points'] ?? 0;
  $level3Points = $formData['level3Points'] ?? 0;

  $totalscore = $level1Points + $level2Points + $level3Points;

  $username = $_SESSION['username'];

  require("leaderboard.class.php");

  $score = new storeScore($username, $level1Points, $level2Points, $level3Points, $totalscore);
}
?>

<style>

.btn:hover{
    color:white!important;

    background-color: 	darkblue !important;

  }
  .max{
    background-color: #FFD700 !important;


  }
.modal{
  background-color: blue; color: #fff; padding: 40px; text-align: center;
}
/* CSS for face, eyes, and mouth */
.face-img {
  width:300px;
  position: relative;
  z-index: 1;
}

.eye-img {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
}

.mouth-img {
  position: absolute;
  bottom: 0;
  top:30%;
  left: 50%;
  transform: translateX(-50%);
    z-index: 2;
}


</style>






<div id="main">

<button id="start-game-btn">Start the game</button>
<div class="wrapper hide">



  </div>


  <script>

document.addEventListener("DOMContentLoaded", function(event) {
  // your JavaScript code goes here
     const wrapper = document.querySelector('.wrapper');



    const startGameBtn = document.getElementById('start-game-btn');




startGameBtn.addEventListener("click", () => {
  var levelNumber = localStorage.getItem('level') || 1;
  var totalscore;
  console.log(levelNumber);
  if(levelNumber == '1winned'){
    var html = '<div  class="modal">' +
              '<h2 style="padding: 10px;">Congratulations!</h2>' +
              '<p style="padding: 30px;">You got ' + localStorage.getItem(`level1_points`) + ' points.</p>' +
              '<p class="msg"></p>' +


              '<button class="btn continue" style="background-color: #fff; color: black; border: none; padding: 10px 20px; margin-right: 10px;" >Continue</button>' +
              '<button class="btn try-again" style="background-color: #fff; color: black; border: none; padding: 10px 20px;">Try Again</button>' +
            '</div>';



  }
  else if(levelNumber == '2winned'){
    var html = '<div class="modal" >' +
              '<h2 style="padding: 10px;">Congratulations!</h2>' +
              '<p style="padding: 30px;">You got ' + localStorage.getItem(`level2_points`) + ' points.</p>' +
              '<p class="msg"></p>' +

              '<button class="btn continue" style="background-color: #fff; color: black; border: none; padding: 10px 20px; margin-right: 10px;">Continue</button>' +
              '<button class="btn try-again" style="background-color: #fff; color: black; border: none; padding: 10px 20px;">Try Again</button>' +
            '</div>';
  }
  else if(levelNumber == '3winned'){
    let level1Points = parseInt(localStorage.getItem('level1_points')) || 0;
let level2Points = parseInt(localStorage.getItem('level2_points')) || 0;
let level3Points = parseInt(localStorage.getItem('level3_points')) || 0;

totalscore = level1Points + level2Points + level3Points;
    var html = '<div class="modal" >' +
              '<h2 style="padding: 10px;">Congratulations!</h2>' +
              '<h2 style="padding: 10px;">Total Score  '+totalscore+'</h2>'+
              '<p style="padding: 30px;">Scores in level one:'+ level1Points+'</p>'+
              '<p style="padding: 30px;">Scores in level two:'+ level2Points+'</p>'+
              '<p style="padding: 30px;">Scores in level three:'+ level3Points+'</p>'+
              '<p class="msg"></p>' +

              '<button class="btn continue" style="background-color: #fff; color: black; border: none; padding: 10px 20px; margin-right: 10px;">Send</button>' +
              '<button class="btn try-again" style="background-color: #fff; color: black; border: none; padding: 10px 20px;">Try Again</button>' +
            '</div>';

  }

 else if(levelNumber == 1){
  var html= '<div class="stats-container"> <h2> level 1</h2><div id="moves-count"></div><div id="time"></div></div><ul class="cards"></ul>';
}
else if(levelNumber == 2){
var html = '<div class="stats-container"><h2>level 2</h2><div id="moves-count"></div><div id="time"></div></div><ul class="cards"></ul>';

}
else if(levelNumber == 3){
  var html = '<div class="stats-container"><h2>level 3</h2><div id="moves-count"></div><div id="time"></div></div><ul class="cards"></ul>';


}


wrapper.innerHTML = html;

const allcards = document.querySelector('.cards')
if(levelNumber == 1){
  var i =0;
  while(i<5){
let  card=  generateCardImage();
allcards.appendChild(card.cloneNode(true));
    allcards.appendChild(card.cloneNode(true));
i++
  }

}
if(levelNumber == 2 ){
  var j =0;
  while(j<4){
    let card =generateCardImage();
    allcards.appendChild(card.cloneNode(true));
    allcards.appendChild(card.cloneNode(true));
    allcards.appendChild(card.cloneNode(true));
j++
  }

}
if(levelNumber == 3){
  var j =0;
  while(j<4){
  let card = generateCardImage()
  allcards.appendChild(card.cloneNode(true));
  allcards.appendChild(card.cloneNode(true));
  allcards.appendChild(card.cloneNode(true));
  allcards.appendChild(card.cloneNode(true));

j++
  }

}


function generateCardImage() {
  // Choose a random mouth, face, and eyes image
  const mouths = ['mouth-1.png', 'mouth-2.png', 'mouth-3.png', 'mouth-4.png', 'mouth-5.png'];
  const faces = ['face-1.png', 'face-2.png', 'face-3.png'];
  const eyes = ['eyes-1.png', 'eyes-2.png', 'eyes-3.png', 'eyes-4.png', 'eyes-5.png', 'eyes-6.png'];
  let mouthLength = mouths.length;
  let faceLength = faces.length;
  let eyeLength = eyes.length;
  const mouth = mouths[Math.floor(Math.random() * mouthLength)];
  const face = faces[Math.floor(Math.random() * faceLength)];
  const eye = eyes[Math.floor(Math.random() * eyeLength)];

  // Create an image tag with the chosen images
  const cardImg = document.createElement('img');
  cardImg.src = 'images/que_icon.svg';
  cardImg.alt = 'card-img';

  const mouthImg = document.createElement('img');
  mouthImg.src = `images/${mouth}`;
  mouthImg.alt = 'mouth-img';
  mouthImg.classList.add('mouth-img');

  const faceImg = document.createElement('img');
  faceImg.src = `images/${face}`;
  faceImg.alt = 'face-img';
  faceImg.classList.add('face-img');

  const eyeImg = document.createElement('img');
  eyeImg.src = `images/${eye}`;
  eyeImg.alt = 'eye-img';
  eyeImg.classList.add('eye-img');

  // Add mouth, face, and eye images on top of the card image
  const frontView = document.createElement('div');
  frontView.classList.add('view', 'back-view');
  const faceContainer = document.createElement('div');
  faceContainer.classList.add('face-container');

  faceContainer.appendChild(faceImg);
  faceContainer.appendChild(mouthImg);
  faceContainer.appendChild(eyeImg);

  frontView.appendChild(faceContainer);

  const backView = document.createElement('div');
  backView.classList.add('view', 'front-view');
  backView.appendChild(cardImg);

  const li = document.createElement('li');
  li.classList.add('card');
  li.appendChild(frontView);
  li.appendChild(backView);

  // Generate class name based on image combination
  const className = `${mouth}_${face}_${eye}_${levelNumber}`;

  // Check if any existing `li` element already has this class name
  const lis = document.querySelectorAll('li');
  const classNames = [];
  lis.forEach((li) => {
    if (li.classList.contains(className)) {
      classNames.push(className);
    }
  });

  // If no existing `li` element has this class name, add it to the current `li` element
  if (classNames.length === 0) {
    li.classList.add(className);
  } else {
    // Otherwise, generate a new image combination and call the `generateCardImage()` function recursively
    return generateCardImage();
  }

  return li;
}


var continueBtn = document.querySelector('.continue');
var tryAgainBtn = document.querySelector('.try-again');
if (continueBtn) {
continueBtn.addEventListener('click', function() {
 if (levelNumber=='1winned'){


  localStorage.setItem('level', 2);

  startGameBtn.click();

 }
else if (levelNumber=='2winned'){
  localStorage.setItem('level', 3);
  startGameBtn.click();


}
else if (levelNumber=='3winned'){
  let level1Points = localStorage.getItem('level1_points') || 0;
let level2Points = localStorage.getItem('level2_points') || 0;
let level3Points = localStorage.getItem('level3_points') || 0;


  let data = {
  level1Points: level1Points,
  level2Points: level2Points,
  level3Points: level3Points
};

fetch('pairs.php', {
  method: 'POST',
  body: JSON.stringify(data)
})
.then(response => response.text())
.then(result => {
  console.log(result);
})
.catch(error => {
  console.error(error);
});

localStorage.clear();

wrapper.classList.add("hide");
    startGameBtn.classList.remove("hide");
}

});
};

if (tryAgainBtn) {
tryAgainBtn.addEventListener('click', function() {
  if(levelNumber== '1winned'){
    localStorage.removeItem('level1_points');
      localStorage.setItem('level', 1);

  startGameBtn.click();

  }

else if(levelNumber== '2winned'){
  localStorage.removeItem('level2_points');
    localStorage.setItem('level', 2);

  startGameBtn.click();

}

else if(levelNumber== '3winned'){
  localStorage.clear();
  localStorage.setItem('level', 1);

  startGameBtn.click();

}

});
}

const cards = document.querySelectorAll(".card");
 let movesCount = 0;
 let  seconds = 0;
 let minutes = 0;

  wrapper.classList.remove("hide");
  startGameBtn.classList.add("hide");

  const moves = document.getElementById("moves-count");
const timeValue = document.getElementById("time");

var time;

var matched = 0;

let cardOne, cardTwo;
let disableDeck = false;
const timeGenerator = () => {
  seconds += 1;
  if (seconds >= 60) {
    minutes += 1;
    seconds = 0;
  }
  let secondsValue = seconds < 10 ? `0${seconds}` : seconds;
  let minutesValue = minutes < 10 ? `0${minutes}` : minutes;
  timeValue.innerHTML = `<span>Time:</span>${minutesValue}:${secondsValue}`;
  time = minutesValue  + secondsValue;

};
//For calculating moves
const movesCounter = () => {
  movesCount += 1;
  moves.innerHTML = `<span>Attempts:</span>${movesCount}`;
  if (movesCount > 15) {
    stop();
  }
};
interval = setInterval(timeGenerator, 1000);
  timeValue.innerHTML = `<span>Time:</span>00:00`;
moves.innerHTML = `<span>Attempts:</span> ${movesCount}`;
var arr;
if(levelNumber == 1){
  arr = new Array(5);
}
else{
  arr = new Array(4);
}

function calculatePoints(level, attempts, timeTaken,matched) {
  const maxPoints = 20;
  const attemptPenalty =2;
  timeTaken = parseInt(timeTaken);
  if(matched != 1){
    actualTime = timeTaken-arr[matched-1];

  }
  else {
    actualTime = timeTaken;


  }
  // console.log(attempts);
  console.log('act'+actualTime);
  const atemptsmaxpoints =10;
  // calculate points based on number of attempts
  let attemptPoints = atemptsmaxpoints - (attempts * attemptPenalty);
  if (attemptPoints < 0) {
    attemptPoints = 0;
  }


  // calculate points based on time taken
  let timePoints = 0;
  if (actualTime <= 5) {
    timePoints = 10;
  } else if (actualTime <= 7) {
    timePoints = 8;
  } else if (actualTime <=9) {
    timePoints = 6;
  } else if (actualTime <= 10) {
    timePoints = 4;
  } else if (actualTime <= 12) {
    timePoints = 2;
  }
  console.log(timePoints);
  console.log(attemptPoints);
  // calculate total points
  let totalPoints = attemptPoints + timePoints;
  if (totalPoints > maxPoints) {
    totalPoints = maxPoints;
  }

  // store points in local storage
  return totalPoints;
}
var currentScore =0;
function updateScores(totalPoints){

 currentScore+=totalPoints;
 console.log('updates'+currentScore);
 return currentScore;

}


function flipCard({target: clickedCard}) {
  if(levelNumber == 1){
    if(cardOne !== clickedCard && !disableDeck) {
        clickedCard.classList.add("flip");
        if(!cardOne) {
            return cardOne = clickedCard;
        }
        cardTwo = clickedCard;
        disableDeck = true;
        let cardOneImg = cardOne.classList[1];
        cardTwoImg = cardTwo.classList[1];
        matchCards(cardOneImg, cardTwoImg);
    }
  }
  else if(levelNumber == 2){
    if(cardOne !== clickedCard && cardTwo !== clickedCard && !disableDeck) {
        clickedCard.classList.add("flip");
        if(!cardOne) {
            return cardOne = clickedCard;
        }
        else if(!cardTwo) {
            return cardTwo = clickedCard;
        }
        cardThree = clickedCard;
        disableDeck = true;
        let cardOneImg =  cardOne.classList[1];
        cardTwoImg = cardTwo.classList[1];
        cardThreeImg = cardThree.classList[1];
        matchCards(cardOneImg, cardTwoImg, cardThreeImg);
    }
  }
  else if(levelNumber == 3){
    if(cardOne !== clickedCard && cardTwo !== clickedCard && cardThree !== clickedCard && !disableDeck) {
        clickedCard.classList.add("flip");
        if(!cardOne) {
            return cardOne = clickedCard;
        }
        else if(!cardTwo) {
            return cardTwo = clickedCard;
        }
        else if(!cardThree) {
            return cardThree = clickedCard;
        }
        cardFour = clickedCard;
        disableDeck = true;
        let cardOneImg = cardOne.classList[1];
        cardTwoImg = cardTwo.classList[1];
        cardThreeImg = cardThree.classList[1];
        cardFourImg = cardFour.classList[1];
        matchCards(cardOneImg, cardTwoImg, cardThreeImg, cardFourImg);
    }
  }
}



if(levelNumber == 1){
function matchCards(img1, img2) {
    if(img1 === img2) {
        matched++;

        arr[matched]=time;
       let points =calculatePoints(levelNumber, movesCount, time,matched);
       let updatedpoints =updateScores(points);

        fetch('score.json')

.then(response => response.json())
  .then(data => {
    if (data.length > 0) {
    let scores = data;

    let prevBestScore = Math.max(...scores.map(score => score.level1Points));

  let userScore =  updatedpoints;

  if ( updatedpoints > prevBestScore) {
    divElement=   document.querySelector('.cards');
divElement.classList.add('max');

  }
    }
});

        if (matched == 5 && levelNumber == 1) {
          localStorage.setItem(`level${levelNumber}_points`, updatedpoints);


localStorage.setItem('level', '1winned');

setTimeout(() => {
  startGameBtn.click();
}, 300);


              }


        cardOne.removeEventListener("click", flipCard);
        cardTwo.removeEventListener("click", flipCard);
        cardOne = cardTwo = "";
      return disableDeck = false;
    }
    setTimeout(() => {
        cardOne.classList.add("shake");
        cardTwo.classList.add("shake");
    }, 400);

    setTimeout(() => {
        cardOne.classList.remove("shake", "flip");
        cardTwo.classList.remove("shake", "flip");
        cardOne = cardTwo = "";
        disableDeck = false;
    }, 1200);
    movesCounter();
}}
if(levelNumber == 2){
  function matchCards(img1, img2 ,img3) {

    if (img1 === img2 && img1 === img3) {
        matched++;
        arr[matched]=time;
       let points =calculatePoints(levelNumber, movesCount, time,matched);
       let updatedpoints =updateScores(points);

        fetch('score.json')

.then(response => response.json())
  .then(data => {
    if (data.length > 0) {
    let scores = data;
    let prevBestScore = Math.max(...scores.map(score => score.level2Points));

  let userScore =  updatedpoints;

  if ( updatedpoints > prevBestScore) {
    divElement=   document.querySelector('.cards');
divElement.classList.add('max');

  }
}

});


           if (matched == 4 && levelNumber == 2) {
            localStorage.setItem(`level${levelNumber}_points`, updatedpoints);


                localStorage.setItem('level', '2winned');
                setTimeout(() => {
  startGameBtn.click();
}, 500);

              }



        cardOne.removeEventListener("click", flipCard);
        cardTwo.removeEventListener("click", flipCard);
        cardThree.removeEventListener("click", flipCard);
        cardOne = cardTwo =cardThree= "";
      return disableDeck = false;
    }
    setTimeout(() => {
        cardOne.classList.add("shake");
        cardTwo.classList.add("shake");
        cardThree.classList.add("shake");
    }, 400);

    setTimeout(() => {
        cardOne.classList.remove("shake", "flip");
        cardTwo.classList.remove("shake", "flip");
        cardThree.classList.remove("shake", "flip");

        cardOne = cardTwo =cardThree= "";
        disableDeck = false;
    }, 1200);
    movesCounter();
}
}
if(levelNumber == 3){
  function matchCards(img1, img2 ,img3 ,img4) {
    if(img1 === img2 && img2 === img3 && img3 === img4) {
              matched++;
              arr[matched]=time;
       let points =calculatePoints(levelNumber, movesCount, time,matched);
       let updatedpoints =updateScores(points);

        fetch('score.json')

.then(response => response.json())
  .then(data => {
    if (data.length > 0) {
    let scores = data;
    let prevBestScore = Math.max(...scores.map(score => score.level3Points));

  let userScore =  updatedpoints;

  if ( updatedpoints > prevBestScore) {
    divElement=   document.querySelector('.cards');
divElement.classList.add('max');

  }
    }
});

           if (matched == 4 && levelNumber == 3) {
                calculatePoints(levelNumber, movesCount, time);


                localStorage.setItem('level', '3winned');
                setTimeout(() => {
  startGameBtn.click();
}, 300);

              }



        cardOne.removeEventListener("click", flipCard);
        cardTwo.removeEventListener("click", flipCard);
        cardThree.removeEventListener("click", flipCard);
        cardFour.removeEventListener("click", flipCard);
        cardOne = cardTwo = cardThree = cardFour= "";
      return disableDeck = false;
    }
    setTimeout(() => {
        cardOne.classList.add("shake");
        cardTwo.classList.add("shake");
        cardThree.classList.add("shake");
        cardFour.classList.add("shake");
    }, 400);

    setTimeout(() => {
        cardOne.classList.remove("shake", "flip");
        cardTwo.classList.remove("shake", "flip");
        cardThree.classList.remove("shake", "flip");
        cardFour.classList.remove("shake", "flip");


        cardOne = cardTwo = cardThree = cardFour= "";
        disableDeck = false;
    }, 1200);
    movesCounter();
}
}


shuffleCard();

cards.forEach(card => {
    card.addEventListener("click", flipCard);
});




function shuffleCard() {
    matched = 0;
    disableDeck = false;
    const ul = document.querySelector('.cards');
const liArray = Array.from(ul.children);
    const shuffledArray = shuffleArray(liArray);
    ul.innerHTML = '';
for (const li of shuffledArray) {
  console.log(li);
  ul.appendChild(li);
}


    if(levelNumber == 1){
      cardOne = cardTwo = "";

    }
    if(levelNumber == 2){
      cardOne = cardTwo = cardThree ="";

    }
    if(levelNumber == 3){
      cardOne = cardTwo = cardThree = cardFour= "";


    }
    cards.forEach((card, i) => {
        card.classList.remove("flip");

        card.addEventListener("click", flipCard);
    });
}


shuffleCard();
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

cards.forEach(card => {
    card.addEventListener("click", flipCard);
});



});
function stop(){
    clearInterval(interval);
    localStorage.clear();

     wrapper.innerHTML  = '<div style="background-color: blue; color: #fff; padding: 40px; text-align: center;">' +
              '<h2 style="padding: 10px;">Oops!</h2>' +
              '<p style="padding: 30px;">Game Over!  Attempts exceeded than 15</p>' +
              '<button id ="colse" class="btn" style="background-color: #fff; color: #007bff; border: none; padding: 10px 20px; margin-right: 10px;">Close</button>' +
              '<button id="try-again" class="btn" style="background-color: #fff; color: #007bff; border: none; padding: 10px 20px;">Try Again</button>' +
            '</div>';
      document.getElementById("try-again").addEventListener("click", function() {
        startGameBtn.click();

      });
      document.getElementById("colse").addEventListener("click", function() {

    wrapper.classList.add("hide");
    startGameBtn.classList.remove("hide");
});

};


});



  </script>

