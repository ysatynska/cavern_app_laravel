$(function() {
  // $('body').css('background-color', 'lightgray');
  // console.log("black");
  // $("#name").before("<div class=\"select\"> <label for=\"sel\"> Type </label> <br> <label><input name=\"sel\" type=\"radio\" value=\"Burger or Sandwich\"> Burger or Sandwich </label> <br> <label><input name=\"sel\" type=\"radio\" value=\"Wrap\"> Wrap </label></div>");
  // $("#name").before("<div class="row"><div id=\"type\" class=\"form-check\"> <span> Type </span> <br> <label><input name=\"type\" type=\"radio\" value=\"Burger or Sandwich\"> Burger or Sandwich </label> <br> <label><input name=\"type\" type=\"radio\" value=\"Wrap\"> Wrap </label></div> </div>");

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


// const name = document.querySelector("[name=name]")
// const form = document.querySelector("form");

// function handle (event) {
//   const fries = document.querySelector("[name=fries]:checked");
//   if (!name.value || fries == null){
//     event.preventDefault();
//     alert("Please enter you name and choose whether you would like to add fries.");
//   }
// }

// form.addEventListener('submit', handle)

