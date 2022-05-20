@extends('layouts.artisan')

@section('title', $page_title)

@section('content')
<style>
    .eb-artisan-list {
        margin-right:5px;
        box-shadow: none;
        border-radius: 4px;
        padding:10px 10px 17px 10px;
        margin-bottom: 20px;
    }

    .eb-artisan-list:hover {
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.12);
        border:1px solid rgb(131, 13, 146);
    }
</style>
<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @include('artisans/partials/menuhome')
    </div>
    <div class="col-lg-9">
        <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0" style="padding-top:20px;padding-bottom:20px">
            
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
            
            @if(count($bitJobs) > 0)
            @foreach($bitJobs as $data)
                    @php
                        $user = \App\User::where('id',$data->user_id)->first();
                        $artisan = \App\Artisans::where('user_id',$data->user_id)->first();
                        $cat = \App\ArtisanCategory::where('id',$user->artisan->category_id)->first();
                    @endphp
                <div class="all-jobs job-listing eb-artisan-list freelancer-list nopadlist clearfix" style="border-bottom:1px solid rgb(131, 13, 146)">
                    <div class="job-tab">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <div class="post-media">
                                    <a href="{{route('biography',[$user->id, $user->name])}}">
                                        @if(file_exists( 'assets/artisan/images/user/'.$user->image) && ($user->image != null))
                                            <img src="{{asset('assets/artisan/images/user').'/'.$user->image}}"
                                                 alt="Image" class="img-responsive img-thumbnail">
                                        @else
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=Profile"
                                                 alt="Image" class="img-responsive img-thumbnail">
                                        @endif
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="badge part-badge">{{$cat->name}}</div>
                                <h3 class="post-tile"><a
                                            href="{{route('biography',[$user->id, $user->name])}}">{{$user->name}}</a>
                                </h3>
                                <small>
                                    <span> @if($artisan->resume) Skills
                                        : {{ $artisan->skills }} @endif
                                    </span>
                                </small>
                            </div><!-- end col -->

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="margin-top-40"></div>
                                <small>
                                    <span>
                                        Contact Phone : <b>{{$user->phone}}</b>
                                    </span><br>
                                    <span>
                                        Contact Email : <b>{{$user->email}}</b>
                                    </span>
                                </small>
                            </div><!-- end col -->


                            <div class="col-md-2 col-sm-3 col-xs-12">
                                <div class="job-meta text-center ">
                                    <!--<a href="{{route('chat.user', [$data->code])}}"
                                       class="pull-left messenger">
                                        <i class="fab fa-facebook-messenger font-20"></i>
                                    </a>-->
                                    <h4> &#8358;{{number_format($data->offer)}}</h4>

                                    @php
                                        $assign = \App\ArtisanAssignJob::where('user_id',$user->id)->where('project_id',$data->project->id)->count();
                                    @endphp
                                    @if($assign>0)
                                        <button type="submit" class="btn btn-success btn-sm btn-block">
                                            Awarded
                                        </button>
                                    @else
                                    <form role="form" method="POST"
                                      action="{{route('assign.job.profile')}}"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{method_field('post')}}
                                        <input type="hidden" name="project_id" value="{{$data->project->id}}">
                                        <input type="hidden" name="user_id" value="{{ $user->id}}">
                                        <input type="hidden" name="deadline" value="{{ $data->project->deadline}}">
                                        <input type="hidden" name="title" value="{{ $data->project->title}}">
                                        <button type="submit" class="btn btn-primary btn-sm btn-block">
                                            Give Job
                                        </button>
                                    </form>
                                    @endif

                                </div>
                            </div><!-- end col 
                                                data-toggle="modal"
                                                data-target="#Modal{{$data->id}}"-->
                        </div><!-- end row -->
                    </div><!-- end job-tab -->
                </div><!-- end alljobs -->

            @endforeach

            {!! $bitJobs->links() !!}
            
            @else
                <span>You have no bidders on this job yet !!</span>
            @endif
             
        </div>
    </div>
    
</div>

@endsection