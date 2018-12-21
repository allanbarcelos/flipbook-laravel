$(function(){
  var c = [];

  $(".dataRow").click(function () {

    $(this).toggleClass("bg-info text-light");

    var dataId = $(this).attr('data-id');


    if(c.includes(dataId))
    {

      $("#deleteTableBody > tr[data-id=\""+dataId+"\"]").remove();
      $("#id"+dataId).remove();

      c.splice(c.indexOf(dataId), 1);

    }else{
      c.push(dataId);
      $(this).clone().appendTo("#deleteTableBody");
      $("#deleteTableBody tr[data-id=\""+dataId+"\"]").removeClass("bg-info text-light");

      $("#deleteTableBody tr[data-id=\""+dataId+"\"] td:nth-child(1)").remove();
      $("#deleteTableBody tr[data-id=\""+dataId+"\"] td:nth-child(3)").remove();
      $("#deleteTableBody tr[data-id=\""+dataId+"\"] td:nth-child(3)").remove();

      $("#formDelete").prepend("<input id=\"id"+dataId+"\" type=\"hidden\" name=\"id[]\" value=\""+dataId+"\" />");

    }

    if(c.length > 3)
    {
      $.notifyDefaults({
        type: 'danger',
        allow_dismiss: true,
        delay: 5000
      });
      $.notify("Não selecione mais que <strong>3</strong> para exclusão");
    }
    else{
      //
    }

    if(c.length > 0 && c.length < 4){
      $("#removeButton").removeClass("disabled");
    }else{
      $("#removeButton").addClass("disabled");
    }
    if(c.length == 1){
      $("#editButton").removeClass("disabled");
      $("#editButton").attr("href","/admin/client/edit/" + c[0]);

    }else{
      $("#editButton").addClass("disabled");
    }
  });

  $(document).ready(function() {
    $('form#formDelete').on('submit', function(event){

      event.preventDefault();

      $("#deleteModal").modal('toggle');

      var formData = [];

      $("input[name='id[]']").each(function() {
        formData.push($(this).val());
      });

      var CSRF_TOKEN = $('input[name="_token"]').val();

      $.ajax({
        type     : "POST",
        url      : $(this).attr('action'),
        data     : {_token: CSRF_TOKEN, 'idClient' : formData},
        dataType: 'JSON',
        cache    : false,
        success  : function(data) {

          $.each(formData, function( index, value ){

            $("tr[data-id=\"" + value + "\"]").fadeOut(250).fadeIn(250,
              function(){
                $(this).remove();
                formData.splice(c.indexOf(value), 1);
                c.splice(c.indexOf(value), 1);
              });
            });

            $.notifyDefaults({
              type: 'success',
              allow_dismiss: true,
            });

            $.notify("Exclus" + ((formData.length > 1)? "ões" : "ão") + " efetuada com sucesso");

          },
          error: function()
          {
            $.each( formData, function( index, value ){
              $("tr[data-id=\"" + value + "\"]").fadeOut(250).fadeIn(250, function(){
                $.notifyDefaults({
                  type: 'danger',
                  allow_dismiss: true,
                });
                $.notify("Ocorreu uma falha na exclusão, tente novamente.");
              });
            });
          }
        })
      });
    });
  });
