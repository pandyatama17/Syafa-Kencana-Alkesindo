$(document).ready(function()
{
   $('.chosen-select').chosen();

   $('.chosen-select-disabled').chosen({
      disable_search_threshold:10,
   });

   $('.datepicker').datepicker(
   {
      dateFormat : 'yy-mm-dd'
   });

   $('.currency').inputmask("Rp. 999.999.999,00");

   $(".file-control").change(function () {
       readURL(this);
   });

   $('.dataTable').DataTable();

});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.upload-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

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
