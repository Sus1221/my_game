$(function() {
  
  $(".messageBox").hide();

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
        console.log("Name and class of sendHumanInfo success:", data);
        printHumanInfo(data);
      },
      error: function(data) {
        console.log("Error in the sendHumanInfo function", data.responseText, data);
      }
    });
  }

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

function challengeOffer(name,cl) {
    console.log("This is the console log from challengeOffer", name, cl);

    $.ajax({
      url: "create.php",
      dataType: "json",
      data: {
        challenge: 1,
      },
      success: function(data) {
        console.log("Data from the success of challengeOffer: ", data);
        $(".messageBox").append(data);
      },
      error: function(data) {
        console.log("Data from the error of challengeOffer: ", data, data.responseText);
      }
    });

    $(".messageBox").append("You are now offered to do this challenge: <br>");

    $(".messageBox").append("You either accept or change challenge. A random change will cost you 5 success-points.<br>",
                            "<button class = 'acceptCh'>Accept</button><button class='randomCh'>Random change</button>");
    /*printEnemies();*/


  }

  function printEnemies(data) {
    $('.messageBox').append("You have two competitors in this game: <br>");
        $.ajax({
      url: "create.php",
      dataType: "json",
      data: {
        enemies: 1
      },
      success: function(data) {
        console.log("data of print success:", data.responseText);
      },
      error: function(data) {
        console.log("Error in the printEnemies function", data.responseText);
      }
    });
  }

  

});
