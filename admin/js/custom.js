/*function msgId(id)
{
    alert(id);
}*/

$(document).ready(function () {
    
  /*$(body).everyTime(3000,function(i){
    $.ajax({
       url: "chatx.php",
       cache: false,
       success: function(updated){
           alert("ok");
       }
   });
   })*/

  $("body").on("hidden.bs.modal", ".modal", function () {
    //alert("okkkkkkk");
    $(this).removeData("bs.modal");
    $("#todate").datepicker({ format: "yyyy-mm-dd", autoclose: true });
  });

  $('[data-toggle="tooltip"]').tooltip();
});
// $("#select_all").on('change','input[id="select_all"]',function() {
//     $('.chk').prop("checked" , this.checked);
// });
function check_uncheck_checkbox(isChecked) {
  //alert("ok")
  if (isChecked) {
    $(".chk").each(function () {
      this.checked = true;
    });
  } else {
    $(".chk").each(function () {
      this.checked = false;
    });
  }
}
// function brokenAmount(val)
// {
//     var net_amount = $("#net_amount_value").val();
//     $("#net_amount").val(Number(net_amount)+Number(val))
// }
// function discountAmount(val)
// {
//     var net_amount = $("#net_amount_value").val();
//     $("#net_amount").val(Number(net_amount)-Number(val))
// }
function toggle(source) {
  $(".chk").each(function () {
    this.checked = selected;
  });
}
function deleteData(str) {
  if (confirm("Are you sure you want to delete ?")) {
    location.replace(str);
  }
}
function translate()
{
  var ln = $("#ln").val();
  var title = $("#title").val();
  alert(title);
  $.ajax({
      url: "include/ajaxRequest.php",
      type: "post",
      data: "SUBMIT=TRANSLATE&ln=" + ln+"&title="+title,
      beforeSend: function () {
        //$("#d" + itemid).html('<img src="img/loader.gif" />');
      },
      success: function (data) {
        alert(data);
        //location.reload();
      },
    });
}


