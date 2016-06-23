$(document).ready(function()
     {
        $("#ItemEditText").toggle();
        $('#EditItemContainer').toggle();

        $('#CardAction').click(function()
        {

           if ($('#ItemCard').is(":visible"))
           {
                 $('#ItemCard').slideToggle(function()
              {
                 $('#EditItemContainer').slideToggle('slow');
                 $('#CardAction').html('<i class="fa fa-eye"></i> Preview');
                 $("#ItemEditText").toggle();
              });
              $('#ItemImage').slideToggle('slow');
           }
           else
           {
              $('#EditItemContainer').slideToggle(function()
              {
                 $('#ItemCard').slideToggle('slow');
                 $('#CardAction').html('<i class="fa fa-edit"></i> Edit');
                 $("#ItemEditText").toggle();
              });
              $('#ItemImage').slideToggle('slow');
           }
        });

        $('#CardAction2').click(function()
        {
           $('#CardAction').click();
        });

        function readURL(input)
		  {
         	if (input.files && input.files[0])
				{
              	var reader = new FileReader();
					reader.onload = function (e)
					{
                  $('#prev').attr('src', e.target.result);
              	}
					reader.readAsDataURL(input.files[0]);
          	}
			}
			$("#image").change(function()
			{
         	readURL(this);
      	});
   });
	$(".deleteBtn").click(function()
   {
      var url= $(this).data('href');
      var item_id = this.id;
      if(url != "")
      {
         swal(
         {
            title: "Hapus Barang",
            text: "Hapus "+item_id+"? semua data invoice dan DO yang menggunakan barang ini akan tidak terbaca",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Lanjut",
            closeOnConfirm: false,
         },function()
         {
				swal(
				{
					title: "Konfirmasi Penghapusan Barang",
					text: "Silahkan Ketik 'HAPUS'",
					type: "input",
					showCancelButton: true,
					closeOnConfirm: false,
					animation: "slide-from-top",
					inputPlaceholder: "Silahkan Ketik 'HAPUS'",
					showLoaderOnConfirm: true,
				},function(inputValue)
				{
					if (inputValue === false) return false;
					if (inputValue != "HAPUS")
					{
						swal.showInputError("Silahkan Ketik 'HAPUS' ");
						return false
					}
					else
					{
						$.ajax(
		            {
		               type: "get",
		               url: url,
		               // data: url,
		               success: function(data)
		               {
		               }
		            }).done(function(data)
		            {
		               swal(
		               {
		                  title: "Success",
		                  text: "Barang telah Dihapus!",
		                  type: "success",
		                  showCancelButton: false,
		                  // confirmButtonColor: "#DD6B55",
		                  confirmButtonText: "OK",
		                  closeOnConfirm: false
		               }, function()
		               {
								window.location.href = "{{url('storage/list')}}";
								// location.reload();
		               });
		               $('#orders-history').load(document.URL +  ' #orders-history');
		            }).error(function(data)
		            {
		               swal("Oops", "We couldn't connect to the server!", "error");
		            });
					}

				});
         });
      }
   });
   var resell_price = $("#resell_price").text();
   $("#resell_price").text(rupiah(resell_price));

   var supplier_price = $("#supplier_price").text();
   $("#supplier_price").text(rupiah(supplier_price));

    $('#EditItemForm').validate(
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
                                    closeOnConfirm: false
                                },
                                function()
                                {
                                    location.replace('/storage/show/'+obj.itemid);
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

    function rupiah(nStr)
   {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1))
      {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
      }
      return "Rp. " + x1 + x2 +",00";
   }
