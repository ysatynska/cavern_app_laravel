$(function() {
    // $('body').css('background-color', 'lightgray');
    // console.log("black");
    // $("#name").before("<div class=\"select\"> <label for=\"sel\"> Type </label> <br> <label><input name=\"sel\" type=\"radio\" value=\"Burger or Sandwich\"> Burger or Sandwich </label> <br> <label><input name=\"sel\" type=\"radio\" value=\"Wrap\"> Wrap </label></div>");
    // $("#name").before("<div class="row"><div id=\"type\" class=\"form-check\"> <span> Type </span> <br> <label><input name=\"type\" type=\"radio\" value=\"Burger or Sandwich\"> Burger or Sandwich </label> <br> <label><input name=\"type\" type=\"radio\" value=\"Wrap\"> Wrap </label></div> </div>");

    $("input[name='entree_type']")


    $("input[value='Burger or Sandwich']").click(function(){
      $.each($("#entree option[class*='Wrap']"), function (index, value){
        $(this).css("display", "none");
      })
      $.each($("#entree option[class ='Burger or Sandwich']"), function (index, value){
        $(this).css("display", "initial");
      })
      $(".orderForm").css("visibility", "visible");
      console.log("Burger")
    })

    $("input[value='Wrap']").click(function(){
      $.each($("#entree option[class*='Wrap']"), function (index, value){
        $(this).css("display", "initial");
      })
      $.each($("#entree option[class ='Burger or Sandwich']"), function (index, value){
        $(this).css("display", "none");
      })
      $(".orderForm").css("visibility", "visible");
    })
  });
