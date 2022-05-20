@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Brands</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{url('eb-admin')}}">Dashboard</a></li>
                <li class="active"><span>Brands</span></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    
    <!-- /Title -->
    <!-- Row -->
    <div class="row">
        <div class="col-sm-6">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        @if(Session::has('error'))
        <div class="alert alert-info">
            {{Session::get('error')}}
        </div>
    @endif 

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{isset($edit)?('Edit Brand'):('Add Brand')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
               


                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        
                        <div class="form-wrap">
                        <form class="" action="{{isset($edit)?url('eb-admin/brands/update/'.$edit->id):route('brand.add')}}" method="POST" enctype="multipart/form-data" >
                            
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label mb-10" for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{!empty($edit->name)?$edit->name:('')}}" id="name">
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="input-file-now-custom-1">Logo <span class="small">(150x130)</span></label>
                                    <input type="file" id="input-file-now-custom-1" name="logo" class="dropify"
                                        data-default-file="{{!empty($edit->logo)?asset('storage/'.$edit->logo):('')}}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="metaTitle">Meta title</label>
                                    <input id="metaTitle" type="text" class="form-control" name="meta_title" value="{{!empty($edit->meta_title)?$edit->meta_title:('')}}">
                                </div>
    
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left" for="desc">Description</label>
                                    <textarea id="desc" class="form-control" name="description" rows="5">{{!empty($edit->meta_description)?$edit->meta_description:('')}}</textarea>
                                </div>

                                <div class="form-group mb-0">
                                    <input type="submit" name="save" class="btn btn-success btn-anim" value="{{isset($edit)?('update'):('add')}}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
</div>
@endsection