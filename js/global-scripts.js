$(document).ready(function(){

  // assord
  $(".set > a").on("click", function(){
    if($(this).hasClass('active')){
      $(this).removeClass("active");
      $(this).siblings('.content').slideUp(200);
      $(".set > a i").removeClass("fa-minus").addClass("fa-plus");
    }else{
      $(".set > a i").removeClass("fa-minus").addClass("fa-plus");
      $(this).find("i").removeClass("fa-plus").addClass("fa-minus");
      $(".set > a").removeClass("active");
      $(this).addClass("active");
      $('.content').slideUp(200);
      $(this).siblings('.content').slideDown(200);
    }
    
  });



  var ajaxForm = new AjaxFormSender($('form.ajax'));
  ajaxForm.init();

  var ajaxEdit = new AjaxEditor($('.ajax-edit'));
  
  // like dislike
  ajaxEdit.setSuccessCallback("score", function(data, nameEditor){
    $('#'+nameEditor).html(data);
  });
 



  // slideshow

  var gallery = null;
  var path = null;
  var content = null;

  $('.slideShowLink').on('click', function(event) {
    event.preventDefault();
    content = $(this).closest(".photoContent");
    // console.log(content);
    path = $(this).data('path');
    gallery = content.find('.gallery');
    gallery.detach();

    content.append("<div id='show' style='text-align:center'><p><a href='javascript:void(null)' class='backGallery'>Назад</a></p></div>");
    var load = "<img src='http://ddu558.by/img/load.gif' width='100px' height='100px' id='load' />";
    $("#show").append(load);

    $("#show").find(".backGallery").click(function(event) {

     $("#show").remove();
     gallery.appendTo(content);
   });

  });


  ajaxEdit.setSuccessCallback("showGallery", function(data){

    $("#load").remove();

    if (data != null) {
     var slider = "<div class='flexslider'><ul class='slides'></ul></div>";
    $("#show").append(slider);
      var listImg = ''
      data.forEach( function(el, index) {
        var name = el.name || el['photo_name'];
        var img = "http://ddu558.by/img/"+path+ name;
        listImg += "<li data-thumb='"+img+"'><img src='"+img+"'></li>";
      });
      content.find('.flexslider').find(".slides").append(listImg);

      content.find('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
      });
    } else {
      $("#show").append("<div>Фотографий нет</div>");
    }
    



  })




  ajaxEdit.init();






// боковая форма
$('#sendMessage').mouseover(function(event) {
  var formContainer = $(this);
  formContainer.css({
    transform: "rotate(0deg)",
    right: 0
  });

  formContainer.mouseout(function(event) {
   formContainer.css({
    transform: "rotate(-90deg)",
    right: "-220px"
  });
 });

});





});