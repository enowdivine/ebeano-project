<form action="{{route('room-list')}}">
    <div class="row" style="padding-right:8px;padding-left:8px">
        <div class="col-md-2">
            <div class="form-group">
                <select class="form-control" name="state" required >
                    @foreach (\App\State::all() as $state)
						<option value="{{$state->state_id}}">{{$state->name}}</option>
						@endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input class="form-control" type="text" name="search[arrival]" id="arrival" value="{{$search['arrival']}}" placeholder="Arrival Date" required  autocomplete="off">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input class="form-control" type="text" name="search[departure]" id="departure" value="{{$search['departure']}}" placeholder="Departure Date" required autocomplete="off">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <select class="form-control" name="search[adults]" required >
                    @for($i=0;$i <= 8;$i++)
                        <option value="{{$i}}" {{$search['adults'] ==$i?'selected':null }}>{{$i?$i:'Adults'}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <select class="form-control" name="search[children]" required >
                    <option value="0">Children</option>
                    @for($i=1;$i <= 7;$i++)
                        <option value="{{$i}}" {{$search['children'] ==$i?'selected':null }}>{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </div>
</form>