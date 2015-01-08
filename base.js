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
          console.log("Game reset-ed!");
          $(".messageBox").html("");
          $(".messageBox").hide();
          $("#headerMessage").html("");
          $("#headerMessage").append("Game is now restarted");
      },
      error: function(data) {
        console.log("Something wrong in the reset process!");
      }
    });
  });

//Fetch the data in the form, run "sendHumanInfo" and hide the form 
  $('#startForm').submit(function() {
           
            var humanName = $("#humanName").val();
            var humanClass = $("#charSelectClass").val();
            console.log("newChar name and class: ", humanName, humanClass);
            $("#headerMessage").html("");
            sendHumanInfo(humanName, humanClass);

            $("#startForm").hide();

            return false;
  });

//Send the name and the player-type chosen by the human to the db
  function sendHumanInfo(name, cl) {
    console.log("1 sendHumanInfo log", name,cl);
    $.ajax({
      url: "create.php",
      dataType: "json",
      data: {
        player_name: name,
        player_class: cl
      },
      success: function(data) {
        console.log("Success! Name and class of sendHumanInfo success:", data);
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
    $('.messageBox').append("These are facts about you: <br>");
    for(var key in data) {
          if(data.hasOwnProperty(key)) {
            $(".messageBox").append(key + " : " +data[key]+"<br>");
          }
    }
    challengeOffer();
  }

function challengeOffer() {
  console.log("challengeofferCL");
  $.ajax({
      url: "challenge_pick.php",
      dataType: "json",
      data: {
        challenge: 1,
      },
      success: function(data) {
        $(".messageBox").append("You either accept or change the challenge below! A random change will cost you 5 success-points.<br>"+
                                "You are now offered to do this challenge: <br>"+
                                "<h1>"+data["name"]+"</h1>"+
                                 data["description"]+"<br>"+
                                "<button class = 'acceptCh'>Accept</button><button class='randomCh'>Random change</button>");
        console.log("Data from the success of challengeOffer: ", data);
          
      },
      error: function(data) {
        console.log("Data from the error of challengeOffer: ", data, data.responseText);
      }
  });
}

//When you accept the first challenge offer
$("body").on('click', ".acceptCh", function() {
  console.log("accepted challenge");
  $(".messageBox").html("");
  recieveItem();
});

//When you choose to change to another random challenge
$("body").on('click', ".randomCh", (function() {
  console.log("random challange click");
  $.ajax({
      url: "challenge_pick.php",
      dataType: "json",
      data: {
        challengeChange: 1,
      },
      success: function(data) {
        $(".messageBox").html("This change cost you 5 success-points. <br> Your new challange is: " +
                              "<h1>"+data["name"]+"</h1>"+
                              data["description"]+"<br>"
                              );
        console.log("Data from the success of challengeChange: ", data);
        recieveItem();
      },
      error: function(data) {
        console.log("Data from the error of challengeChange: ", data, data.responseText);
      }
  });
}));

function recieveItem() {
   $('.messageBox').append("You now recieved an item! It adds on to some of your strengths! <br>");
      $.ajax({
        url: "item.php",
        dataType: "json",
        data: {
          plusItem: 1
        },
        success: function(data) {
          console.log("data of recieveItem success:", data);
          for(var key in data) {
            if(data.hasOwnProperty(key)) {
              $(".messageBox").append(key + " : " +data[key]+"<br>");
            }
          }
          $(".messageBox").append("<button class='showEnemies'>Show Enemies</button>");
        },
        error: function(data) {
          console.log("Error in the recieveItem function", data.responseText);
        }
      });
}

  //When clicked, the enemies data shows
  $("body").on('click', ".showEnemies", function() {

      $('.messageBox').html("");
      $('.messageBox').append("You have two competitors in this game: <br>");
      $.ajax({
        url: "create.php",
        dataType: "json",
        data: {
          enemies: 1
        },
        success: function(data) {
          console.log("data of show enemies success:", data);
          printEnemiesData(data);
        },
        error: function(data) {
          console.log("Error in the show enemies function", data.responseText);
        }
      });
      console.log("CL printEnemies");
  });

  function printEnemiesData(data) {
    $(".messageBox").show();
    $('.messageBox').append("These are your competitors: <br><br>");
    for(var key in data) {
          if(data.hasOwnProperty(key)) {
            $(".messageBox").append(key + " : " +data[key]+"<br>");
          }
    }
    $(".messageBox").append("You now choose to do challenge alone or in a team with a competitor."+
                              "Alone causes larger risks of loosing big and winning big.<br>"+
                              "A team-up costs you 5 success-points.<br>"+
                              "<button id='chAlone'>Do challenge alone</button>"+
                              "<button id='chTogether'>Do challenge together with one competitor</button>");
  }

  $("body").on('click', "#chAlone", (function() {
     $('.messageBox').html("");
     $.ajax({
        url: "challenge.php",
        dataType: "json",
        data: {
          DoChallengeAlone: 1
        },
        success: function(data) {
          console.log("success data of on click challenge alone function ajax:", data);
        },
        error: function(data) {
          console.log("error data of on click challenge alone function ajax:", data.responseText);
        }
      });
  }));

    $("body").on('click', "#chTogether", (function() {
      $('.messageBox').html("");
     $.ajax({
        url: "challenge.php",
        dataType: "json",
        data: {
          DoChallengeTogether: 1
        },
        success: function(data) {
          console.log("success data of on click challenge together function ajax:", data.responseText);
        },
        error: function(data) {
          console.log("error data of on click challenge together function ajax:", data.responseText);
        }
      });
  }));


});