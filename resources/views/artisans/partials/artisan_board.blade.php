<div class="card shadow-sm my-4 px-3 rounded justify-content-center border-0">
    <div class="card-title px-3 py-2 mb-0">
        <h4 class="">Artisan Account Overview</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card rounded mb-4">
                    <div class="card-title d-flex mb-0 border-bottom p-2 justify-content-between">
                        <h5 class=" font-weight-light ">My Public Profile</h5>
                        <button class="btn btn-sm"><i class="la link la-edit"></i></button>
                    </div>
                    <div class="card-body">
                    <h6 class="m-0">{{Auth::user()->name}}</h6>
                       <span class="d-block">{{Auth::user()->email}}</span>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card wallet rounded mb-4">
                    <div class="card-title mb-0  border-bottom p-2 d-flex justify-content-between">
                        <h5 class=" font-weight-light">Wallet Balance</h5>
                        
                    </div>
                    <div class="card-body">
                        <div class="font-weight-bold text-center text-primary amt">
                        <span class="la la-wallet"></span>    ₦{{number_format($artisan['balance'],2)}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class=" card rounded mb-4">
                    <div class="card-title mb-0 border-bottom p-2 d-flex justify-content-between">
                        <h5 class=" font-weight-light">Address</h5>
                        <button class="btn btn-sm"><i class="la link la-edit"></i></button>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>