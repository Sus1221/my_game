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
/*  $('.startForm').submit(function() {
            
            var charType = $('#charSelectValue').val();
            console.log("charType:", charType);

            var newChar = {};
            newChar["name"] = $(".ISBNfound").val();
            newChar["type"] = charType;

              $.ajax({
                url:"libs/sql-ajax-json.php",
                dataType: "json",
                data: {
                  sql: "sql/product-questions.sql",
                  run: "data for report",
                  isbnLog: JSON.stringify(reportInput["isbnLog"]),
                  dateLog: reportInput["dateLog"]

              },
              success: function(data) {
                console.log("Success of submit function!");
                  
                }
              },
              error: function(data) {
                console.log("Something went wrong when submitting a new  human player");
              }
            });
            
            return false;
        });
*/
});