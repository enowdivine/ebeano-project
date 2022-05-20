@extends('layouts.theme')
@section('title','Ebeanomarket | Customer Care | Contact Us')
@section('content')
<style>
    .contact_localtion {
    background-color: #ffffff;
    border-radius: 8px;
    border: 1px solid #ebebeb;
    border-radius: 8px;
    padding: 30px;
    position: relative
}

.contact_localtion h4 {
    font-size: 18px;
    color: #484848;
    font-weight: bold;
    line-height: 1.2;
    margin-bottom: 20px
}

.contact_localtion p {
    font-size: 14px;
    color: #484848;
    line-height: 1.714;
    margin-bottom: 20px
}

.contact_localtion .content_list h5 {
    font-size: 16px;
    color: #484848;
    font-weight: bold;
    line-height: 1.5;
    margin-bottom: 0
}

.contact_localtion .content_list p {
    margin-bottom: 30px
}
</style>
@php
    $page = App\Page::where('slug','about-us')->first();
@endphp
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Contact Us</li>
  </ul>
  
  <div class="card border-0 my-4">
     <div class="text-center border-bottom py-2">
         <h2>{{strtoupper(__('Contact Us'))}}</h2>
     </div>
     <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                        <div class="col-sm-12">
                            @if(Session::has('success') && !empty(Session::get('success')))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif

                            @if(Session::has('error') && !empty(Session::get('error')))
                            <div class="alert alert-warning">
                                {{Session::get('error')}}
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                <form class="form-default" data-toggle="validator" action="{{ route('user.contact') }}" role="form"
                method="POST">
                @csrf
                
                 <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name" value="{{ $data['name'] ?? '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{__('Email')}}</label>
                                <input type="email" class="form-control" name="email" value="{{ $data['email'] ?? '' }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{__('Subject')}}</label>
                                <input type="text" class="form-control" name="subject" value="{{ $data['subject'] ?? '' }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{__('Message')}}</label>
                                <textarea class="form-control" name="message" rows="10" >{{ $data['message'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" style="width: 100%;" class="btn btn-default" >Send Mail</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                
                
                <div class="contact_localtion">
						<h4>Contact Us</h4>
						<p>You can also reach us with the following info.</p>
						<div class="content_list">
							<h5>Address</h5>
							<p><i class="la la-map-marker"></i> 38 Umuezebi Street, New Haven, Enugu State</p>
						</div>
						<div class="content_list">
							<h5>Phone</h5>
							<p>+234 807 376 4488</p>
							<p><a href="tel:2348073764488" class="btn btn-default"><i class="fa fa-phone"></i> Call Us Now</a></p>
						</div>
						<div class="content_list">
							<h5>Mail</h5>
							<p><a href="mailto:contact@ebeanomarket.com">contact@ebeanomarket.com</a></p>
						</div>
						
						<h5>Follow Us</h5>
						
						<div class="social-link text-dark">
                            <a href="https://www.facebook.com/Ebeano-Market-106250061337403"><i class="la la-facebook"></i></a>
                            <a href="https://twitter.com/ebeanomarket"><i class="la la-twitter"></i></a>
                            <a href="https://instagram.com/ebeanomarket"><i class="la la-instagram"></i></a>
                            <a href="https://youtube.com/ebeanomarket"><i class="la la-youtube"></i></a>
                        </div>
					</div>
					
<!--					<br>-->
<!--<div class="wrapper" style="background-color: #f2f2f2;">-->
<!--    <table id="emb-email-header-container" class="header"-->
<!--        style="border-collapse: collapse; table-layout: fixed; margin-left: auto; margin-right: auto;" align="center">-->
<!--        <tbody>-->
<!--            <tr>-->
<!--                <td style="padding: 0; width: 600px;"><br>-->
<!--                    <div class="header__logo emb-logo-margin-box"-->
<!--                        style="font-size: 26px; line-height: 32px; color: #c3ced9; font-family: Roboto,Tahoma,sans-serif; margin: 6px 20px 20px 20px;">-->
<!--                        <img style="height: auto; width: 100%; border: 0; max-width: 312px;"-->
<!--                            src="https://ebeanomarket.com/assets/images/ebeano-logo.png" alt="" width="312"-->
<!--                            height="44"><br></div>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </tbody>-->
<!--    </table><br>-->
<!--    <table class="layout layout--no-gutter"-->
<!--        style="border-collapse: collapse; table-layout: fixed; margin-left: auto; margin-right: auto; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #ffffff;"-->
<!--        align="center">-->
<!--        <tbody>-->
<!--            <tr>-->
<!--                <td class="column"-->
<!--                    style="padding: 0; text-align: left; vertical-align: top; color: #60666d; font-size: 14px; line-height: 21px; font-family: sans-serif; width: 600px;">-->
<!--                    <br>-->
<!--                    <div style="margin-left: 20px; margin-right: 20px;">-->
<!--                        <font size="4">Hi Admin,<br></font>-->
<!--                        <p><strong>How are youu?</strong></p>-->
<!--                    </div>-->
<!--                    <div style="margin-left: 20px; margin-right: 20px; margin-bottom: 24px;"><br>-->
<!--                        <p class="size-14" style="margin-top: 0; margin-bottom: 0; font-size: 14px; line-height: 21px;">-->
<!--                            Thanks,<br> <strong>EbeanoMarket TEAM</strong></p><br>-->
<!--                    </div><br>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </tbody>-->
<!--    </table><br>-->
<!--</div>-->
            </div>
        </div>
     </div>
  </div>
@endsection