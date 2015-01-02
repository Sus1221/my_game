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

});