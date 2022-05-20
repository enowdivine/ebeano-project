<style>

.block {
    background: #fff;
    border-width: 0;
    border-radius: .25rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
    margin-bottom: 1.5rem
}

.b-r {
    border-right: 1px solid rgba(160, 175, 185, .15)
}
</style>
@if (isset($sub_plan) & $sub_plan != '')
<div class="text-center">
    <div class="block d-inline-flex">
        <div class="p-4 p-sm-5 b-r"> <sup class="text-sm" style="top: -0.5em">NGN</sup><span class="h1">{{number_format($sub_plan->price,2)}}</span>
            <div class="text-muted">{{$sub_plan->name}}</div>
            <div class="py-4"><a href="#" class="btn btn-sm btn-rounded btn-primary" data-abc="true">Selected</a></div> <small class="text-muted"> this is based on your vendor type</small>
        </div>

    </div>
</div>
@else

<h5 class="text-center text-warning small">No Subscription For the selected vendor Category, default will be selected</h5>

@endif

