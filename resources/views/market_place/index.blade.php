@extends('layouts.theme')

@section('title', 'Ebeano Market Place')
<style>
    .eb-mart-product {
        margin-right:5px;
        box-shadow: none;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .eb-mart-product:hover {
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.12);
        border:1px solid rgb(131, 13, 146);
    }
    .eb-mart-box .all-mart {
        height: 49px;
        line-height: 49px;
        padding-left: 16px;
        font-size: 13px;
        background-color: rgb(131, 13, 146);
        color: #fff;
        box-sizing: border-box;
        border-radius: 8px 8px 0 0;
    }
</style>
@section('content')
    <div class="search-section mt-4 mb-0">
        <form action="{{route('store.filter')}}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-group col-md mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">State</span>
                    </div>
                    <select id="eb-states-get-marts" class="eb-select custom-select" name="state">
                        <option disabled>Select</option>
                        @foreach ($states as $state)
						<option value="{{$state->state_id}}">{{$state->name}}</option>
						@endforeach
                    </select>
                </div>
                <div class="input-group col-md mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Mart</span>
                    </div>
                    <select id="eb-marts" class="eb-select custom-select" name="mart">
                        <option value="">Select</option>
                    </select>
                </div>
                <div class="input-group col-md mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Store</span>
                    </div>
                    <select id="eb-stores" class="eb-select custom-select" name="store">
                        <option value="">Select</option>
                    </select>
                </div>
                <div class="col-md">
                    <input type="submit" class="btn eb-text-sm btn-sm btn-default" value="Filter">
                    <a href="/all_markets" class="btn eb-text-sm btn-sm btn-default ml-3">View all ></a>
                </div>
            </div>

        </form>

    </div>
    
    <!--top selling-->
    <div id="ebeano-mart-topselling"></div>
    
    <!--featured selling-->
    <div id="ebeano-mart-featured"></div>
    
    <!--top selling-->
    <div id="ebeano-mart-categories"></div>
    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('mart.section.top_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#ebeano-mart-topselling').html(null);
                $('#ebeano-mart-topselling').append($('<option>', {
            		value: 0,
            		text: 'select'
            	}));
                $('#ebeano-mart-topselling').html(data);
                slickInit();
            });
            
            $.post('{{ route('mart.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#ebeano-mart-featured').html(null);
                $('#ebeano-mart-featured').append($('<option>', {
            		value: 0,
            		text: 'select'
            	}));                
                $('#ebeano-mart-featured').html(data);
                slickInit();
            });

            $.post('{{ route('mart.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#ebeano-mart-categories').html(null);
                $('#ebeano-mart-categories').append($('<option>', {
            		value: 0,
            		text: 'select'
            	}));
                $('#ebeano-mart-categories').html(data);
                slickInit();
            });
            
            // select list of markets
            $('#eb-states-get-marts').on('change',function(e) {
                $('#eb-marts').html(null);
                $('#eb-marts').append($('<option>', {
            		value: 0,
            		text: 'select'
            }));
                $.post('{{ route('get-marts') }}', {_token:'{{ csrf_token() }}', state_id:e.target.value}, function(data){
                    $.each(data.ebMarts, function(id, name){
                        $('#eb-marts').append('<option value="'+id+'">'+name+'</option>');
                    })
                });
            })
            
            // select list of stores by markets
            $('#eb-marts').on('change',function(e) {
                $('#eb-stores').html(null);
                $('#eb-stores').append($('<option>', {
            		value: 0,
            		text: 'select'
            	}));
                $.post('{{ route('get-stores') }}', {_token:'{{ csrf_token() }}', market_id:e.target.value}, function(data){
                    $.each(data.ebStores, function(id, name){
                        $('#eb-stores').append('<option value="'+id+'">'+name+'</option>');
                    })
                });
            })
        });
    </script>
@endsection