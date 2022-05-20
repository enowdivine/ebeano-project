@if ($type == 'seller')

<!--<div class="form-group">-->
<!--    <label class="control-label mb-10" for="referer">Market Place</label>-->
<!--    <select id="marketPlace" class="form-control" name="market_place">-->
<!--        <option value="">Select</option>-->
<!--        @foreach ($category as $item)-->
<!--		    <option value="{{$item->id}}">{{$item->name}}</option>-->
<!--		@endforeach-->

<!--    </select>-->
<!--</div>-->

@elseif ($type ==  'artisan')

<div class="form-group">
    <label class="control-label mb-10" for="referer">Artisan category</label>
    <select id="artisan_category" class="form-control" name="artisan_category">
        <option value="">Select</option>
        @foreach($category as $item)
            <option value="{{$item->id}}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label class="control-label mb-10" for="referer">Other Artisan category</label>
    <input id="artisan_category_2" class="form-control" placeholder="If you selected others, please specify" name="artisan_category_2">
      
</div>
@endif