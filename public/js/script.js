$(document).ready(function() {

  /*$('#back').on('click', function(e){
    e.preventDefault();
    window.history.back();
  });*/

  $("#filterGestion").focus(function() {
    $(".fa-search-plus").hide();
  });

  $("#filterGestion").blur(function() {
    $(".fa-search-plus").show();
  });

  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

  $("#filterGestion").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tbodyGestion tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });

  });


    //erase the input value of the form
    $(".addUser").click(function() {
      $(".modal-title").text('Ajouter usager');
      $(".psw").show();
      $("#name, #email, #rol").attr('value' , '');
      $("#password, #password-confirm").attr("required", true);
    });

    $(".addCategory").click(function() {
      $("#name").attr('value','');
      $(".modal-title").text('Ajouter catégorie');
    });

    $(".addProduct").click(function() {
      $("#name, #description, #price, #stock, #image,#category_id").val('');
      $(".modal-title").text('Ajouter produit');
    });

  //add value to the input value of the form
  $(".usersModal").click(function() {
    $tr = $(this).closest("tr");
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();
    $(".modal-title").text("Modifier usager");
    $("#id").attr('value',data[0]);
    $("#name").attr('value',data[1]);
    $("#email").attr('value',data[2]);
    $("#rol").attr('value',data[3]);
    $(".psw").hide();
    $("#password, #password-confirm").attr("required", false);
    $('#formModal').attr('action', 'user_update/' + data[0]);
  });

  $(".categoryModal").click(function() {

    $tr = $(this).closest("tr");
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();
    $(".modal-title").text("Modifier catégorie");
    $("#id").attr('value',data[0]);
    $("#name").attr('value',data[1]);
    $('#formModal').attr('action', 'category_update/' + data[0]);
  });

  $(".productsModal").click(function() {
    $tr = $(this).closest("tr");
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();
    $(".modal-title").text("Modifier produit");
    $("#id").val(data[0]);
    $("#name").val(data[1]);
    $("#description").val(data[3]);
    $("#price").val(data[4]);
    $("#stock").val(data[5]);
    $("#size").val(data[6]);
    $(".custom-file-label").html(data[9]); // for image
    $("#category_id").val(data[8]);
    $('#formModal').attr('action', 'product_update/' + data[0]);
  });

});
