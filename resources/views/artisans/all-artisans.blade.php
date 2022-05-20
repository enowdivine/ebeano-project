@extends('layouts.artisan')

@section('title', 'Ebeano Artisans')

@section('content')

<div class="section" style="padding-top:20px;padding-bottom:20px">
    <div class="py-2 px-3 my-3 border-bottom">
        <h3>Artisans</h3>
    </div>
              
    @if(count($artisans) > 0)
            @foreach($artisans as $data)
                <div class="postlist-tab eb-artisan-list" style="padding:10px 12px 10px 10px; border-bottom: 1px solid rgb(131, 13, 146); background:white">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                         
                           <div class="post-meta" style="margin-right:-10px">
                                @php
                                    $img = 'assets/artisan/images/user/'.$data->image ?? '';
                                    $slug = Str::slug($data->user->name ?? '','-');
                                @endphp
                                    @if(file_exists($img))
                                        <img src="{{asset('assets/artisan/images/user/'.$data->image ?? '')}}" alt="image"
                                             class="img-responsive img-thumbnail" style="width:100px;height:100px;border-radius:50%">
                                    @else
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Project Thumbnail"
                                             alt="image" class="img-responsive img-thumbnail">
                                    @endif
                            </div><!-- end media -->
                        </div><!-- end col -->

                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="label badge-highlight">{{ $data->category->name ?? ''}}</div>
                            <br>
                            <h6>Business Name: {{ $data->company_tagline ?? ''}}</h6>
                            <h6>Address: {{ $data->user->address ?? ''}}</h6>
                            <h3><a href="{{route('biography',[$data->user->id ?? '', $slug])}}">{{ $data->user->name ?? ''}}</a>
                            </h3>

                        </div><!-- end col -->
                        
                        @if(!Auth::check())
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="job-meta text-center">
                                <br>
                                <br>
                                <a onclick="ReturnLogin()" role="button" data-toggle="modal"
                                   class="btn btn-primary btn-sm btn-block">Assign Job</a>
                            </div>
                        </div><!-- end col -->
                        @endif
                    </div><!-- end row -->
                </div><!-- end job-tab -->

            @endforeach
            
            {!! $artisans->links() !!}
                
            @endif
    
</div>

<script>
function ReturnLogin(){
    showFrontendAlert('warning', 'Please login first');
    setTimeout("location.href = '/login/artisan';",2000);
}
    
</script>
@endsection
