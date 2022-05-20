@extends('layouts.estate')

@section('title', $page_title)

@section('script')
<script>
    $(document).ready(function() {
        
    });
</script>
@endsection

@section('content')
    <section class="">
        <div class="row justify-content-center mt-4">
            <div class="col-xl-11 col-12 text-center mt-sm-0 pt-sm-0">
                <div class="text-center">
                    <div class="bg-white rounded-bottom shadow">
                        <div class="card border-0 tab-pane fade show active" id="buy" role="tabpanel" aria-labelledby="buy-login">
                            <form action="{{route('estate.search')}}" class="card-body text-start">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Search :</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="search" class="fea icon-sm icons"></i>
                                                <input name="name" id="name" type="text" class="form-control ps-5" placeholder="Browse for your home:">
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Type :</label>
                                            <select class="form-control custom-select" name="type">
                                                <option value="">Type</option>
                                                @foreach($type as $t)
                                                <option value="{{ $t->type }}">{{ $t->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Select Categories:</label>
                                            <select class="form-control custom-select" name="category">
                                                @foreach($category as $cat)
                                                <option value="{{ $cat->category_id }}">{{ get_estate_category($cat->category_id) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-lg-3 col-md-3 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Range Price :</label>
                                            <select class="form-control custom-select" name="range-price">
                                                <option value="">Range Price</option>
                                                @foreach($range_price as $price) 
                                                <option value="{{ $price->price }}">Less N{{ number_format($price->price) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-lg-2 col-md-2 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Location :</label>
                                            <select class="form-control custom-select" name="location">
                                                <option value="">Location</option>
                                                @foreach($all_cities as $city)
                                                <option value="{{$city->city}}">{{$city->city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-default">Search now</button>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form><!--end form-->
                        </div><!--end teb pane-->
                        
                    </div><!--end tab content-->
                </div>                        
            </div><!--end col-->
        </div><!--end row-->
        
    </section>
    
    <!-- Work Start -->
    <section class="bg-white mt-4 pt-4 pb-3 mb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 filters-group-wrap">
                    <div class="filters-group">
                        <ul class="container-filter list-inline mb-0 filter-options text-center">
                            <li class="list-inline-item categories-name border text-dark rounded active" data-group="all">All</li>
                            @foreach(all_estate_category() as $cat)
                            <li class="list-inline-item categories-name border text-dark rounded" data-group="{{ $cat->name }}_{{ $cat->id }}">{{ $cat->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->

        <div class="container-fluid">
            <div id="grid" class="row">
                @foreach($properties as $list)
                  @php  $category = get_estate_category($list->category_id); @endphp
                    
                <div class="col-lg-3 col-md-6 col-12 spacing mt-3 picture-item" data-groups='["{{ $list->category->name }}_{{ $list->category->id }}"]'>
                    <div class="card border-0 work-container work-grid position-relative d-block overflow-hidden rounded shadow">
                        <div class="card-body p-0">
                            <a href="{{ route('estate.show', $list->slug) }}" class="lightbox d-inline-block" title="{{$list->title}}">
                                <img src="{{ asset('assets/estate/images/uploads/' .  $list->image_name) }}" class="img-fluid" alt="{{$list->title}}">
                            </a>
                            <div class="content bg-white p-3">
                                <h5 class="mb-0"><a href="{{ route('estate.show', $list->slug) }}" class="text-dark title">{{$list->title}}</a></h5>
                                <ul class="list-unstyled text-muted mt-2 mb-0">
                                    <li class="list-inline-item me-3"><i class="fa fa-bed me-1"></i> {{$list->beds}} Bed</li>
                                    <li class="list-inline-item"><i class="fa fa-bath me-1"></i> {{$list->bath}} Bath</li>
                                    @if($list->verified)
                                    <li class="list-inline-item"><span class="label label-success me-1">Verified</span></li>
                                    @endif
                                </ul>
                                <ul class="list-unstyled d-flex justify-content-between mt-2 mb-0">
                                    <li class="list-inline-item"><b>{{ format_price($list->price) }}</b></li>
                                    <li class="list-inline-item text-muted">{{$list->city}}, {{$list->state}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
                @endforeach
                
                @if(count($properties) > 0)
                <div class="col-8 col-md-8 offset-md-2">
                    <div class="pagination-wrapper py-4">
                        <ul class="pagination justify-content-end">
                            {{ $properties->links() }}
                        </ul>
                    </div>
                </div>
                @endif
                
            </div><!--end row-->
        </div><!--end container-->

    </section><!--end section-->
        <!-- Work End -->
    
    
@endsection
 
 
@section('script')

@endsection