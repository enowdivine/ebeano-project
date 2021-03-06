@extends('layouts.booking')

@section('title', 'Edit Coupon')

@section('content')
<div class="row">
    @php
       $name = Str::of(Auth::user()->name)->explode(' ');
       $user_name = $name[0];
    @endphp
    <div class="col-lg-3">
        @include('bookings/partials/menuhome')
    </div>
    
    <div class="col-lg-9">
    <div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
            <div class="card-header bg-white">
            <h2>Edit Coupon
                <a class="btn btn-tsk float-right" href="{{route('coupon')}}"><i class="fa fa-list"></i> Coupon List</a>

            </h2>
        </div>
        <div class="card-body">
            <form action="{{route('coupon.update',$couponMaster->id)}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Offer Title</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="offer_title" placeholder="Offer Title" value="{{$couponMaster->offer_title}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Coupon Code</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="code" placeholder="Code" value="{{$couponMaster->code}}">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Period Start Date</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="period_start_time" id="period_start_time" placeholder="Period Start Date" value="{{date('Y/m/d H:i',strtotime($couponMaster->period_start_time))}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Period End Date</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="period_end_time" id="period_end_time" placeholder="Period End Date" value="{{date('Y/m/d H:i',strtotime($couponMaster->period_end_time))}}">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Coupon Type</strong> <small class="text-danger">*</small></label>
                        <select class="form-control form-control-lg" name="type">
                            <option value="PERCENTAGE" {{$couponMaster->type === 'PERCENTAGE'?'selected':''}}>Percentage</option>
                            <option value="FIXED"  {{$couponMaster->type === 'FIXED'?'selected':''}}>Fixed</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Coupon Value</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="value" placeholder="Value" value="{{$couponMaster->value}}">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Minimum Amount</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="min_amount" placeholder="Minimum Amount" value="{{$couponMaster->min_amount}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Max Amount</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="max_amount" placeholder="Max Amount" value="{{$couponMaster->max_amount}}">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label><strong>Limit Per User</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="limit_per_user" placeholder="Limit Per User" value="{{$couponMaster->limit_per_user}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label><strong>Limit Per Coupon</strong> <small class="text-danger">*</small></label>
                        <input type="text" class="form-control form-control-lg" name="limit_per_coupon" placeholder="Limit Per Coupon" value="{{$couponMaster->limit_per_coupon}}">
                    </div>
                </div>

                <div class="form-row justify-content-center">

                    <div class="form-group col-md-12">
                        <label><strong>Include Room Type</strong> <small class="text-danger">*</small></label>
                        <br/>
                        @foreach($room_types as $room_type)
                            <div class="custom-control custom-checkbox d-inline">
                                <input type="checkbox" class="custom-control-input" {{in_array($room_type->id ,$couponMaster->roomType->pluck('id')->toArray())?'checked':''}} id="room_type_{{$room_type->id}}" name="room_type[]" value="{{$room_type->id}}">
                                <label class="custom-control-label pr-4" for="room_type_{{$room_type->id}}">{{$room_type->title}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-row justify-content-center">

                    <div class="form-group col-md-12">
                        <label><strong>Paid Service</strong> <small class="text-danger">*</small></label>
                        <br/>
                        @foreach($paid_services as $paid_service)
                            <div class="custom-control custom-checkbox d-inline">
                                <input type="checkbox" class="custom-control-input" {{in_array($paid_service->id ,$couponMaster->paidService->pluck('id')->toArray())?'checked':''}} id="paid_service_{{$paid_service->id}}" name="paid_service[]" value="{{$paid_service->id}}">
                                <label class="custom-control-label pr-4" for="paid_service_{{$paid_service->id}}">{{$paid_service->title}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-12">
                        <label><strong>Description</strong><small> (optional)</small> </label>
                        <textarea  class="form-control form-control-lg" rows="4" name="description" id="description" placeholder="Description">{{ $couponMaster->description }}</textarea>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-12">
                        <label><strong>Offer Image</strong> </label>

                        <div class="mb-3">
                            <img src="{{asset('assets/backend/image/coupon/'.$couponMaster->image)}}" style="max-height: 150px">
                        </div>
                        <input type="file" class="form-control form-control-lg" name="image" >
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <label for="inputAddress2" class=" mr-5">Status</label>
                        <input id="status" {{$couponMaster->status?'checked':''}} type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" name="status">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12">
                        <hr/>
                        <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
        </div>

</div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#period_start_time').datetimepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy/mm/dd HH:MM',
                footer: true, modal: true
            });
            $('#period_end_time').datetimepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy/mm/dd HH:MM',
                footer: true, modal: true
            });
        });
        bkLib.onDomLoaded(function() {
            new nicEditor({
                iconsPath : '{{asset('assets/booking/assets/plugin/niceditor/nicEditorIcons.gif')}}',
                fullPanel : true
            }).panelInstance('description');
        });
    </script>
@endsection