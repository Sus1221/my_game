$(function() {
  
  $(".messageBox").hide();

  $(".reset").click(function() {
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

//To send the data entered in the form to the db
  $('#startForm').submit(function() {
           
            var humanName = $("#humanName").val();
            var humanClass = $("#charSelectClass").val();
            console.log("newChar name and class: ", humanName, humanClass);

            sendHumanInfo(humanName, humanClass);

            return false;
        });

  function sendHumanInfo(name, cl) {
    console.log("sendHumanInfo log",name,cl);
    $.ajax({
      url: "connect.php",
      dataType: "json",
      data: {
        player_name: name,
        player_class: cl
      },
      success: function() {console.log("Name and class of sendHumanInfo success:", name, cl)},
      error: function() {console.log("Error in the sendHumanInfo function")}

    });
  }

});
