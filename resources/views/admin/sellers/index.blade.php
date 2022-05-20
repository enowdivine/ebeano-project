@extends('layouts.app')

@section('content')

<div class="container-fluid">
				
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Manage Seller</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="eb-admin">Dashboard</a></li>
            <li class="active"><span>seller list</span></li>
          </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <!-- /Title -->

    <div class="row">

        <div class="col-sm-12">
            <div class="pull-right mb-20">
                <a class="btn btn-sm btn-primary btn-anim" href="{{url('eb-admin/seller/add')}}"><span>Add new</span></a>
            </div>
            
        </div>

    </div>
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">seller list</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="">
                                <table id="datable_g_1" class="table table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Verification status</th>
                                            <th>Approval</th>
                                            <th>Registered by</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sellers = App\Seller::all();
                                            
                                            if (Auth::user()->user_type == 'staff'){

                                                $sellers = App\Seller::where('registered_by', Auth::user()->id)->get();
                                            }
                                            
                                            $i = 0;
                                        @endphp
                                        @if ($sellers != null)
                                       @foreach ($sellers as $key => $seller)
                                       @php 
                                       $i += 1;
                                       $seller_profile = App\User::where('id',$seller->user_id)->first();
                                       @endphp
                                       @if ($seller_profile != null)
                                       <tr>

                                        <td>{{$i}}</td>
                                       <td>{{$seller_profile['name']}}</td>
                                       <td>{{$seller_profile->email}}</td>
                                       <td>{{$seller_profile->phone}}</td>
                                       <td><span class="text-info">{{$seller->verification_info}}</span></td>
                                       <td>
                                            @if($seller->verification_status == 1)
                                                <span class="label label-success">Approved</span>
                                            @else
                                                <span class="label label-danger">Unapproved</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $reg_by=App\User::where('ref_code', $seller_profile->referer)->first();
                                                if ($reg_by == null){

                                                   $reg_by=App\Marketer::where('ref_code', $seller_profile->referer)->first();
                                                }
                                                 if (!empty($reg_by->name)){
                                                        echo strtoupper($reg_by->name);
                                                    }else {
                                                        echo "Admin";
                                                    }
                                                    
                                            @endphp
                                        </td>
                                       <td>
                                        <div class="btn-group z-index-10">
											<div class="pull-left d-inline-block dropdown">
												<a href="#" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle " type="button"> <i class="zmdi zmdi-more-vert"></i></button>
												<ul role="menu" class="dropdown-menu dropdown-menu-right">
													<li>
														<a href="{{url('eb-admin/seller/edit/'.$seller->id)}}"><i class="zmdi zmdi-edit"></i><span>Edit</span></a>
													</li>
													<li>
														<a href="{{url('eb-admin/seller/stores/'.$seller->id)}}"><i class="zmdi zmdi-card"></i><span>Store</span></a>
													</li>
													<li>
														
														@if($seller->verification_status == 1)
                                                            <a href="#deactivate"><i class="zmdi zmdi-power-off"></i><span>Unapprove</span></a>
                                                        @else
                                                            <a href="{{url("eb-admin/seller/approve/".$seller->id)}}"  data-toggle="tooltip" data-original-title="Approve"> <i class="zmdi zmdi-check"></i>Approve </a>
                                                        @endif
													</li>
													
												</ul>
											</div>
										</div>
                                    </td>
                                        
                                    </tr>
                                        @endif
                                       @endforeach
                                       @endif 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->
</div>

{{-- <div id="editSeller" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">Edit Seller Info</h5>
            </div>
            <form>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label class="control-label mb-10" for="bank">Bank:</label>
                            <select id="bank" name="bank_name" class="form-control required">
                                @foreach ($banks as $bank)
                                <option value="{{$bank->id}}" {{($data['bank_name'] ?? '' == $bank->id)?'selected':''}}>{{$bank->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-10" for="accNo">Account Number:</label>
                            <input type="text" id="accNo" class="form-control required"
                                name="bank_account_no" value="{{$data['bank_account_no'] ?? ''}}" />
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-10" for="accName">Account Name:</label>
                            <input type="text" id="accName" class="form-control  required"
                                name="bank_account_name" value="{{$data['bank_account_name'] ?? ''}}" />
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>  --}}
@endsection