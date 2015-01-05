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
    console.log("1sendHumanInfo log", name,cl);
    $.ajax({
      url: "create.php",
      dataType: "json",
      data: {
        player_name: name,
        player_class: cl
      },
      success: function(data) {
        console.log("Name and class of sendHumanInfo success:", data);
        for(var i in data) {
          console.log("Looping the data: ", data[i]);
        }
        //challengeOffer(name, cl);
      },
      error: function(data) {
        console.log("Error in the sendHumanInfo function", data.responseText);
      }
    });
  }

  function challengeOffer(name,cl) {
    console.log("This is the console log from challengeOffer", name, cl);
    $(".messageBox").show();
    $(".messageBox").append("Hello ", name, ". You are now registered as a ",cl, ". These are your strength levels: ");

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
        console.log("Data from the error of challengeOffer: ", data);
      }
    });

    $(".messageBox").append("You are now offered to do this challenge: <br>");

    $.ajax({
      url: "challenge.php",
      dataType: "json",
      data: {
        challenge: 1,
      },
      success: function(data) {
        console.log("Data from the success of challengeOffer: ", data);
        $(".messageBox").append(data);
      },
      error: function(data) {
        console.log("Data from the error of challengeOffer: ", data);
      }
    });



    $(".messageBox").append("You either accept or change challenge. A change will cost you 5 success-points.");


  }

});
