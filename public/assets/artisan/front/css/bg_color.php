<?php
header("Content-Type:text/css");
$bg_color = "#f0f"; // Change your Color Here

function checkhexcolor($bg_color)
{
    return preg_match('/^#[a-f0-9]{6}$/i', $bg_color);
}

if (isset($_GET['bg_color']) AND $_GET['bg_color'] != '') {
    $bg_color = "#" . $_GET['bg_color'];
}

if (!$bg_color OR !checkhexcolor($bg_color)) {
    $bg_color = "#336699";
}

?>


@import url('https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i');


.send-message-btn{
background-color:<?php echo $bg_color; ?>;
border: 1px solid <?php echo $bg_color; ?>;
}
.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
z-index: 2;
color: #fff;
background-color: <?php echo $bg_color; ?>;
border-color: <?php echo $bg_color; ?>;
}

.how-it-work .single-how-it-work .icon {
background-color: <?php echo $bg_color; ?>;
}
.how-it-work .single-how-it-work:hover .icon {
color:  <?php echo $bg_color; ?>;
}
.counter-and-subscribe-area .subscribe-outer-wrapper .subscribe-form-wrapper .submit-btn,
.counter-and-subscribe-area .subscribe-outer-wrapper .subscribe-form-wrapper .submit-btn:hover
{
background:  <?php echo $bg_color; ?>;
}
.counter-and-subscribe-area .single-counter-box .name {
color: <?php echo $bg_color; ?>;
}
.practise-area .single-practise-box .icon {
color: <?php echo $bg_color; ?>;
}
.practise-area .single-practise-box:hover .icon {
background-color: <?php echo $bg_color; ?>;
}
.video-play-btn {
background-color: <?php echo $bg_color; ?>;
}
.text-primary{
color: <?php echo $bg_color; ?>;
}
.panel-bio h6{
color: #fff;
background-color: <?php echo $bg_color; ?>;
}
.breadcrumb-content p{
color: #fff;
}
 .check p{
font-size: 14px;
line-height: 2.3;
}
.practise-area .single-practise-box .content .title:hover
{
color: <?php echo $bg_color; ?>;
}
.section-title .subtitle{
color:  <?php echo $bg_color; ?>;
}
#back-to-top{
display: block;
background:<?php echo $bg_color; ?>;
width: 32px;
height: 32px;
right: 50px;
bottom: 50px;
position: fixed;
text-align: center;
font-size: 20px;
line-height: 32px;
font-weight: bold;
}

.navbar-default {
background-color: #ecf0f1;
border-color: #ecf0f1;
}
.header-wrapper .navbar-default .navbar-collapse.collapse .navbar-nav li .mega-menu1 {
background-color:  #ecf0f1;
}

.header-wrapper .navbar-default .navbar-collapse.collapse .navbar-nav li .mega-menu .mega-list1 a {
padding: 15px 9px;
text-align: center;
color:<?php echo $bg_color; ?>;
background-color: transparent;
}

.header-wrapper .navbar-default .navbar-collapse.collapse .navbar-nav li a {
text-transform: uppercase;
color: <?php echo $bg_color; ?>;
font-weight:bold;
}
.panel-default> .panel-heading {
border-color: <?php echo $bg_color; ?>;
background-color: <?php echo $bg_color; ?>;
}
.accordion .panel-heading h4 a.collapsed {
background-color: <?php echo $bg_color; ?>;
}


.header-wrapper .navbar-default .navbar-collapse.collapse .navbar-nav li a::before
{
background:  <?php echo $bg_color; ?>;
}

.accordion .panel-heading a, .faq-categories ul li a:hover, .faq-categories ul li.active a {
background-color: <?php echo $bg_color; ?>;
color: #000;
font-weight: bold;
}
.panel-group .panel {
border: 1px solid <?php echo $bg_color; ?>;
}

.panel-group .panel:last-child {
border-bottom: 1px solid <?php echo $bg_color; ?>;
}

.footer-bottom {
border-top: 1px solid <?php echo $bg_color; ?>;
}
.carousel .carousel-control1 {
background-color: <?php echo $bg_color; ?>;
}

.contact-form h2:after {
background-color: <?php echo $bg_color; ?>;
}

.contact-form button:hover {
background:  <?php echo $bg_color; ?>;
border: 2px solid  <?php echo $bg_color; ?>;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
}
.contact-form button:hover {
border: 1px solid <?php echo $bg_color; ?>;
}

.contact-form button {
background: <?php echo $bg_color; ?>;
border: 2px solid <?php echo $bg_color; ?>;
}
.contact-form input[type="text"], .contact-form input[type="email"], .contact-form input[type="password"], .contact-form select, .contact-form select option, .contact-form textarea
{
border: 1px solid <?php echo $bg_color; ?>;
}
.login-admin .login-form input[type="email"], .login-admin .login-form input[type="password"], .login-admin .login-form input[type="text"] {
border: 1px solid  <?php echo $bg_color; ?>;
}


.login-admin .login-form input[type="submit"]:hover {
background-color: <?php echo $bg_color; ?>;
border: 1px solid <?php echo $bg_color; ?>;
}

.login-admin .login-form input[type="submit"] {
margin-top: 13px;
color: #fff;
background-color: <?php echo $bg_color; ?>;
}
.login-admin .login-form a {
color: <?php echo $bg_color; ?>;
}

