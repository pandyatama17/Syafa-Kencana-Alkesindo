$(".printButton").click(function()
{
    $("#reportArea").printArea({
          mode       : "popup",
          standard   : "html5",
          popTitle   : 'Print Rekap',
          popClose   : false,
          extraCss   : '/css/reports.css',
          retainAttr : ["id","class","style"],
          printDelay : 500, // tempo de atraso na impressao
          printAlert : true,
          printMsg   : 'Print laaa'
     });
});
