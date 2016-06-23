function getItem(str, row)
{
   var xhttp;
   console.log(row);
   if (str == "")
   {
      document.getElementById("items_id_array").innerHTML = "items_id_array";
      return;
   }
   xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function()
   {
      if (xhttp.readyState == 4 && xhttp.status == 200)
      {
         var responseText = jQuery.parseJSON(xhttp.responseText);

         //items_id_array
         console.log("--------------start--------------");
         console.log(responseText);
         console.log("----------------------------");
         $("#itemNameCol"+row).html(responseText.name);
         $("#itemPriceCol"+row).html(rupiah(responseText.resell_price));
         $("#itemQtyCol"+row).html("<input type='number' id='qty"+row+"' name='qty"+row+"' class='form-control' value='1' onchange='countSubtotal("+row+")'min='0'>");
         $("#itemDiscountCol"+row).html("<div class='input-group'><input type='number' id='discount"+row+"' name='discount"+row+"' class='form-control' value='0' onchange='countSubtotal("+row+")'min='0'><span class='input-group-addon'>%</span></div>");
         $("#itemSubtotalCol"+row).html(rupiah(responseText.supplier_price))
         $("#itemPriceField"+row).val(responseText.supplier_price);
         $("#itemSubtotalField"+row).val(responseText.supplier_price);

         counttotal();
      }
   };
   xhttp.open("GET", "/item/itemAsJSON/"+str, true);
   xhttp.send();

   $(".option-"+str).add('disabled');
   if(row != 10)
   {
      var next = (row + 1);
      $("#item"+next).slideDown('slow');
   }
}

function countSubtotal(row)
{
   var qty = $("#qty"+row).val();
   var discount = 0;
   var price = $("#itemPriceField"+row).val();

   if(discount == 0)
   {
      subtotal = qty*price;
   }
   else
   {
      subtotal = (qty*price)-((discount/100)*(qty*price));
   }

   $("#itemSubtotalCol"+row).html(rupiah(subtotal));
   $("#itemSubtotalField"+row).val(subtotal);
   counttotal();
  //  console.log("discount : "+discount+"\n subtotal : "+subtotal+"\n row : "+row+"\n qty : "+qty);
}
function counttotal()
{
  var total = 0;
  for (var i = 1; i < 10; i++)
  {
    if ($("#itemSubtotalField"+i).val() != "")
    {
      console.log("total : "+total+" \nrow : "+i+" \naddition : "+$("#itemSubtotalField"+i).val());
      total = parseFloat(total) + parseFloat($("#itemSubtotalField"+i).val());
    }
  }
  console.log(rupiah(total));
  $("#totalcostField").val(total);
  $("#totalcost").html(rupiah(total));
}

$(document).ready(function()
{
   $("#date").change(function() {
      var currentdate = $(this).val();

      console.log(currentdate);
      var datearr = currentdate.split('-');

      console.log("datearr "+datearr);

      if (datearr['1']=="12")
      {
         var NewMonth = "01";
         var NewYear = (datearr['0']*1+1);
         var NewDay = datearr['2'];
      }
      else
      {
      if (datearr['1'] == "01")
      {
         console.log(datearr[2]);
         if(datearr['2']=='30')
         {
            var NewMonth = "0"+(datearr['1']*1+1);
            var NewDay = '01';
         }
         else if(datearr['2']=='31')
         {
            var NewMonth = "0"+(datearr['1']*1+1);
            var NewDay = '02';
         }
         else
         {
            var NewMonth = "0"+(datearr['1']*1+1);
            var NewDay = datearr[2];
         }
         }
         else if (datearr['1'] == "03" || datearr['1'] == "05" && datearr['2']=='31')
         {
            var NewMonth = "0"+(datearr['1']*1+2);
            var NewDay = '01';
         }
         else if (datearr['1'] == "08" || datearr['1'] == "10" && datearr['2']=='31') {
            var NewMonth = (datearr['1']*1+2);
            var NewDay = '01';
         }
         else
         {
            var NewMonth = "0"+(datearr['1']*1+1);
            var NewDay = datearr['2'];
         }
         var NewYear = datearr['0'];
      }

      console.log(NewMonth);
      var NewDate = NewYear+"-"+NewMonth+"-"+NewDay;
      console.log(NewDate);
      $("#due_date").val(NewDate);
   });

   for (var row = 2; row <= 10; row++)
   {
      $("#item"+row).fadeToggle();
   }
});
