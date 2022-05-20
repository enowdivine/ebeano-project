@extends('layouts.artisan')

@section('title', 'Ebeano Artisans')

@section('content')

<div class="section" style="padding-top:20px;padding-bottom:20px">
    <div class="py-2 px-3 my-3 border-bottom">
        <h3>Jobs for Artisans</h3>
    </div>
    
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
              
    @if(count($projects) > 0)
            @foreach($projects as $data)
                <div class="postlist-tab eb-artisan-list" style="padding:10px 12px 10px 10px; border-bottom: 1px solid rgb(131, 13, 146); background:white">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                         
                           <div class="post-meta" style="margin-right:-10px">
                                @php
                                    $img = 'assets/artisan/images/project/'.$data->image;
                                    $slug = Str::slug($data->title,'-');
                                @endphp
                                <a href="{{route('details.job',[$data->id,$slug])}}">
                                    @if(file_exists($img))
                                        <img src="{{asset('assets/artisan/images/project/'.$data->image)}}" alt="image"
                                             class="img-responsive img-thumbnail">
                                    @else
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Project Thumbnail"
                                             alt="image" class="img-responsive img-thumbnail">
                                    @endif
                                </a>
                            </div><!-- end media -->
                        </div><!-- end col -->

                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="label badge-highlight">{{ get_artisan_category($data->category_id)->name }}</div>
                            <h3><a href="{{route('details.job',[$data->id,$slug])}}">{{ $data->title}}</a>
                            </h3>

                        </div><!-- end col -->

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="job-meta">
                                <div class="margin-bottom-10"></div>
                                <small>
                                    @php
                                        $biography = Str::slug(get_artisan_user($data->user_id)->name,'-')
                                    @endphp
                                    <span class="span-color text-danger">Employer : <a
                                                href="{{route('biography',[$data->user_id, $biography])}}">{{get_artisan_user($data->user_id)->name}}</a></span>
                                    <br>
                                    <span class="span-color text-danger">Deadline : {{date('d.m.Y', strtotime($data->deadline))}} </span>
                                </small>
                            </div><!-- end meta -->
                        </div><!-- end col -->

                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="job-meta text-center">
                                <h4 class="salary"> &#8358;{{number_format($data->salary)}}</h4>
                                <a @if(Auth::check()) href="#contactmodal{{$data->id}}" @else onclick="ReturnLogin()" @endif role="button" data-toggle="modal"
                                   class="btn btn-primary btn-sm btn-block">Make Offer</a>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end job-tab -->



                <div class="modal fade" id="contactmodal{{$data->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form action="{{route('bit.job.home')}}" method="post" name="bitForm"
                                  id="submit" class="submit-form">
                                {{csrf_field()}}
                            <div class="modal-body">
                                <div class="widget clearfix">
                                    <div class="post-padding item-price">
                                        <div class="content-title">
                                            <h5 class="eb-color">Apply For: {{$data->title}} </h5>
                                        </div><!-- end widget-title -->

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <input type="hidden" name="project_id" value="{{$data->id}}">
                                                    <input type="hidden" name="author_id" value="{{$data->user_id}}">
                                                    <input type="hidden" name="offer" value="{{$data->salary}}">
                                                    <p class="eml"></p>
                                                    <h5>{!! $data->description !!} </h5>
                                                    <p class="eml"></p>
                                                </div>
                                            </div><!-- end row -->

                                    </div><!-- end newsletter -->
                                </div><!-- end post-padding -->
                            </div>
                            <div class="modal-footer">

                                <button class="btn btn-primary">APPLY JOB</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            @endforeach
            
            {!! $projects->links() !!}
                
            @endif
    
</div>

<script>
function ReturnLogin(){
    showFrontendAlert('warning', 'Please login first');
    setTimeout("location.href = '/login/artisan';",2000);
}
    
</script>
@endsection
