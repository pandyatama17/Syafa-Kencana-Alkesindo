
body {padding: 0;margin: 0; background: #feea3a;}
/*---SITESEARCH--*/
.searchbox input::-webkit-input-placeholder { /* WebKit browsers */
    color:    #9a9a9a;
}
.searchbox input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    color:    #9a9a9a;
}
.searchbox input::-moz-placeholder { /* Mozilla Firefox 19+ */
    color:    #9a9a9a;
}
.searchbox input:-ms-input-placeholder { /* Internet Explorer 10+ */
    color:    #9a9a9a;
}
div, input, form, fieldset, span, h4 {
box-sizing: border-box;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
}

.searchbox {
width: 360px;
display: inline-block;
float: left;
height: 560px;
background:#3F51B5;
overflow: hidden;
position: relative;
font-size: 16px;
font-family: 'Roboto';
font-weight: 400;
}

.searchbox input, .searchbox select {
width: 100%;
display: inline-block;
padding: 6px;
line-height: 22px;
font-size: 16px;
border: 2px solid #fff;
box-shadow: 0 1px 3px 0 rgba(0,0,0,0.2);
border-radius: 2px;
font-family: 'Roboto';
}

fieldset {
width: 100%;
border: 0;
padding: 4px 2px;
display: inline-block;
float: left;
}

.fieldset50 {
width: 50%;
}
.fieldset33 {
width: 33.333%;
}

.searchbox input:focus,
.searchbox select:focus {
border: 2px solid #fff;
-webkit-transition: all 0.3s cubic-bezier(.4,0,.2,1);
-moz-transition: all 0.3s cubic-bezier(.4,0,.2,1);
-ms-transition: all 0.3s cubic-bezier(.4,0,.2,1);
transition: all 0.3s cubic-bezier(.4,0,.2,1);
}

input.datepicker {
background-image: url('http://uxrepo.com/download.php?img=static/icon-sets/ocha/svg/calendar.svg&color=000000');
background-repeat: no-repeat;
background-position: 284px center;
background-size: 22px 22px;
}

.searchtipp {font-size: 14px; font-family: Roboto; letter-spacing: 0; color: rgba(32,39,36,0.7);line-height: 20px; width: 100%;display:inline-block; text-align:center; padding: 15px 0 10px 0;}
.searchcenter {display: inline-block; width:100%; text-align:center; padding: 15px 0 5px 0;}

.searchheader {
height: auto;
width: 100%;
display: inline-block;
float: left;
height: 70px;
position:relative;
}
.searchheader h1 {
padding: 0 0 10px 20px;
margin-top:15px;
font-weight: 300;
font-size: 20px;
width: 100%;
color: #fff;
display: inline-block;
border-bottom: 1px solid rgba(0,0,0,0.2);
}
.searchslide {
display: none;
float: left;
position: relative;
width: 100%;
}

.searchslide.on {
display: inline-block;
-webkit-animation: fadeInDownSmall 0.4s;
-moz-animation: fadeInDownSmall 0.4s;
-ms-animation: fadeInDownSmall 0.4s;
animation: fadeInDownSamll 0.4s;
}

.searchslide form {
width: 100%;
display: inline-block;
float: left;
height: 600px;
opacity: 1;
padding: 15px 20px;
transition: all 0.3s cubic-bezier(.4,0,.2,1);
}

.searchslide.active form {
opacity: 0.3; -webkit-transform: translate3d(-25%,0,0);
-moz-transform: translate3d(-25%,0,0);
-ms-transform: translate3d(-25%,0,0);
transform: translate3d(-25%,0,0);
}



.datepickbox {display: inline-block;float: left;width:100%;}
#zebracontainer1, #zebracontainer2, #zebracontainer3 {
position: absolute;
left: 100%;
top:0;
display: inline-block;
float: left;
width: 100%;
float: left;
height: 500px;
padding: 0;
text-align:center;
background: #fff;
-webkit-transition: all 0.3s cubic-bezier(.4,0,.2,1);
-moz-transition: all 0.3s cubic-bezier(.4,0,.2,1);
-ms-transition: all 0.3s cubic-bezier(.4,0,.2,1);
transition: all 0.3s cubic-bezier(.4,0,.2,1);
}

#zebracontainer1.active,  #zebracontainer2.active, #zebracontainer3.active {
-webkit-transform: translate3d(-100%,0,0);
-moz-transform: translate3d(-100%,0,0);
-ms-transform: translate3d(-100%,0,0);
transform: translate3d(-100%,0,0);
}

#zebracontainer1 .Zebra_DatePicker.dp_visible:nth-child(2) {visibility: hidden!important;display: none !important;}
.dptop {
background-color: #3F51B5 !important;
color: #fff !important;
}
.dp_header, .dp_caption, .Zebra_DatePicker .dp_header .dp_caption span small, .Zebra_DatePicker .dp_header .dp_caption span {color: #fff !important;}
.Zebra_DatePicker .dp_header .dp_next::before,
.Zebra_DatePicker .dp_header .dp_next::after,
.Zebra_DatePicker .dp_header .dp_previous::before,
.Zebra_DatePicker .dp_header .dp_previous::after {
background: #fff !important;
}