.badge-highlight {
background: <?php echo $bg_color; ?>;
}

.span-color a{
color:  <?php echo $bg_color; ?>;
}
.postlist-tab h4 {
color:  <?php echo $bg_color; ?>;
}

.btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary:active.focus, .btn-primary:active:focus, .btn-primary:active:hover, .open>.dropdown-toggle.btn-primary.focus, .open>.dropdown-toggle.btn-primary:focus, .open>.dropdown-toggle.btn-primary:hover {
color: #fff;
background-color:  <?php echo $bg_color; ?>;
border-color:  <?php echo $bg_color; ?>;
}

.btn-primary {
background-color:  <?php echo $bg_color; ?>;
border-color:  <?php echo $bg_color; ?>;
}


.btn-primary:hover {
color: #fff;
background-color: #1A2734;
border-color: <?php echo $color; ?>;
}


#loadMore:active {
background-color:  <?php echo $bg_color; ?>;
border-color:  <?php echo $bg_color; ?>;
}


#loadMore:focus {
color:  #fff;
background-color: <?php echo $bg_color; ?>;
border-color:  <?php echo $bg_color; ?>;
}

.right a,
.left a{
color: <?php echo $bg_color; ?>;
}
.portlet.blue, .portlet.box.blue > .portlet-title, .portlet > .portlet-body.blue {
background-color: <?php echo $bg_color; ?>;
}

.portlet.box.blue {
border: 1px solid <?php echo $bg_color; ?>;
}
.portlet.box > .portlet-body {
background-color: #fff;
padding: 15px;
}

.panel-primary > .panel-heading {
color: #fff;
background-color: <?php echo $bg_color; ?>;
border-color: <?php echo $bg_color; ?>;
}
.panel-primary {
border-color: <?php echo $bg_color; ?>;
}

strong{
color: #18293b;
}
.list-group-item {
position: relative;
display: block;
padding: 10px 15px;
margin-bottom: -1px;
color: #18293b;
border: 1px solid <?php echo $bg_color; ?>;
}

.panel-footer {
padding: 10px 15px;
border-top: 1px solid <?php echo $bg_color; ?>;
border-bottom-right-radius: 3px;
border-bottom-left-radius: 3px;
}


hr{
border-top: 1px solid <?php echo $bg_color; ?>;
}
.textColor{
color:#18293b;
}

.site-color{
color: <?php echo $bg_color; ?>;
}
.content-title h4{
color: <?php echo $bg_color; ?>;

}

.input-group-addon {
color: #1A2734;
text-align: center;
border: 1px solid  <?php echo $bg_color; ?>;
}

.form-control {
 border: 1px solid  <?php echo $bg_color; ?>;
}

input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="number"]:focus, textarea:focus, select:focus
{
background-color: #ecf0f1;
border-color: <?php echo $bg_color; ?>;
color: #18293b;
}

.project-title-chat
{
color: #fff;
padding-top:10px;
}
input[type="text"],
input[type="email"],
input[type="url"],
input[type="password"],
input[type="search"],
input[type="tel"],
input[type="number"],
textarea,
select
{
color: #18293b;
border: 1px solid <?php echo $bg_color; ?>;
}

.select {
border: 1px solid <?php echo $bg_color; ?>;
}
.input:focus
{

background-color: <?php echo $bg_color; ?>;
}

.modal-title
{
color: <?php echo $bg_color; ?>;
}


.btn-custom:hover,
.btn-custom:focus {
background-color: transparent !important;
border: 2px solid  <?php echo $bg_color; ?>;
color: <?php echo $bg_color; ?> !important;
padding: 10px 30px;
}
.btn-custom {
margin-top: 20px;
background-color: transparent !important;
border: 2px solid <?php echo $bg_color; ?>;
color: <?php echo $bg_color; ?> !important;
padding: 10px 30px;
}
.panel-title strong{
color: #fff;
}

input .area1{
color: #000;
}

small,
.black{
color: #000;
}
.margin-bottom-50{
margin-bottom: 45px
}
.well{
border: 1px solid <?php echo $bg_color; ?>;
}
.blog-section-70 {
padding-top: 70px;
padding-bottom: 25px;
}
.red strong{
color: red;
}
.nopadlist .job-tab h3 a{
color: #18293b;
}
.fa-facebook-messenger{
color: <?php echo $bg_color; ?>;
}

.heading-holder h1
{
color: <?php echo $bg_color; ?>;
}
.padding-top-20
{
    padding-top:20px
}
.single-starts-box {
border: 1px solid <?php echo $bg_color; ?>;
}

.contact-form h2 {
color: <?php echo $bg_color; ?>;
}
.sk-circle .sk-child:before {
background-color: <?php echo $bg_color; ?>;
}

.about-content h3{
color: <?php echo $bg_color; ?>;
}
.single-starts-box h5{
color: <?php echo $bg_color; ?>;
}
.howIt{
color: <?php echo $bg_color; ?>;
}
.widget-title h4,
.small-title,
.work-heading{
color: <?php echo $bg_color; ?>;
}
.section-bottom-80{
padding: 0px 0px 80px;
}


.view_more_notification .single-notification {
background-color: <?php echo $bg_color; ?>;
}

.messenger-white{
color: #fff;
}
.sent-from{
font-size: 10px;
padding: 5px 0px;
}
.badge-button{
 margin-top: 0px;
padding: 4px 16px;
}