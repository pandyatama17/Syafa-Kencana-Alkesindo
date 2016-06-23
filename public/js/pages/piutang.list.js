$(document).ready(function()
{
      $("#ref_no").hide();
         $("#ref_producer").hide();
       $(".check").on('click',function()
       {
          var piutangID = $(this).data('id');
          var invoiceParentID = $(this).data('parentid');
          $(".modal-body #piutangID").val( piutangID );
          $(".modal-body #invoiceParentID").val( invoiceParentID );
          $("#myModal").modal('toggle');
          console.log(invoiceParentID);
       });

    $("#repaymentType").change(function()
    {
       var paymentType = $(this).val();

       switch (paymentType)
       {
          case 'transfer':
          $("#ref_no").show();
          $("#ref_producer").show();
          $("#ref_label").text('Kode Transfer');
             break;
          case 'cheque':
          $("#ref_no").show();
          $("#ref_label").text('kode Cek/Giro');
          $("#ref_producer").show();
             break;
          case 'cash':
            $("#ref_no").hide();
            $("#ref_producer").hide();
             break;

       }
    });
    $("#reset_btn").click(function()
    {
      $('#datepicker_from').val('');
      $('#datepicker_to').val('');
      minDateFilter = new Date(this.value).getTime();
      maxDateFilter = new Date(this.value).getTime();
      oTable.draw();
    });
    var oTable=$('.dataTable-ranged').DataTable({
    "oLanguage": {
      "sSearch": "Cari Data  "
    },
    "iDisplayLength": -1,
    "sPaginationType": "full_numbers",

  });

  $('#datepicker_from').click(function() {
    $("#datepicker_from").datepicker("show");
  });

  $('#datepicker_to').click(function() {
    $("#datepicker_to").datepicker("show");
  });


  $("#datepicker_from").datepicker({
     dateFormat: 'yy-mm-dd',
    "onSelect": function(date) {
      minDateFilter = new Date(date).getTime();
      oTable.draw();
    }
  }).keyup(function() {
    minDateFilter = new Date(this.value).getTime();
    oTable.draw();
  });

  $("#datepicker_to").datepicker({
     dateFormat: 'yy-mm-dd',
    "onSelect": function(date) {
      maxDateFilter = new Date(date).getTime();
      oTable.draw();
    }
  }).keyup(function() {
    maxDateFilter = new Date(this.value).getTime();
    oTable.draw();
  });
  $('#repaymentForm').validate(
      {
          rules:
          {
             id:
             {
                      required: true
             },
             name:
             {
                  required: true
             },

          },
          highlight: function(label)
          {
             $(label).closest().addClass('error');
          },
          success: function(label)
          {
             label.closest().addClass('success');
          },
          submitHandler: function(form)
          {
             if ($(form).valid())
             {
                  $(form).ajaxSubmit(
                  {
                      url:$(this).attr('action'),
                      type: 'POST',
                      data: $(this).serialize(),
                      success: function(data)
                      {
                          var obj = jQuery.parseJSON(data);
                          if(obj.err == false)
                          {
                              swal(
                              {
                                  title: "Success!",
                                  text: obj.msg,
                                  type: "success",
                                  confirmButtonColor: "#0288d1",
                                  confirmButtonText: "Ok!",
                                  closeOnConfirm: true
                              },function()
                              {
                                  location.reload();
                              });
                              }
                              else
                              {
                                  swal("Opps!", obj.msg, "error");
                              }
                          }
                      })
                      return false;
                  }
             }
          });

});

// Date range filter
minDateFilter = "";
maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[2]).getTime();
    }

    if (minDateFilter && !isNaN(minDateFilter)) {
      if (aData._date < minDateFilter) {
        return false;
      }
    }

    if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (aData._date > maxDateFilter) {
        return false;
      }
    }

    return true;
  }
);
