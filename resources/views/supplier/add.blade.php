@extends('item.main')

@section('menu')

<div class="row">
   <form class="col s12" method="post" action="{{ action('MainController@storeSupplier') }}" id="addSupplierForm">
     <div class="row">
          <h2 class="header" style="color:teal">Add Supplier</h2>
          <?php
            try
            {
                $lastid = DB::table('supplier')->orderBy('id','ascending')->first();
                $newid = $lastid->id + 1;
            }
            catch(Exception $e)
            {
                $newid = 1;
            }
          ?>
          <div class="input-field col s1">
            <input id="id" name="id" type="text" value="{{ $newid}}">
            <label for="id">ID</label>
          </div>
          <div class="clear"></div>
          <div class="input-field col s6">
            <input id="name" name="name" type="text">
            <label for="name">Nama Supplier</label>
          </div>
          <div class="clear"></div>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <button class="btn waves-effect waves-light" type="submit" name="action">Submit
           <i class="material-icons right">send</i>
         </button>
      </div>
   </form>
 </div>
 <script src="/jquery.validate.min.js" charset="utf-8"></script>
 <script src="/jquery.form.js" charset="utf-8"></script>

 <script type="text/javascript">
 $(document).ready(function()
 {
    $('#addSupplierForm').validate(
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
                                    location.replace('/supplier');
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
 </script>
@endsection
