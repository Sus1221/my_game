$(function() {
  
  //Initially hiding this div
  $(".messageBox").hide();

  //When pressing the reset button - the whole game-database empties
  $("body").on('click', ".reset", function() {
    $("#startForm").show();

    $.ajax({
      url:"reset.php",
      dataType: "json",
      data: {
        reset: 1
      },
      success: function(data) {
          $(".messageBox").html("");
          $(".messageBox").hide();
          $("#headerMessage").html("");
          $("#headerMessage").append("<p>Game is now restarted<p>");
      },
      error: function(data) {
      }
    });
  });

  //Fetch the data in the form, run "sendHumanInfo" and hide the form 
  $('#startForm').submit(function() {
           
            var humanName = $("#humanName").val();
            var humanClass = $("#charSelectClass").val();
            $("#headerMessage").html("");
            sendHumanInfo(humanName, humanClass);

            $("#startForm").hide();

            return false;
  });

  //Send the name and the player-type chosen by the human to the db
  function sendHumanInfo(name, cl) {
    $.ajax({
      url: "create.php",
      dataType: "json",
      data: {
        player_name: name,
        player_class: cl
      },
      success: function(data) {
        printHumanInfo(data);
      },
      error: function(data) {
        console.log("Error in the sendHumanInfo function", data.responseText, data);
      }
    });
  }

  //Prints info about the newly created human-player to the screen
  function printHumanInfo(data) {
    $(".messageBox").show();
    $('.messageBox').append("<p>These are facts about you: <p><br>");
    for(var key in data) {
          if(data.hasOwnProperty(key)) {
            $(".messageBox").append("<p>",key + " : " +data[key]+"</p><br>");
          }
    }
    challengeOffer();
  }

  //Requests a random challenge and prints out challenge info and buttons
  function challengeOffer() {
    $.ajax({
        url: "challenge_pick.php",
        dataType: "json",
        data: {
          challenge: 1,
        },
        success: function(data) {
          $(".messageBox").append("<p>You either accept or change the challenge below! A random change will cost you 5 success-points.<br>"+
                                  "You are now offered to do this challenge: </p><br>"+
                                  "<h1>"+data["name"]+"</h1>"+
                                   data["description"]+"<br>"+
                                  "<button class = 'acceptCh'>Accept</button><button class='randomCh'>Random change</button>");
        },
        error: function(data) {
          console.log("Data from the error of challengeOffer: ", data, data.responseText);
        }
    });
  }

  //When you accept the first challenge offer
  $("body").on('click', ".acceptCh", function() {
    $(".messageBox").html("");
    recieveItem();
  });

  //When you choose to change to random challenge
  $("body").on('click', ".randomCh", function() {
    $.ajax({
        url: "challenge_pick.php",
        dataType: "json",
        data: {
          challengeChange: 1,
        },
        success: function(data) {
          $(".messageBox").html("<p>This change cost you 5 success-points. <br> Your new challange is: </p>" +
                                "<h1>"+data["name"]+"</h1>"+
                                "<p>",data["description"]+"</p><br>"
                                );
          recieveItem();
        },
        error: function(data) {
          console.log("Data from the error of challengeChange: ", data, data.responseText);
        }
    });
  });

  //Before every challenge, you recieve a random item
  function recieveItem() {
     $('.messageBox').append("<p>If you had less than three items, you now recieved an item! Items adds on to some of your strengths! </p><br>");
        $.ajax({
          url: "item.php",
          dataType: "json",
          data: {
            plusItem: 1
          },
          success: function(data) {
            if(data.hasOwnProperty("item_name")) {
                for(var key in data) {
                  if(data.hasOwnProperty(key)) {
                    $(".messageBox").append("<p>" + key + " : " +data[key]+"</p><br>");
                  }
                }
            }else {
              $(".messageBox").append("<p>" + data + "</p><br>");
            }
            $(".messageBox").append("<button class='showEnemies'>Show Enemies</button>");
          },
          error: function(data) {
            console.log("Error in the recieveItem function", data.responseText);
          }
        });
  }

  //When this button is clicked, the printEnemiesData-function runs
  $("body").on('click', ".showEnemies", function() {

      $('.messageBox').html("");
      $('.messageBox').append("<p>You have two competitors in this game: </p><br>");
      $.ajax({
        url: "create.php",
        dataType: "json",
        data: {
          enemies: 1
        },
        success: function(data) {
          printEnemiesData(data);
        },
        error: function(data) {
          console.log("Error in the show enemies function", data.responseText);
        }
      });
  });

  //this prints out all enemies data and buttons to the screen
  function printEnemiesData(data) {
    $(".messageBox").show();
    $('.messageBox').append("<p>These are your competitors: <p><br><br>");
    for(var key in data) {
          if(data.hasOwnProperty(key)) {
            $(".messageBox").append("<p>",key + " : " +data[key]+"</p><br>");
          }
    }
    $(".messageBox").append("<p>You now choose to do challenge alone or in a team with a competitor."+
                              "Alone causes larger risks of loosing big and winning big.<br>"+
                              "A team-up costs you 5 success-points.</p><br>"+
                              "<button id='chAlone'>Do challenge alone</button>"+
                              "<button id='chTogether'>Do challenge together with one competitor</button>");
  }

  //When you click the button that chooses to compete alone
  $("body").on('click', "#chAlone", function() {
     $('.messageBox').html("");
     $.ajax({
        url: "challenge.php",
        dataType: "json",
        data: {
          DoChallengeAlone: 1
        },
        success: function(data) {
          $(".messageBox").append("<p>",data," this challenge.</p><br>");
          currentStandings();
        },
        error: function(data) {
          console.log("error data of on click challenge alone function ajax:", data.responseText);
        }
      });
  });

    //When you click the button with the choice of teaming upp with a competitor
    $("body").on('click', "#chTogether", function() {
      $('.messageBox').html("");
      $.ajax({
        url: "challenge.php",
        dataType: "json",
        data: {
          DoChallengeTogether: 1
        },
        success: function(data) {
          $('.messageBox').append(data);
          currentStandings();
        },
        error: function(data) {
          console.log("error data of on click challenge together function ajax:" + data + data.responseText);
        }
      });
    });

    //Requests current standings in the game, and prints it out
    function currentStandings() {
      $.ajax({
        url: "create.php",
        dataType: "json",
        data: {
          currentStandings: 1
        },
        success: function(data) {
          $(".messageBox").append("<h1>Current standings:</h1>");
          for(var key in data) {
            if(data.hasOwnProperty(key)) {
              $(".messageBox").append("<p>",key + " : " +data[key]+"</p><br>");
            }
          }
             //If php tells us someone won the game
            if(data.hasOwnProperty('The game is now over!')){
              $(".messageBox").append("<h1>Feel free to restart game by clicking the button in the header!</h1>");
            //Else request a new challenge
            }else {
              $(".messageBox").append("<button id='nextChTrigger'>On to the next challenge</button>");
            }
        },
        error: function(data) {
          console.log("error data of currentStandings function ajax:", data.responseText);
        }
      });
    }

    //If you click the 'On to the next challenge'-button - run challengeOffer();
    $("body").on('click', "#nextChTrigger", function() {
      $(".messageBox").html("");
      challengeOffer();
    });

});
