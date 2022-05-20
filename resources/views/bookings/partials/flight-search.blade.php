<form action="{{route('flight-list')}}">
    <div class="hero-search-3">
        <input type="text" name="search[trip_from]" id="trip_from" value="{{$search['trip_from']}}" placeholder="Trip From" required  autocomplete="off">
    </div>
    <div class="hero-search-3">
        <input type="text" name="search[trip_to]" id="trip_to" value="{{$search['trip_to']}}" placeholder="Trip To" required autocomplete="off">
    </div>
    <div class="hero-search-3">
        <select name="search[trip_type]" required >
            <option value="round" {{$search['trip_type'] =='round'?'selected':null }}>Round Trip</option>
            <option value="oneway" {{$search['trip_type'] =='oneway'?'selected':null }}>One-way Trip</option>
        </select>
    </div>
    <div class="hero-search-2">
        <button type="submit" class="btn btn-primary">Find</button>
    </div>
</form>