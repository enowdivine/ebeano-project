@extends('layouts.theme')

@section('title', $page_title)

@section('script')
<script>
    $(document).ready(function() {
        $('.eb-forms').removeClass('container-fluid container-lg')
        
    });
</script>
@endsection

<style>
    .eb-forms{
       padding:0px; 
    }
    .page-title-area {
  background: url('{{asset('assets/images/ebeano-eform-banner.png')}}');
  position: relative;
  z-index: 10; }
  .page-title-area .page-title {
    position: relative;
    padding-top: 132px;
    padding-left: 10px;
    padding-bottom: 185px; }
    .page-title-area .page-title .title {
      color: #fff;
      font-size: 80px;
      font-weight: 500;
      text-transform: capitalize; }
      @media only screen and (min-width: 992px) and (max-width: 1200px) {
        .page-title-area .page-title .title {
          font-size: 66px; } }
      @media only screen and (min-width: 768px) and (max-width: 991px) {
        .page-title-area .page-title .title {
          font-size: 70px; } }
      @media (max-width: 767px) {
        .page-title-area .page-title .title {
          font-size: 46px; } }
    .page-title-area .page-title p {
      color: #fff;
      font-size: 24px;
      padding-top: 10px; }
      @media only screen and (min-width: 992px) and (max-width: 1200px) {
        .page-title-area .page-title p {
          font-size: 20px; } }
      @media only screen and (min-width: 768px) and (max-width: 991px) {
        .page-title-area .page-title p {
          font-size: 20px; } }
      @media (max-width: 767px) {
        .page-title-area .page-title p {
          font-size: 15px; } }
    .page-title-area .page-title nav {
      position: absolute;
      left: 0;
      bottom: -30px; }
      .page-title-area .page-title nav ol {
        background-color: #fff;
        margin: 0;
        padding: 17px 34px;
        border-radius: 40px;
        box-shadow: 0px 16px 32px 0px rgb(128 13 144 / 47%); }
        .page-title-area .page-title nav ol li {
          font-size: 16px;
          font-weight: 700;
          color: #002e44; }
          .page-title-area .page-title nav ol li a {
            font-size: 16px;
            font-weight: 700;
            color: #002e44; }
  .page-title-area .page-title-thumb {
    position: absolute;
    bottom: -30px;
    right: 0;
    text-align: right;
    z-index: -1; }
    @media (max-width: 767px) {
      .page-title-area .page-title-thumb {
        display: none; } }
    .page-title-area .page-title-thumb img {
      width: 100%; }
      @media only screen and (min-width: 768px) and (max-width: 991px) {
        .page-title-area .page-title-thumb img {
          width: 60%; } }

.breadcrumb-item + .breadcrumb-item::before {
  content: "|";
  color: #002e44; }

.banner-4-area {
  height: 1000px;
  position: relative; }
  .banner-4-area .banner-pattern {
    position: absolute;
    left: 30px;
    bottom: 30px; }
  .banner-4-area .banner-content span {
    font-weight: 500;
    color: #fff; }
  .banner-4-area .banner-content .title {
    font-size: 80px;
    line-height: 90px;
    color: #fff;
    padding-bottom: 52px;
    padding-top: 19px; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .banner-4-area .banner-content .title {
        font-size: 70px;
        line-height: 80px; } }
    @media only screen and (min-width: 768px) and (max-width: 991px) {
      .banner-4-area .banner-content .title {
        font-size: 60px;
        line-height: 70px; } }
    @media (max-width: 767px) {
      .banner-4-area .banner-content .title {
        font-size: 38px;
        line-height: 48px; } }
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      .banner-4-area .banner-content .title {
        font-size: 60px;
        line-height: 70px; } }
  .banner-4-area .banner-content ul li {
    display: inline-block;
    margin-right: 26px; }
    @media (max-width: 767px) {
      .banner-4-area .banner-content ul li {
        margin-right: 0;
        margin-top: 20px; } }
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      .banner-4-area .banner-content ul li {
        margin-right: 26px;
        margin-top: 0px; } }
    .banner-4-area .banner-content ul li a {
      background: #1c2962;
      border-color: #1c2962;
      color: #fff;
      line-height: 60px;
      padding: 0 60px; }
      .banner-4-area .banner-content ul li a:hover {
        background-color: transparent;
        color: #1c2962; }
      .banner-4-area .banner-content ul li a.main-btn-2 {
        border: 0;
        background-image: -moz-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
        background-image: -webkit-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
        background-image: -ms-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
        box-shadow: 0px 8px 16px 0px rgba(251, 143, 143, 0.2); }

/*===========================
    4.SERVICES css 
===========================*/
.services-area .services-item {
  padding-top: 70px;
  padding-bottom: 64px;
  position: relative;
  z-index: 10; }
  .services-area .services-item::before {
    position: absolute;
    content: '';
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    background: #fff;
    z-index: -1; }
  .services-area .services-item .title {
    font-size: 30px;
    line-height: 40px;
    padding: 30px 30px 24px; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .services-area .services-item .title {
        padding: 30px 10px 24px;
        font-size: 24px;
        line-height: 34px; } }
    @media (max-width: 767px) {
      .services-area .services-item .title {
        padding: 30px 10px 24px;
        font-size: 24px;
        line-height: 34px; } }
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      .services-area .services-item .title {
        padding: 30px 30px 24px;
        font-size: 30px;
        line-height: 40px; } }
  .services-area .services-item ul li {
    padding: 5px 0; }
    .services-area .services-item ul li a {
      color: #002e44;
      font-size: 16px;
      font-weight: 500; }
      .services-area .services-item ul li a i {
        height: 40px;
        width: 40px;
        text-align: center;
        line-height: 37px;
        border: 2px solid #e9f0f5;
        border-radius: 50%;
        margin-right: 21px; }
  .services-area .services-item.center {
    box-shadow: 0px 16px 32px 0px rgba(22, 85, 197, 0.06); }
    .services-area .services-item.center::after {
      position: absolute;
      content: '';
      top: -10px;
      left: -10px;
      width: 0;
      height: 0;
      border-top: 32px solid #1655c5;
      border-right: 32px solid transparent;
      z-index: -2; }
    .services-area .services-item.center .services-dot {
      position: absolute;
      right: -28px;
      bottom: -28px;
      z-index: -2; }
      @media (max-width: 767px) {
        .services-area .services-item.center .services-dot {
          display: none; } }
      @media only screen and (min-width: 576px) and (max-width: 767px) {
        .services-area .services-item.center .services-dot {
          display: flex; } }
.services-area.services-4-area .section-title span {
  color: #f87b81; }
.services-area.services-4-area .section-title .title::before {
  color: #f2f7ff; }
.services-area.services-4-area .single-services {
  padding: 62px 39px 50px;
  position: relative;
  z-index: 10;
  background-image: -moz-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
  background-image: -webkit-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
  background-image: -ms-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
  -webkit-transition: all 0.3s ease-out 0s;
  -moz-transition: all 0.3s ease-out 0s;
  -ms-transition: all 0.3s ease-out 0s;
  -o-transition: all 0.3s ease-out 0s;
  transition: all 0.3s ease-out 0s; }
  @media only screen and (min-width: 992px) and (max-width: 1200px) {
    .services-area.services-4-area .single-services {
      padding: 62px 20px 50px; } }
  @media only screen and (min-width: 768px) and (max-width: 991px) {
    .services-area.services-4-area .single-services {
      padding: 62px 20px 50px; } }
  @media (max-width: 767px) {
    .services-area.services-4-area .single-services {
      padding: 62px 10px 50px; } }
  @media only screen and (min-width: 576px) and (max-width: 767px) {
    .services-area.services-4-area .single-services {
      padding: 62px 39px 50px; } }
  .services-area.services-4-area .single-services::before {
    position: absolute;
    content: '';
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    background: #fff;
    border: 2px solid #edf8ff;
    z-index: -1;
    -webkit-transition: all 0.3s ease-out 0s;
    -moz-transition: all 0.3s ease-out 0s;
    -ms-transition: all 0.3s ease-out 0s;
    -o-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out 0s; }
  .services-area.services-4-area .single-services .item {
    padding-left: 90px;
    position: relative; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .services-area.services-4-area .single-services .item {
        padding-left: 70px; } }
    @media (max-width: 767px) {
      .services-area.services-4-area .single-services .item {
        padding-left: 70px; } }
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      .services-area.services-4-area .single-services .item {
        padding-left: 90px; } }
    .services-area.services-4-area .single-services .item i {
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      font-size: 60px;
      color: #f87b81;
      -webkit-transition: all 0.3s ease-out 0s;
      -moz-transition: all 0.3s ease-out 0s;
      -ms-transition: all 0.3s ease-out 0s;
      -o-transition: all 0.3s ease-out 0s;
      transition: all 0.3s ease-out 0s; }
    .services-area.services-4-area .single-services .item .title {
      font-size: 24px;
      line-height: 30px;
      -webkit-transition: all 0.3s ease-out 0s;
      -moz-transition: all 0.3s ease-out 0s;
      -ms-transition: all 0.3s ease-out 0s;
      -o-transition: all 0.3s ease-out 0s;
      transition: all 0.3s ease-out 0s; }
      @media only screen and (min-width: 992px) and (max-width: 1200px) {
        .services-area.services-4-area .single-services .item .title {
          font-size: 22px; } }
  .services-area.services-4-area .single-services p {
    padding-top: 35px;
    padding-bottom: 19px;
    -webkit-transition: all 0.3s ease-out 0s;
    -moz-transition: all 0.3s ease-out 0s;
    -ms-transition: all 0.3s ease-out 0s;
    -o-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out 0s; }
  .services-area.services-4-area .single-services a {
    color: #002e44;
    text-transform: capitalize;
    font-weight: 700;
    -webkit-transition: all 0.3s ease-out 0s;
    -moz-transition: all 0.3s ease-out 0s;
    -ms-transition: all 0.3s ease-out 0s;
    -o-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out 0s; }
  .services-area.services-4-area .single-services:hover {
    box-shadow: 0px 8px 16px 0px rgba(251, 143, 143, 0.4); }
    .services-area.services-4-area .single-services:hover::before {
      opacity: 0; }
    .services-area.services-4-area .single-services:hover .item i {
      color: #fff; }
    .services-area.services-4-area .single-services:hover .item .title {
      color: #fff; }
    .services-area.services-4-area .single-services:hover p {
      color: #fff; }
    .services-area.services-4-area .single-services:hover a {
      color: #fff; }

.services-2-area {
  position: relative;
  z-index: 10;
  padding-bottom: 133px; }
  .services-2-area .services-dot {
    position: absolute;
    top: 72px;
    left: 372px;
    z-index: -1; }
  .services-2-area .services-item {
    box-shadow: 0px 16px 32px 0px rgba(52, 52, 52, 0.06);
    padding: 50px 35px 45px;
    position: relative;
    z-index: 10;
    overflow: hidden;
    background: #fff; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .services-2-area .services-item {
        padding: 30px 15px 30px; } }
    @media (max-width: 767px) {
      .services-2-area .services-item {
        padding: 30px 15px 30px;
        margin-top: 30px !important; } }
    .services-2-area .services-item::before {
      position: absolute;
      content: '';
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      z-index: -1;
      -webkit-transition: all 0.3s ease-out 0s;
      -moz-transition: all 0.3s ease-out 0s;
      -ms-transition: all 0.3s ease-out 0s;
      -o-transition: all 0.3s ease-out 0s;
      transition: all 0.3s ease-out 0s;
      opacity: 0; }
    .services-2-area .services-item .icon {
      height: 60px;
      width: 60px;
      text-align: center;
      line-height: 55px;
      background: #f4f9ff;
      border-radius: 5px;
      display: inline-block;
      -webkit-transition: all 0.3s ease-out 0s;
      -moz-transition: all 0.3s ease-out 0s;
      -ms-transition: all 0.3s ease-out 0s;
      -o-transition: all 0.3s ease-out 0s;
      transition: all 0.3s ease-out 0s; }
    .services-2-area .services-item .title {
      font-size: 24px;
      font-weight: 500;
      padding-top: 34px;
      color: #002e44;
      padding-bottom: 15px;
      -webkit-transition: all 0.3s ease-out 0s;
      -moz-transition: all 0.3s ease-out 0s;
      -ms-transition: all 0.3s ease-out 0s;
      -o-transition: all 0.3s ease-out 0s;
      transition: all 0.3s ease-out 0s; }
      @media only screen and (min-width: 992px) and (max-width: 1200px) {
        .services-2-area .services-item .title {
          font-size: 20px; } }
    .services-2-area .services-item p {
      font-size: 14px;
      line-height: 26px;
      -webkit-transition: all 0.3s ease-out 0s;
      -moz-transition: all 0.3s ease-out 0s;
      -ms-transition: all 0.3s ease-out 0s;
      -o-transition: all 0.3s ease-out 0s;
      transition: all 0.3s ease-out 0s; }
    .services-2-area .services-item.active::before, .services-2-area .services-item:hover::before {
      opacity: 1; }
    .services-2-area .services-item.active .icon, .services-2-area .services-item:hover .icon {
      background: #fff; }
    .services-2-area .services-item.active .title, .services-2-area .services-item.active p, .services-2-area .services-item:hover .title, .services-2-area .services-item:hover p {
      color: #fff; }
    .services-2-area .services-item.active.item-1::before, .services-2-area .services-item:hover.item-1::before {
      background-image: -moz-linear-gradient(90deg, #0036a4 0%, #007eff 100%);
      background-image: -webkit-linear-gradient(90deg, #0036a4 0%, #007eff 100%);
      background-image: -ms-linear-gradient(90deg, #0036a4 0%, #007eff 100%); }
    .services-2-area .services-item.active.item-2::before, .services-2-area .services-item:hover.item-2::before {
      background-image: -moz-linear-gradient(90deg, rgb(128 13 144) 0%, #c80faa 100%);
      background-image: -webkit-linear-gradient(90deg, rgb(128 13 144) 0%, #c80faa 100%);
      background-image: -ms-linear-gradient(90deg, rgb(128 13 144) 0%, #c80faa 100%); }
    .services-2-area .services-item.active.item-3::before, .services-2-area .services-item:hover.item-3::before {
      background-image: -moz-linear-gradient(90deg, #5900e6 0%, #c872e8 100%);
      background-image: -webkit-linear-gradient(90deg, #5900e6 0%, #c872e8 100%);
      background-image: -ms-linear-gradient(90deg, #5900e6 0%, #c872e8 100%); }
    .services-2-area .services-item.active.item-4::before, .services-2-area .services-item:hover.item-4::before {
      background-image: -moz-linear-gradient(90deg, #ff5c00 0%, #ff9200 100%);
      background-image: -webkit-linear-gradient(90deg, #ff5c00 0%, #ff9200 100%);
      background-image: -ms-linear-gradient(90deg, #ff5c00 0%, #ff9200 100%); }
  .services-2-area.services-page {
    padding-bottom: 140px; }
    .services-2-area.services-page .section-title .title::before {
      color: #ebf2fb; }
    .services-2-area.services-page .services-dot {
      display: none; }
    .services-2-area.services-page .services-shape-bg {
      position: absolute;
      right: 0;
      top: 0;
      z-index: 1; }
      .services-2-area.services-page .services-shape-bg img {
        width: 100%; }

.services-features-area .section-title span {
  color: #00c3ff; }
.services-features-area .section-title .title::before {
  content: 'Feateurs'; }
.services-features-area .features-tab-btns {
  padding-top: 72px; }
  @media only screen and (min-width: 768px) and (max-width: 991px) {
    .services-features-area .features-tab-btns {
      padding-top: 0; } }
  @media (max-width: 767px) {
    .services-features-area .features-tab-btns {
      padding-top: 0; } }
  .services-features-area .features-tab-btns .nav li a {
    background: #fff;
    text-align: center;
    min-width: 170px;
    padding: 66px 0  21px;
    position: relative; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .services-features-area .features-tab-btns .nav li a {
        min-width: 140px; } }
    @media only screen and (min-width: 768px) and (max-width: 991px) {
      .services-features-area .features-tab-btns .nav li a {
        min-width: 210px;
        margin-top: 70px; } }
    @media (max-width: 767px) {
      .services-features-area .features-tab-btns .nav li a {
        min-width: 135px;
        margin-top: 70px; } }
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      .services-features-area .features-tab-btns .nav li a {
        min-width: 155px;
        margin-top: 70px; } }
    .services-features-area .features-tab-btns .nav li a i {
      height: 85px;
      width: 85px;
      text-align: center;
      line-height: 85px;
      border-radius: 50%;
      background-image: -moz-linear-gradient(0deg, rgb(128 13 144) 0%, #c80faa 100%);
      background-image: -webkit-linear-gradient(0deg, rgb(128 13 144) 0%, #c80faa 100%);
      background-image: -ms-linear-gradient(0deg, rgb(128 13 144) 0%, #c80faa 100%);
      color: #fff;
      font-size: 40px;
      position: absolute;
      left: 50%;
      top: -42px;
      transform: translateX(-50%); }
    .services-features-area .features-tab-btns .nav li a span {
      color: #002e44;
      display: block;
      font-size: 20px;
      line-height: 26px;
      font-weight: 500; }
    .services-features-area .features-tab-btns .nav li a.active {
      background-image: -moz-linear-gradient(0deg, rgb(128 13 144) 0%, #c80faa 100%);
      background-image: -webkit-linear-gradient(0deg, rgb(128 13 144) 0%, #c80faa 100%);
      background-image: -ms-linear-gradient(0deg, rgb(128 13 144) 0%, #c80faa 100%); }
      .services-features-area .features-tab-btns .nav li a.active i {
        background: #fff;
        color: rgb(128 13 144);
        box-shadow: 0px 30px 60px 0px #dee2e6; }
      .services-features-area .features-tab-btns .nav li a.active span {
        color: #fff; }
  .services-features-area .features-tab-btns .tab-content .solution-content span {
    font-size: 16px;
    font-weight: 500;
    color: #002e44;
    padding-bottom: 10px; }
  .services-features-area .features-tab-btns .tab-content .solution-content .title {
    font-size: 60px;
    line-height: 70px;
    padding-bottom: 6px; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .services-features-area .features-tab-btns .tab-content .solution-content .title {
        font-size: 48px;
        line-height: 58px; } }
    @media (max-width: 767px) {
      .services-features-area .features-tab-btns .tab-content .solution-content .title {
        font-size: 32px;
        line-height: 42px; } }
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      .services-features-area .features-tab-btns .tab-content .solution-content .title {
        font-size: 60px;
        line-height: 70px; } }
  .services-features-area .features-tab-btns .tab-content .solution-content p {
    line-height: 28px;
    padding-right: 35px;
    padding-top: 23px; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .services-features-area .features-tab-btns .tab-content .solution-content p {
        font-size: 15px; } }
    @media (max-width: 767px) {
      .services-features-area .features-tab-btns .tab-content .solution-content p {
        padding-right: 0; } }
.services-features-area.services-4-features-area {
  background: #fff2fa; }
  .services-features-area.services-4-features-area .section-title span {
    color: #f87b81; }
  .services-features-area.services-4-features-area .section-title .title::before {
    color: #fff; }
  .services-features-area.services-4-features-area .features-tab-btns .nav .nav-item .nav-link {
    background: #fff; }
    .services-features-area.services-4-features-area .features-tab-btns .nav .nav-item .nav-link i {
      background-image: -moz-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
      background-image: -webkit-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
      background-image: -ms-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
      box-shadow: 0px 8px 16px 0px rgba(251, 143, 143, 0.3); }
    .services-features-area.services-4-features-area .features-tab-btns .nav .nav-item .nav-link span {
      color: #002e44; }
    .services-features-area.services-4-features-area .features-tab-btns .nav .nav-item .nav-link.active {
      background-image: -moz-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
      background-image: -webkit-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
      background-image: -ms-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
      box-shadow: 0px 8px 16px 0px rgba(251, 143, 143, 0.3); }
      .services-features-area.services-4-features-area .features-tab-btns .nav .nav-item .nav-link.active i {
        background: #fff;
        color: #f87b81; }
      .services-features-area.services-4-features-area .features-tab-btns .nav .nav-item .nav-link.active span {
        color: #fff; }
  .services-features-area.services-4-features-area .tab-pane .solution-content span {
    color: #f87b81; }

.smm-services-area .smm-services-item {
  background-color: white;
  box-shadow: 0px 16px 32px 0px rgba(19, 66, 170, 0.06);
  padding: 50px 25px 45px 40px;
  position: relative;
  overflow: hidden; }
  @media only screen and (min-width: 992px) and (max-width: 1200px) {
    .smm-services-area .smm-services-item {
      padding: 50px 20px 45px 20px; } }
  @media only screen and (min-width: 768px) and (max-width: 991px) {
    .smm-services-area .smm-services-item {
      margin-top: 30px; } }
  @media (max-width: 767px) {
    .smm-services-area .smm-services-item {
      margin-top: 30px; } }
  .smm-services-area .smm-services-item::before {
    position: absolute;
    content: '01';
    top: -45px;
    right: -21px;
    font-weight: 900;
    font-size: 120px;
    color: #f5f8f9; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .smm-services-area .smm-services-item::before {
        font-size: 100px;
        top: -38px; } }
  .smm-services-area .smm-services-item .title {
    font-size: 20px;
    line-height: 30px;
    padding-top: 21px;
    padding-bottom: 6px; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .smm-services-area .smm-services-item .title {
        font-size: 18px; } }
  .smm-services-area .smm-services-item.item-2::before {
    content: '02';
    right: -5px; }
  .smm-services-area .smm-services-item.item-3::before {
    content: '03';
    right: -6px; }
  .smm-services-area .smm-services-item.item-4::before {
    content: '04';
    right: -4px; }
    
   /*===========================
    9.FEATURES css 
===========================*/
.core-features-area .section-title {
  padding-bottom: 66px; }
  .core-features-area .section-title .title::before {
    content: 'Features'; }
.core-features-area .core-features-item .item {
  padding-left: 130px;
  margin-right: 180px;
  position: relative; }
  @media only screen and (min-width: 992px) and (max-width: 1200px) {
    .core-features-area .core-features-item .item {
      margin-right: 50px; } }
  @media (max-width: 767px) {
    .core-features-area .core-features-item .item {
      margin-right: 0px;
      padding-left: 0; } }
  @media only screen and (min-width: 576px) and (max-width: 767px) {
    .core-features-area .core-features-item .item {
      margin-right: 10px;
      padding-left: 130px; } }
  .core-features-area .core-features-item .item .icon {
    position: absolute;
    left: 0;
    top: 7px; }
    @media (max-width: 767px) {
      .core-features-area .core-features-item .item .icon {
        position: inherit;
        top: 0;
        display: inline-block; } }
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      .core-features-area .core-features-item .item .icon {
        position: absolute;
        top: 7px;
        display: block; } }
    .core-features-area .core-features-item .item .icon::before {
      position: absolute;
      content: '';
      right: 4px;
      top: 4px;
      height: 22px;
      width: 22px;
      background: #00b0ff;
      border-radius: 50%;
      border: 7px solid #fff;
      box-shadow: 0px 8px 16px 0px rgba(10, 78, 212, 0.2); }
    .core-features-area .core-features-item .item .icon i {
      height: 90px;
      width: 90px;
      text-align: center;
      line-height: 90px;
      background: linear-gradient(90deg, #1341a9 0%, #005bff 100%);
      color: #fff;
      font-size: 34px;
      border-radius: 50%;
      box-shadow: 0px 8px 16px 0px rgba(10, 78, 212, 0.2); }
  .core-features-area .core-features-item .item .title {
    font-size: 24px; }
  .core-features-area .core-features-item .item p {
    line-height: 28px;
    padding-top: 17px; }
    @media (max-width: 767px) {
      .core-features-area .core-features-item .item p {
        font-size: 14px; } }
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      .core-features-area .core-features-item .item p {
        font-size: 16px; } }
  .core-features-area .core-features-item .item.center {
    background: #f6f9ff;
    padding-left: 170px;
    padding-top: 33px;
    padding-bottom: 33px;
    margin-right: 130px;
    margin-top: 35px;
    margin-bottom: 35px; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .core-features-area .core-features-item .item.center {
        margin-right: 0; } }
    @media (max-width: 767px) {
      .core-features-area .core-features-item .item.center {
        margin-right: 0;
        padding-left: 10px; } }
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      .core-features-area .core-features-item .item.center {
        margin-right: 0;
        padding-left: 170px; } }
    .core-features-area .core-features-item .item.center .icon {
      left: 40px;
      top: 40px; }
      @media (max-width: 767px) {
        .core-features-area .core-features-item .item.center .icon {
          left: 0;
          top: 0; } }
      @media only screen and (min-width: 576px) and (max-width: 767px) {
        .core-features-area .core-features-item .item.center .icon {
          left: 40px;
          top: 40px; } }
      .core-features-area .core-features-item .item.center .icon::before {
        background: #ffb368; }
      .core-features-area .core-features-item .item.center .icon i {
        background: -webkit-linear-gradient(left, #ff5a00 0%, #ffa100 100%);
        background: -o-linear-gradient(left, #ff5a00 0%, #ffa100 100%);
        background: linear-gradient(to right, #ff5a00 0%, #ffa100 100%); }
  .core-features-area .core-features-item .item.item-3 .icon::before {
    background: #ff7598; }
  .core-features-area .core-features-item .item.item-3 .icon i {
    background: -webkit-linear-gradient(left, #ff3d69 0%, #ff5388 100%);
    background: -o-linear-gradient(left, #ff3d69 0%, #ff5388 100%);
    background: linear-gradient(to right, #ff3d69 0%, #ff5388 100%); }
    
    
    .core-features-area .features-title {
        padding-top: 25px;
  padding-bottom: 18px; }
  .core-features-area .features-title > span {
    font-weight: 500;
    text-transform: capitalize;
    color: rgb(128 13 144); }
  .core-features-area .features-title .title {
    font-size: 60px;
    font-weight: 500;
    line-height: 70px; }
    @media only screen and (min-width: 992px) and (max-width: 1200px) {
      .core-features-area .features-title .title {
        font-size: 50px;
        line-height: 60px; } }
    @media (max-width: 767px) {
      .core-features-area .features-title .title {
        font-size: 36px;
        line-height: 46px; } }
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      .core-features-area .features-title .title {
        font-size: 46px;
        line-height: 56px; } }
    .core-features-area .features-title .title span {
      font-weight: 300;
      color: #1343ad;
      position: relative; }
      .core-features-area .features-title .title span::before {
        position: absolute;
        content: '';
        left: 0;
        bottom: 0;
        height: 3px;
        width: 65px;
        background: #1343ad; }
.core-features-area .features-item {
  border: 2px solid #f4f9ff;
  padding: 58px 38px 53px;
  position: relative;
  -webkit-transition: all 0.3s ease-out 0s;
  -moz-transition: all 0.3s ease-out 0s;
  -ms-transition: all 0.3s ease-out 0s;
  -o-transition: all 0.3s ease-out 0s;
  transition: all 0.3s ease-out 0s; }
  @media only screen and (min-width: 992px) and (max-width: 1200px) {
    .core-features-area .features-item {
      padding: 58px 9px 52px; } }
  @media only screen and (min-width: 768px) and (max-width: 991px) {
    .core-features-area .features-item {
      margin-top: 30px !important; } }
  @media (max-width: 767px) {
    .core-features-area .features-item {
      margin-top: 30px !important; } }
  .core-features-area .features-item::before {
    position: absolute;
    content: '';
    left: 0;
    bottom: 0;
    height: 0px;
    width: 100%;
    background: rgb(128 13 144);
    -webkit-transition: all 0.3s ease-out 0s;
    -moz-transition: all 0.3s ease-out 0s;
    -ms-transition: all 0.3s ease-out 0s;
    -o-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out 0s; }
  .core-features-area .features-item i {
    position: absolute;
    right: 30px;
    top: 30px;
    height: 40px;
    width: 40px;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    background: #edfff9;
    color: rgb(128 13 144); }
  .core-features-area .features-item .title {
    font-size: 24px;
    font-weight: 500;
    letter-spacing: -1px;
    padding-top: 23px; }
  .core-features-area .features-item p {
    font-size: 14px;
    line-height: 26px;
    padding-top: 15px; }
  .core-features-area .features-item a {
    font-size: 14px;
    font-weight: 500;
    color: rgb(128 13 144);
    text-decoration: underline; }
  .core-features-area .features-item.item-2 a {
    color: #1c4dca; }
  .core-features-area .features-item.item-2 i {
    color: #1c4dca; }
  .core-features-area .features-item.item-2::before {
    background: #1c4dca; }
  .core-features-area .features-item.item-3 a {
    color: #ff7800; }
  .core-features-area .features-item.item-3 i {
    color: #ff7800; }
  .core-features-area .features-item.item-3::before {
    background: #ff7800; }
  .core-features-area .features-item.item-4 a {
    color: #f16667; }
  .core-features-area .features-item.item-4 i {
    color: #f16667; }
  .core-features-area .features-item.item-4::before {
    background: #f16667; }
  .core-features-area .features-item:hover {
    border-color: #fff;
    box-shadow: 0px 16px 32px 0px rgba(217, 219, 226, 0.3);
    margin-top: -15px; }
    .core-features-area .features-item:hover::before {
      height: 6px; }
.core-features-area.web-core-features-area .features-title > span {
  color: #f57092; }
.core-features-area.web-core-features-area .features-title .title span {
  color: #f57092; }
  .core-features-area.web-core-features-area .features-title .title span::before {
    background: #f57092; }
.core-features-area.web-core-features-area .features-item i {
  background-image: -moz-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
  background-image: -webkit-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
  background-image: -ms-linear-gradient(0deg, #eb790f 0%, #c8680f 100%);
  box-shadow: 0px 8px 16px 0px #eb790f96;
  color: #fff; }

    .listt {
        background-color: #fff;
        box-shadow: 0px 16px 32px 0px rgb(22 85 197 / 6%);
    }
    
    .listForms {
        background-color: #fff;
        margin: 0;
        padding: 15px 24px;
        border-radius: 8px;
        box-shadow: 0px 16px 32px 0px rgb(128 13 144 / 47%);
    }
    
    .listForms .title {
        font-size: 19px;
        margin-top:30px;
        font-family: georgia;
        font-weight: bold;
    }
    
    .col-margin {
        margin-left: 8;
    }
    
    .pricetag {
    	display: inline-block;
      
      width: auto;
    	height: 38px;
    	
    	background-color: #eb790f;
    	-webkit-border-radius: 3px 4px 4px 3px;
    	-moz-border-radius: 3px 4px 4px 3px;
    	border-radius: 3px 4px 4px 3px;
    	
    	border-left: 1px solid #979797;
    
    	/* This makes room for the triangle */
    	margin-left: 19px;
    	
    	position: relative;
    	
    	color: white;
    	font-weight: 300;
    	font-family: 'Source Sans Pro', sans-serif;
    	font-size: 15px;
    	line-height: 38px;
    
    	padding: 0 10px 0 10px;
    }
    
    /* Makes the triangle */
    .pricetag:before {
    	content: "";
    	position: absolute;
    	display: block;
    	left: -19px;
    	width: 0;
    	height: 0;
    	border-top: 19px solid transparent;
    	border-bottom: 19px solid transparent;
    	border-right: 19px solid #979797;
    }
    
    /* Makes the circle */
    .pricetag:after {
    	content: "";
    	background-color: white;
    	border-radius: 50%;
    	width: 4px;
    	height: 4px;
    	display: block;
    	position: absolute;
    	left: -9px;
    	top: 17px;
    }
    
    .see-more {
        margin-top: 10px;
    }
    
    .ebforms-list {
        margin-right:5px;
        box-shadow: none;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .ebforms-list:hover {
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.12);
        border:1px solid rgb(131, 13, 146);
    }
    .ebform-lists {
        background-color: #fff;
        box-shadow: 0px 16px 32px 0px rgb(22 85 197 / 6%);
    }

</style>
    
@section('content')
     <!--====== page title PART START ======-->
    
    <section class="page-title-area mt-140">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="page-title">
                        <h3 class="title"></h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Form Portal</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="page-title-thumb">
                    
                    </div>
                </div>
            </div> <!-- row -->
        </div>
    </section>
    
    <!--====== page title PART ENDS ======-->

    <!--====== CORE FEATURES PART START ======-->
    
    <section class="core-features-area web-core-features-area" style="margin-top:40px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="features-title text-center">
                        <h4 class="title">Assurance</h4>
                    </div>
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-7">
                    <div class="features-item item-4 listt">
                        <i class="fa fa-check"></i>
                        <img width="70" height="70" src="{{asset('assets/icons/eb-forms.png')}}" alt="icon">
                        <h4 class="title">Quick & Stress Free</h4>
                        <p>You can easily access and complete available forms on our platform. It is stress free!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-7">
                    <div class="features-item item-4 listt">
                        <i class="fa fa-check"></i>
                        <img width="70" height="70" src="{{asset('assets/icons/eb-forms.png')}}" alt="icon">
                        <h4 class="title">Credibility</h4>
                        <p>Forms you apply for on Ebeano portal are 100% credible and guranteed by the registrar involved.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-7">
                    <div class="features-item item-4 listt">
                        <i class="fa fa-check"></i>
                        <img width="70" height="70" src="{{asset('assets/icons/eb-forms.png')}}" alt="icon">
                        <h4 class="title">Affordability</h4>
                        <p>Ebeano sells forms at discounted rates compared to other channels. We are with the registrars directly.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-7">
                    <div class="features-item item-4 listt">
                        <i class="fa fa-check"></i>
                        <img width="70" height="70" src="{{asset('assets/icons/eb-forms.png')}}" alt="icon">
                        <h4 class="title">Privacy</h4>
                        <p>We understand your privacy and security are very important. Data submitted on Ebeano is highly protected.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== CORE FEATURES PART ENDS ======-->
    
    
    <!--====== SERVICES FEATURES PART START ======-->
    
    <section class="services-features-area pb-140">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="features-title text-center" style="margin-top:40px">
                        <h4 class="title" style="font-size: 36px;">Forms on sale</h4>
                    </div>
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="features-tab-btns">
                        <ul class="nav nav-pills justify-content-between" id="pills-tab" role="tablist">
                            @foreach($all_institutes as $key => $inst)
                            <li class="nav-item">
                                <a class="nav-link @if($key+1 == 1) active @endif" id="pills-{{ $key+1 }}-tab" data-toggle="pill" href="#pills-{{ $key+1 }}" role="tab" aria-controls="pills-{{ $key+1 }}" aria-selected="true" style="padding-left:18px;padding-right:18px">
                                    <i class="fab fa-wpforms"></i>
                                    <span title="{{ $inst->name }}" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 110px; ">{{ $inst->name }}</span>
                                </a>
                            </li>
                            @endforeach
                            
                        </ul>
                        <div class="tab-content mt-70" id="pills-tabContent">
                            @foreach($all_institutes as $key => $inst)
                            <div class="tab-pane fade @if($key+1 == 1) show active @endif" id="pills-{{ $key+1 }}" role="tabpanel" aria-labelledby="pills-{{ $key+1 }}-tab">
                                <div class="row align-items-center" style="margin-top:20px">
                                    @foreach(\App\InstituteForms::where(['institute_id'=>$inst->id, 'status'=>1])->latest()->take(12)->get() as $form)
                                    
                                    <div class="col-5 col-md-3 col-lg-3 listForms col-margin">
                                        <img width="40" height="40" style="float:right;margin-top:-10px;border-radius:50%; border:1px solid rgb(128 13 144)" src="{{asset('assets/eforms/institute/logo')}}/{{$inst->institute_logo}}" alt="">
                                        
                                        <a href="{{ route('registrar.view.eforms', $form->reference) }}"><h3 class="title">{{ $form->title }}</h3></a>
                                        <span class="pricetag">&#8358;{{ number_format($form->amount) }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <div class="text-center" style="margin-top:20px">
                                    <a class="btn btn-default see-more" href="{{ route('filter.eforms', $inst->slug) }}">See more forms</a>
                                </div>
                                
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div> <!-- row -->
            
            <div class="section" style="background:white">
                <div class="py-2 px-3 my-3 border-bottom">
                    <h3>More forms</h3>
                </div>
                <div class="row px-4">
                    @foreach ($on_sale as $form)
                        <div class="col-6 col-md-3 col-lg-3 ebforms-list ebform-lists col-margin">
                            <img width="40" height="40" style="float:right;margin-top:-10px;border-radius:50%; border:1px solid rgb(128 13 144)" src="{{asset('assets/eforms/institute/logo')}}/{{$form->institute->institute_logo}}" alt="">
                            
                            <a href="{{ route('registrar.view.eforms', $form->reference) }}"><h5 class="title">{{ $form->title }}</h5></a>
                            <span class="pricetag">&#8358;{{ number_format($form->amount) }}</span>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center" style="margin-top:20px">
                    <a class="btn btn-default see-more mb-2" href="">See more forms</a>
                </div>
                                
            </div>
            
        </div>
    </section>
    
    <!--====== SERVICES FEATURES PART ENDS ======-->
    
@endsection
 
 
@section('script')
<script src="https://js.paystack.co/v1/inline.js"></script>

@endsection