@extends('layouts.artisan')

@section('title', $page_title)

@section('content')
<link href="{{asset('assets/artisan/front/css/biography.css')}}" rel="stylesheet">
<div class="row">

    <div class="col-lg-3">
        @include('artisans/partials/menuhome')
    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0" style="padding-top:20px;padding-bottom:20px">
            
            <div class="section-bottom-80 section-background" id="min-height-activity">
        <div class="parallax section parallax-off"
             style="
             @if($artisan->cover != null)
                     background-image:url({{asset('assets/artisan/images/user/'.$artisan->cover)}});
             @endif
                     ">
            <div class="container">
                <div class="page-title text-center">
                    @if($artisan->image != null)
                        <img src="{{asset('assets/artisan/images/user/'.$artisan->image)}}" alt="{{$artisan->image}}"
                             class="profile-image img-circle img-responsive">
                    @endif
                    <div class="heading-holder">
                        <h1 class="eb-color">{{$artisan->user->name}} Info</h1>
                    </div>
                    <p class="lead">{!! $artisan->company_tagline !!}</p>
                    <ul class="list-inline social-small">
                        @if($artisan->web != null)
                            <li><a href="{{$artisan->web}}"><i class="fa fa-link"></i></a></li>
                        @endif

                        @if($artisan->fb != null)
                            <li><a href="{{$artisan->fb}}"><i class="fa fa-facebook"></i></a></li>
                        @endif
                        @if($artisan->twitter != null)
                            <li><a href="{{$artisan->twitter}}"><i class="fa fa-twitter"></i></a></li>
                        @endif
                        @if($artisan->google_plus != null)
                            <li><a href="{{$artisan->google_plus}}"><i class="fa fa-google-plus"></i></a></li>
                        @endif
                        @if($artisan->linkedin != null)
                            <li><a href="{{$artisan->linkedin}}"><i class="fa fa-linkedin"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div><!-- end container -->
        </div><!-- end section -->

        <div class="section lb">
            <div class="container">
                <div class="row">
                    <div class="content col-md-7">
                        <div class="panel panel-primary">
                            <div class="panel-heading panel-bio ">
                                <h6>About {{$artisan->user->name}}</h6>
                            </div>
                            <div class="panel-body">

                                <div class="link-widget">
                                    <ul class="check ">
                                        <p>{!! $artisan->company_description !!}</p>
                                    </ul><!-- end check -->
                                </div><!-- end link-widget -->
                            </div>
                        </div>

                    </div><!-- end col -->

                    <div class="sidebar col-md-5">
                        {{--<div class="widget post-padding  customwidget clearfix">--}}

                        <div class="panel panel-primary">
                            <div class="panel-heading panel-bio ">
                                <h6></h6>
                            </div>
                            <div class="panel-body">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Email</h4>
                                            <small>{{$artisan->user->email}}</small>
                                        </div><!-- end small -->
                                    </div><!-- end col -->
                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Phone</h4>
                                            <small>{{$artisan->user->phone}}</small>
                                        </div><!-- end small -->
                                    </div><!-- end col -->
                                </div>

                                <hr class="invis" style="border-color:#eb790f">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Job/Skill</h4>
                                            <small>{{$artisan->category->name}}</small>
                                        </div><!-- end small -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="small-detail">
                                            <h4>Registered</h4>
                                            <small>{{ date('F, Y', strtotime($artisan->created_at)) }}</small>
                                        </div><!-- end small -->
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div>
                        </div>

                      @if(Auth::check() && isset($assign_request))
                      <br>
                        <button type="submit" class="btn btn-primary btn-sm btn-block"
                                data-toggle="modal"
                                data-target="#Modal{{$artisan->id}}">
                            Give Job Now
                        </button>
                        <!-- Modal for Edit button -->
                        <div class="modal fade"  data-backdrop="false" id="Modal{{$artisan->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                    </div>
            
                                    <div class="modal-body">
                                        <h6 class="modal-title"><b
                                                    class="abir_act"></b> {{$assign_request->title}} </h6>
                                        <p>Are you sure assign the job this user ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form role="form" method="POST"
                                              action="{{route('assign.job')}}"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{method_field('post')}}
                                            <input type="hidden" name="project_id" value="{{$assign_request->project_id}}">
                                            <input type="hidden" name="user_id" value="{{ $assign_request->user_id}}">
                                            <input type="hidden" name="deadline" value="{{ $assign_request->deadline}}">
            
                                            <button type="submit" class="btn  btn-primary ">Yes</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      @endif
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end section -->

    </div>
    <!-- Blog Single Section End -->
            
        </div>    
    </div>
    
</div>

<script>
    (function ($) {
        $(window).on('resize', function () {
            var bodyHeight = $(window).height();
            $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 750);
            console.log(bodyHeight)
        })
        var bodyHeight = $(window).height();
        $('#min-height-activity').css('min-height', parseInt(bodyHeight) - 750);
        console.log(bodyHeight)
    }(jQuery))
</script>
@endsection