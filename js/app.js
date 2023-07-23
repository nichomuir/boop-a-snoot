/*
1. on loading the page, populate grid space
2. have "start new game" button:
    -on-click:
    -clear "final score" beneath grid
    -reset timer and score (values and displays)
    -add event listener to all squares
    -populate initial square with snoot
    -begin timer (count down)
3. once time runs out:
    -remove snoot
    -display final score beneath grid
    
game logic:
-have grid with squares
-each square has event listener where on-mousedown:
    -check if id of square clicked matches id of square where snoot is
    -if a match exists, add point to score, move snoot to new square 
	
Most of the JavaScript logic implemented below was taken from the "whac-a-mole" game from the following video: 
https://www.youtube.com/watch?v=ec8vSKJuZTk&list=PLjCj5a9SIi-W8jrk1tQabPSsOgz8y1YD8&index=2&t=5310s&ab_channel=freeCodeCamp.org
*/


//function to populate grid space with grid squares
let populateGrid = function() {
    const grid = document.getElementById("grid");
    let squares = "";
    for (let i = 0; i < 100; i++) {
        squares += '<div class="square" id="' + i +'"></div>';
    }
    grid.innerHTML = squares;
};

populateGrid();

let gameRunning = false;

let startNewGame = function() {
    
    if (gameRunning == false) {
        
    gameRunning = true;
    
    document.getElementById('final-score').innerHTML = "";
    
    //create a list "squares" containing all squares
    const squares = document.querySelectorAll('.square');
    //create "snoot" that can be positioned into a given square
    const snoot = document.querySelectorAll('.snoot');
    const scoreDisplay = document.querySelector('#score-display');
    scoreDisplay.textContent = 0;
    const secondsLeftDisplay = document.querySelector('#timer-display');
    secondsLeftDisplay.textContent = 10;
    
    //stores player score
    let score = 0;
    //stores seconds left in the current round of play
    let secondsLeft = 10;
    //specifies how often the snoot is relocated to a new square
    let countDownTimer = null;
    //stores a random square from the "squares" list
    let randomSquare = null;
    //holds the id of the square that the snoot is currently postioned in
    let snootPosition = null;
    
    //list containing all snoot images
    const snootImages = [
        "<img src=\"images/louie1.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/louie2.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/louie3.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/otis1.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/otis2.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/otis3.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/kobi1.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/kobi2.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/kobi3.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/punchy1.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/punchy2.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/punchy3.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/keiko1.png\" style=\"width:50px;height:50px\">", 
        "<img src=\"images/cheido1.png\" style=\"width:50px;height:50px\">"
    ];
    
    //function to clear current position of snoot and move it to a new square
    let relocateSnoot = function() {
        //iterate through "squares" list and clear current position of snoot
        squares.forEach(square => {
            square.classList.remove('snoot');
        });
        //define random square from "squares" list and move snoot to it
        randomSquare = squares[Math.floor(Math.random() * 100)];
        randomSquare.classList.add('snoot');
        randomSquare.innerHTML = snootImages[Math.floor(Math.random() * snootImages.length)];
        //record current position (i.e. id of the square) that the snoot is in
        snootPosition = randomSquare.id;
    };
    //define initial snoot position
    relocateSnoot();
    
    const controller = new AbortController();
    const { signal } = controller;
    
    //iterate through "squares" list to add Event Listener to every square
    //Event Listener on mousedown will check if id of square clicked on matches the current position of the snoot
    squares.forEach(square => {
        square.addEventListener('mousedown', () => {
            if (square.id == snootPosition) {
                //if id of square clicked on matches the current position of snoot, add point to player score
                score++;
                scoreDisplay.textContent = score;
                randomSquare.innerHTML = "";
                relocateSnoot();
            }
        }, {signal});
    });
    
    //function that updates the timer displayed to the user (indicates to user how many seconds they have left in their current round of play)
    //once the timer reaches 0 seconds, the game is stopped and the player is shown their score
    let countDown = function() {
        secondsLeft--;
        secondsLeftDisplay.textContent = secondsLeft;
    
        if (secondsLeft == 0) {
            controller.abort();
            snootPosition == null;
            randomSquare.innerHTML = "";
            squares.forEach(square => {
                square.classList.remove('snoot');
            });
            clearInterval(countDownTimer);
            document.getElementById("final-score").innerHTML = "Game over! You booped " + score + " snoot(s). Congratulations!";
            fetch('update-score.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: "score=" + score
            });
            gameRunning = false;
        }
    };
    
    countDownTimer = setInterval(countDown, 1000);
    }
};