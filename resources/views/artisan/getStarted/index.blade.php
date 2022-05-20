 
 @extends('layouts.artisan')

 @section('content')
 <section><br /><br /></section>
 <section>
     <div class="block remove-bottom">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="account-popup-area signup-popup-box static">
                         <div class="account-popup">

                             <br />
                             <h3>Tell us about yourself</h3>

                             <form action="/Account/getStarted" method="post">
                                 <p>
                                     <div class="btn btn-lg btn-success active"><a href="../Signup"> I am a Handyman, I
                                             can help you Get it fixed . .</a></div>
                                 </p>
                                 <p>
                                     <div class="btn btn-lg btn-info active"><a href="../ClientSignUp">I am a Client, I
                                             need the service of a handyman</a></div>
                                 </p>
                                 <br /> <br /> <br /> <br /> <br />
                                 <input name="" type="hidden" value="" />
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
@endsection