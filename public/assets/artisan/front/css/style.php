<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here

function checkhexcolor($color)
{
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}

?>


@import url('https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i');



.widget_title1 h4 {
background-color: <?php echo $color ?>;
border-radius: 40px;
}
.item-price span{
color: <?php echo $color ?>;
}
/*
.footer-support-list {
text-align: center;
background-color:<?php echo $color ?>;
padding: 10px 0px;
}
*/




a:hover, a:focus, a:active {
color:  <?php echo $color; ?>;
}






.section-header h3> span{
color: <?php echo $color; ?>;
}

.section-header p:before {
content: "";
position: absolute;
top: 50%;
right: 36%;
background-color: <?php echo $color; ?>;
width: 120px;
height: 3px;
-ms-transform: translate(0%, -50%);
-webkit-transform: translate(0%, -50%);
transform: translate(0%, -50%);
}


.section-header p:after {
content: "";
position: absolute;
top: 50%;
left: 36%;
background-color:<?php echo $color; ?>;
width: 120px;
height: 3px;
-ms-transform: translate(0%, -50%);
-webkit-transform: translate(0%, -50%);
transform: translate(0%, -50%);
}



.accordion .panel-heading h4 a.collapsed {
background-color: <?php echo $color; ?>;
}


.support-bar-top .contact-admin .support-bar-social-links a i:hover {
color: <?php echo $color; ?>;
}

.footer-bottom .footer-menu ul li a:hover {
color: <?php echo $color; ?>;
}



.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
z-index: 3;
color: #fff;
cursor: default;
background-color: <?php echo $color; ?>;
border-color: <?php echo $color; ?>;
}
.view-more,
.view-more:hover,
.view-more:focus
{
background-color: <?php echo $color; ?>;
border-color: <?php echo $color; ?>;
}
.pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
z-index: 2;
color: <?php echo $color; ?>;
background-color: #eee;
border-color: #ddd;
}

.header-wrapper .navbar-default .navbar-collapse.collapse .navbar-nav li a::before
{
background:  <?php echo $color; ?>;
}


.contact-info .contact-content .contact-list ul li .contact-thumb i
{
color: #191010;
}






input[type=button].btn-block, input[type=reset].btn-block, input[type=submit].btn-block,
{
background-color: <?php echo $color; ?>;

}




.footer-support-list ul li .footer-thumb i {
font-size: 55px;
}

.bg-white{
background-color: #fff !important;
}


.inplay_title {
background: <?php echo $color; ?>;
border-radius: 4px;
}


.thumbnail {
display: block;
padding: 4px;
margin-bottom: 20px;
line-height: 1.42857143;
border: 1px solid #ddd;
border-radius: 4px;
-webkit-transition: border .2s ease-in-out;
-o-transition: border .2s ease-in-out;
transition: border .2s ease-in-out;
}




.table > thead > tr > th{
text-align : center;
text-transform:uppercase;
color: #18293b;
font-weight: bold;
}



.greenbg{
color: #00a044;
}

.redbg{
color: #e74c3c;
}

.showadd {
margin: 0 0 20px 0;
border: 1px solid #555;
}







<!--freelancer Template-->

.widget-list ul li span{
color: <?php echo $color; ?>;
border: 1px solid <?php echo $color; ?>;
}
.widget-list ul li {
text-transform: capitalize;
border-bottom: 1px dotted <?php echo $color; ?>;
padding: 10px 0px;
}
.widget-list ul li a {
color: <?php echo $color; ?>;
}
.widget-tags ul li:hover {
border: 1px solid <?php echo $color; ?>;
}

.widget-tags ul li:hover a {
color: <?php echo $color; ?>;
background-color: transparent;
margin-left: 0px;
}



.hr,
.singlejobhr
{
border-top: 1px solid #34495e;
}

.company-links li:first-child {
border-top: 1px solid #34495e;
}
.company-links li:last-child {
border-bottom: none;
}
.company-links li {
 border-bottom: 1px solid #34495e;
list-style: none;
padding: 5px 0;
font-size: 13px;
}

.error{
color: red;
}
.eml{
color: red !important;
font-size: 14px;
padding: 0px 0 10px 0 !important;
}