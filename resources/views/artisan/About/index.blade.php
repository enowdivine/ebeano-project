 @extends('layouts.artisan')


 @section('link')
     
 @endsection

@section('script')
  <script>
    "use strict";

    !function () {
        var t = window.driftt = window.drift = window.driftt || [];
        if (!t.init) {
            if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
            t.invoked = !0, t.methods = ["identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on"],
                t.factory = function (e) {
                    return function () {
                        var n = Array.prototype.slice.call(arguments);
                        return n.unshift(e), t.push(n), t;
                    };
                }, t.methods.forEach(function (e) {
                    t[e] = t.factory(e);
                }), t.load = function (t) {
                    var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
                    o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
                    var i = document.getElementsByTagName("script")[0];
                    i.parentNode.insertBefore(o, i);
                };
        }
    }();
    drift.SNIPPET_VERSION = '0.3.1';
    drift.load('igakb3bpvmgb');
</script>
@endsection

@section('content')
    

<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 column">
                    <div class="blog-single">
                        <div class="bs-thumb"><img src="/Uploads/General/myhandworkng_blog.jpg" alt="" /></div>
                        <ul class="post-metas"><li><a href="#" title=""><img src="/Uploads/Images/handyman_ngList.png" width="40" height="40" alt="" />myhandwork.ng</a></li><li><a href="#" title=""><i class="la la-calendar-o"></i>June 12, 2019</a></li><li><a class="metascomment" href="#" title=""></li><li><a href="#" title=""><i class="la la-file-text"></i>Handyman, Artisans in Nigeria</a></li></ul>
                        <h2>About myhandwork.ng</h2>
                        <p>
                            myhandwork.ng is an online platform where you can find, hire and pay a handyman or artisan anywhere in Nigeria.
                            Designed to enable people from all over Nigeria connect with handymen or artisans around their location and anywhere in Nigeria. 
                                                        
                        </p>
                        <p>
                            Are you an artisan Nigeria in need of artisan jobs in Nigeria? Do you want to hire artisans in Nigeria to do
                            artisan jobs in Nigeria or provide artisan services in Nigeria for you, your business or organization?
                            Register now on myhandwork.ng
                        </p>
                        <p>
                            On myhandwork.ng, Clients who have major projects can also register and post handyman or artisan jobs which 
                            requires a specific handyman in a particular area in Nigeria.
                        </p>

                        <h2>How it works.</h2>
                        <p></p>
                        <h3>handyman or artisans in Nigeria</h3>
                        <p>
                            Click on Get started to register and select "I Can Get It Fixed", then register as a handyman.
                            The application has been developed to guide you through the on-boarding process. After a successful registration,
                            login (using your phone number or email address), submit a valid means of identification such as  
                            INEC voters card or National ID or international passport or tax receipt or other valid means of
                            identification, then wait for your account to be verified and listed.
                        </p>
                        <p></p>

                        <h3>Top Search Feature on myhandwork.ng</h3>
                        <p>
                            When your account has "top search enabled", it means your profile will be among the top listed profiles on myhandwork.ng
                            and also on various search list that fit your handwork or location.
                        </p>
                        <p>
                            To Enable to "Top Search" on your profile, login to your account on myhandwork.ng and on your dashboard, click on "Enable Top Search" and complete the process. This would require an affordable fee.
                        </p>

                        <p></p>

                        <h3>Clients on myhandwork.ng</h3>

                        <p>
                            Click on Get Started and select "I need the service of a handyman",  then complete the registeration process, login (using your phone number or email address),  
                            and submit a valid means of identification  such as voters card or National ID or international passport).
                            You can now find, hire and pay handymen or artisans on te platform.
                        </p>

                        <p></p>

                        <h3>Client Payment to handymen or artisans on myhandwork.ng</h3>
                        <p>
                            Client can deposit payment for any assigned task to handymen and also approved payment to handyman after the task has been confirmed completed by handyman.
                            Payment will be made to handyman 48hrs after Client approval.
                        </p>

                        <div class="tags-share">
                            <div class="tags_widget">
                                <span>Tags</span>
                                <a href="#" title="">artisans</a>
                                <a href="#" title="">handyman</a>
                                <a href="#" title="">find artisans in Nigeria</a>
                            </div>
                            <div class="share-bar">
                                <a href="#" title="" class="share-fb"><i class="fa fa-facebook"></i></a><a href="#" title="" class="share-twitter"><i class="fa fa-twitter"></i></a><a href="#" title="" class="share-google"><i class="la la-google"></i></a><span>Share</span>
                            </div>
                        </div>
                        <div class="post-navigation ">
                            <div class="post-hist prev">
                                <a href="/Home/Find_a_handyman_or_artisan_in_Nigeria" title=""><i class="la la-arrow-left"></i><span class="post-histext">Prev Post<i>Finding a handyman or artisan in Nigeria</i></span></a>
                            </div>
                            <div class="post-hist next">
                                <a href="/Home/About_myhandworkng" title=""><span class="post-histext">Next Post<i>About myhandwork.ng</i></span><i class="la la-arrow-right"></i></a>
                            </div>
                        </div>


                    </div>
                </div>

                <aside class="col-lg-3 column">

                    <div class="widget">
                        <h3>Recent Posts</h3>
                        <div class="post_widget">
                            <div class="mini-blog">
                                <span><a href="#" title=""><img src="/Uploads/Images/handyman_ngList.png" width="74" height="64" alt="" /></a></span>
                                <div class="mb-info">
                                    <h3><a href="/Home/Find_a_handyman_or_artisan_in_Nigeria" title="">Finding a handyman or artisan in Nigeria</a></h3>
                                    <span>June 12, 2019</span>
                                </div>
                            </div>
                            <div class="mini-blog">
                                <span><a href="#" title=""><img src="/Uploads/Images/handyman_ngList.png" width="74" height="64" alt="" /></a></span>
                                <div class="mb-info">
                                    <h3><a href="/Home/About_myhandworkng" title="">About myhandwork.ng</a></h3>
                                    <span>June 12, 2019</span>
                                </div>
                            </div>

                            <div class="mini-blog">
                                <span><a href="#" title=""><img src="/Uploads/Images/handyman_ngList.png" width="74" height="64" alt="" /></a></span>
                                <div class="mb-info">
                                    <h3><a href="/Home/Video_How_to_register_on_myhandworkng" title="">Video: How To Register</a></h3>
                                    <span>November 16, 2019</span>
                                </div>
                            </div>

                            <div class="mini-blog">
                                <span><a href="#" title=""><img src="/Uploads/Images/handyman_ngList.png" width="74" height="64" alt="" /></a></span>
                                <div class="mb-info">
                                    <h3><a href="/Home/Video_How_it_works" title="">Video: How it works</a></h3>
                                    <span>December 13, 2019</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    

                    <div class="widget">
                        <h3>Tags</h3>
                        <div class="tags_widget">
                            <a href="#" title="find a plumber in Nigeria">Plumber</a>
                            <a href="#" title="find a painter in Nigeria">Painter</a>
                            <a href="#" title="">Landscaping</a>
                            <a href="#" title="">Furniture Refinishing</a>
                            <a href="#" title="">Pest Control</a>
                            <a href="#" title="">MakeUp Artist</a>
                            <a href="#" title="find a painter in Nigeria">Swimming Pool</a>
                            <a href="#" title="">CCTV </a>
                            <a href="#" title="">Tailor</a>
                            <a href="#" title="">Aluminium Windows </a>
                            <a href="#" title="">Window Installation </a>
                            <a href="#" title="">Air Condition Install and Repair</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection