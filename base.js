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
    console.log("sendHumanInfo log", name,cl);
    $.ajax({
      url: "create.php",
      dataType: "json",
      data: {
        player_name: name,
        player_class: cl
      },
      success: function(data) {
        console.log("Name and class of sendHumanInfo success:", data);
        challengeOffer(name,cl);
      },
      error: function() {
        console.log("Error in the sendHumanInfo function");
      }
    });
  }

  function challengeOffer(name,cl) {
    console.log("This is the console log from challengeOffer", name, cl);
    $(".messageBox").show();
    $(".messageBox").append("Hello", name, "You are now registered as a",cl);

  }

});
