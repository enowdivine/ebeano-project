@extends('layouts.theme')

@section('title', 'All Ebeano Markets')

@section('content')
    <div class="search-section mt-4 mb-0">
        <form action="" method="post">
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
                        <option disabled>Select</option>
                    </select>
                </div>
                <div class="col-md">
                    <input type="submit" class="btn eb-text-sm btn-sm btn-default" value="Filter">
                    <a href="/marketplace" class="btn eb-text-sm btn-sm btn-default ml-3">< Go back</a>
                </div>
            </div>

        </form>

    </div>
    <div class="section">

        <div class="market-list-container">
            @foreach ($marts as $mart)
                <div address="[object Object]" class="market-card">
                    <div class="market-card-head"><a class="market-link" href="{{ route('mart', $mart->slug) }}"><svg height="14" viewBox="0 0 16 14"
                                width="16" aria-label="store" class="market-icon" name="store">
                                <path
                                    d="M11.392 7.624H9.213c-.596 0-1.081.485-1.081 1.081v1.671c0 .597.485 1.082 1.081 1.082h2.179c.596 0 1.081-.485 1.081-1.082v-1.67c0-.597-.485-1.082-1.081-1.082zM3.004.79h10.023l1.864 3.28H1.143L3.004.79zm8.408 4.062a1.51 1.51 0 0 1-2.975 0h2.975zm-3.81 0a1.51 1.51 0 0 1-1.488 1.245 1.516 1.516 0 0 1-1.491-1.245h2.978zm-6.79 0h2.979a1.514 1.514 0 0 1-2.978 0zm5.793 8.362h-2.26V8.97a.56.56 0 0 1 .56-.56h1.143a.56.56 0 0 1 .56.56v4.243h-.003zm7.264 0H7.392V8.97c0-.74-.603-1.347-1.347-1.347H4.9c-.74 0-1.346.603-1.346 1.347v4.246H2.162V6.884a2.297 2.297 0 0 0 2.044-1.012 2.297 2.297 0 0 0 3.815 0 2.291 2.291 0 0 0 3.807 0 2.297 2.297 0 0 0 1.907 1.015c.045 0 .088-.003.134-.003v6.33zm-2.182-2.838v-1.67a.296.296 0 0 0-.295-.296H9.213a.296.296 0 0 0-.295.295v1.671c0 .16.131.295.295.295h2.179c.16 0 .295-.13.295-.295zm2.048-4.275a1.51 1.51 0 0 1-1.488-1.245h2.978a1.52 1.52 0 0 1-1.49 1.245z"
                                    fill="#FFF" fill-rule="nonzero"></path>
                            </svg>
                            <div>
                                <p class="p-grey text-center">{{$mart->name}}</p>
                                <p class="p-bold text-center">{{$mart->address}}</p>
                            </div>
                        </a><span><a href="{{ route('mart', $mart->slug) }}" target="_blank"><svg height="25" viewBox="0 0 25 25" width="25"
                                    aria-label="viewstore" class="view-market-icon" name="viewstore">
                                    <g fill="none" fill-rule="evenodd">
                                        <rect fill="#eb790f" height="25" rx="3" width="25"></rect>
                                        <path
                                            d="M18.765 7.667c.117-.267.072-.561-.116-.75a.66.66 0 0 0-.46-.188.689.689 0 0 0-.347.09c-2.43 1.097-4.848 2.19-7.26 3.282l-3.966 1.79c-.317.143-.475.369-.46.67a.631.631 0 0 0 .185.426c.101.101.218.15.297.184l1.436.577c.881.354 1.766.712 2.652 1.062.388.976.776 1.952 1.171 2.927l.475 1.176c.026.071.08.192.181.294a.63.63 0 0 0 .448.184c.283.004.498-.15.637-.456 1.28-2.818 2.566-5.64 3.85-8.461.776-1.7 1.202-2.636 1.277-2.807z"
                                            fill="#FFF" fill-rule="nonzero"></path>
                                    </g>
                                </svg></a></span></div>
                    <div class="market-card-foot" id="ikeja">
                        <div><span>Opening Hours</span>
                            <p>{{$mart->working_hours}}</p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    </div>
    
    
<script type="text/javascript">
$(document).ready(function(){
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
});
</script>
@endsection
