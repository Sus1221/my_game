$(function() {
  
  //Initially hiding this div
  $(".messageBox").hide();

  //When pressing the reset button - the whole game-database empties
  $(".reset").click(function() {
    $("#startForm").show();

    $.ajax({
      url:"reset.php",
      dataType: "json",
      data: {
        reset: 1
      },
      success: function(data) {
          console.log("Game reset-ed!");
          $(".messageBox").hide();
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
  $.ajax({
      url: "challenge.php",
      dataType: "json",
      data: {
        challenge: 1,
      },
      success: function(data) {
        $(".messageBox").append("You either accept or change the challenge below! A random change will cost you 5 success-points.<br>"+
                                "You are now offered to do this challenge: <br>"+
                                "<h1>"+data.name+"</h1>"+
                                 data.description,"<br>"+
                                "<button class = 'acceptCh'>Accept</button><button class='randomCh'>Random change</button>");
        console.log("Data from the success of challengeOffer: ", data);
          
      },
      error: function(data) {
        console.log("Data from the error of challengeOffer: ", data, data.responseText);
      }
  });
}


$("body").on('click', ".acceptCh", function() {
  console.log("accepted");
  $(".messageBox").html("");
  recieveItem();
});

$("body").on('click', ".randomCh", (function() {
  console.log("randomch click");
  $.ajax({
      url: "challenge.php",
      dataType: "json",
      data: {
        challengeChange: 1,
      },
      success: function(data) {
        $(".messageBox").html("This change cost you 5 success-points. <br> Your new challange is: " +
                              "<h1>"+data.name+"</h1>"+
                              data.description+"<br>"
                              );
        console.log("Data from the success of challengeOffer: ", data);
        recieveItem();
      },
      error: function(data) {
        console.log("Data from the error of challengeOffer: ", data, data.responseText);
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
        },
        error: function(data) {
          console.log("Error in the recieveItem function", data.responseText);
        }
      });
}

  function printEnemies(data){
    console.log("CL printEnemies",data);
    $('.messageBox').append("You have two competitors in this game: <br>");
      $.ajax({
        url: "create.php",
        dataType: "json",
        data: {
          enemies: 1
        },
        success: function(data) {
          console.log("data of printEnemies success:", data);
        },
        error: function(data) {
          console.log("Error in the printEnemies function", data.responseText);
        }
      });
  }

  

});
