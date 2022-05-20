@extends('layouts.artisan')

@section('content')

    <section class="overlape">
        <div class="block no-padding">
            <div data-velocity="-.1"
                style="background: url('../imgaes1/myhandwork_repair.jpg') repeat scroll 50% 422.28px transparent;"
                class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-header wform">
                            <div class="job-search-sec">
                                <div class="job-search">
                                    <h4>find handyman or artisan job anywhere in Nigeria...</h4>
                                    <form action="/Handworks/handyJobs" class="job_filters" method="post">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="job-field">
                                                    <select class="chosen" id="JobType" name="JobType">
                                                        <option value="AC Installation and Repair">AC Installation and
                                                            Repair</option>

                                                    </select>

                                                    <i class="la la-map-marker"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <button class="btn-danger" type="submit"><i
                                                        class="la la-search"></i></button>
                                            </div>
                                        </div>
                                        <input name="__RequestVerificationToken" type="hidden"
                                            value="CfDJ8GWqW66mGW5OvVk-MSZBP5SgFSH3Xt2DtkypfUa3kCWbF9Yu-pV3Jmu7IO42j8id5utddZlUF9IS7Ey2CMIm5MOl8ebuCR5_Sfl2b-5LuhtCS6AWrPcfI7cNRVA2uR5ysy5iLzrwu4SIYBiIDKq2K0M" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block less-top">
            <div class="container">
                <div class="row no-gape">

                    <aside class="col-lg-3 column margin_widget">

                        <div class="widget d-none d-sm-block">
                            <h3 class="sb-title open">Specialism</h3>
                            <div class="specialism_widget">
                                <div class="simple-checkbox scrollbar">
                                    <p><input type="radio" name="spealism" id="as" /><label for="as"><a
                                                href="/Handworks/handyJobs?JobType=Electrical&location=Nigeria"
                                                target="_blank">Electrical</a></label></p>
                                    <p><input type="radio" name="spealism" id="asd" /><label for="asd"><a
                                                href="/Handworks/handyJobs?JobType=Plumbing&location=Nigeria">Plumbing</a></label>
                                    </p>
                                    <p><input type="radio" name="spealism" id="errwe"><label for="errwe"><a
                                                href="/Handworks/handyJobs?JobType=Painting&location=Nigeria">Painting</a></label>
                                    </p>
                                    <p><input type="radio" name="spealism" id="fdg"><label for="fdg"><a
                                                href="/Handworks/handyJobs?JobType=Ceramics and Tiling&location=Nigeria">Ceramics
                                                and Tiling</a></label></p>
                                    <p><input type="radio" name="spealism" id="sc"><label for="sc"><a
                                                href="/Handworks/handyJobs?JobType=Carpentry&location=Nigeria">Carpentry</a></label>
                                    </p>
                                    <p><input type="radio" name="spealism" id="aw"><label for="aw"><a
                                                href="/Handworks/handyJobs?JobType=Cleaning&location=Nigeria">Cleaning</a></label>
                                    </p>
                                    <p><input type="radio" name="spealism" id="ui"><label for="ui"><a
                                                href="/Handworks/handyJobs?JobType=Door Installation And Repair&location=Nigeria">Door
                                                Installation And Repair</a></label></p>
                                    <p><input type="radio" name="spealism" id="saas"><label for="saas"><a
                                                href="/Handworks/handyJobs?JobType=Roofing&location=Nigeria">Roofing</a></label>
                                    </p>
                                    <p><input type="radio" name="spealism" id="rrrt"><label for="rrrt"><a
                                                href="/Handworks/handyJobs?JobType=Inverter Technician&location=Nigeria">Inverter
                                                Technician</a></label></p>
                                    <p><input type="radio" name="spealism" id="eweew"><label for="eweew"><a
                                                href="/Handworks/handyJobs?JobType=Soundproof and Mini Generators&location=Nigeria">Soundproof
                                                and Mini Generators</a></label></p>
                                    <p><input type="radio" name="spealism" id="bnbn"><label for="bnbn"><a
                                                href="/Handworks/handyJobs?JobType=CableTV and CCTV Installer&location=Nigeria">CableTV
                                                and CCTV Installer</a></label></p>
                                    <p><input type="radio" name="spealism" id="ffd"><label for="ffd"><a
                                                href="/Handworks/handyJobs?JobType=Web Designer&location=Nigeria">Web
                                                Designer</a></label></p>
                                </div>
                            </div>
                        </div>

                        <div class="widget">
                            <!-- side 2 Ads

                            Google Adsense side bar script

                        -->
                        </div>
                    </aside>

                    <div class="col-lg-9 column">
                        <div class="padding-left">
                            <p></p>

                            <p></p>
                            <p></p>

                            <div class="emply-list-sec style2">
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/239.jpg"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/239"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/239">Video Editor at McBuddy Digital
                                                Services Limited</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Magodo, Lagos, Lagos
                                                    Mainland</b></span></h6>

                                        <p>Shoot captivating videos especially for social media, Trimming footages and
                                            fine- tuning the content for smooth running of production, Editing videos,
                                            ability to use special effects such as Music, Sou ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/238.jpg"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/238"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/238">Chef at Owens and Xley Consults</a>
                                        </h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Lekki, Lagos, Lagos
                                                    State</b></span></h6>

                                        <p>The Chef is responsible for controlling and directing the food preparation
                                            process for the company</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/237.jpg"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/237"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/237">Dress Makers (Tailors) at Afroattire
                                                Clothing</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Kano, Kano State</b></span>
                                        </h6>

                                        <p>Do you have the skill and ability to sew both male and female garments? Can
                                            you develop, copy, or adapt designs for garments, and design patterns to fit
                                            measurements, applying knowledge of garment des ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/236.png"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/236"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/236">Dispatch Rider at Avidexpress
                                                Delivery Service</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Lagos, Lagos state, Lagos
                                                    State</b></span></h6>

                                        <p>Be in charge with morning pickups of deliveries as early as 7am in designated
                                            or assigned locations. Be charged with smart and fast deliveryof picked
                                            items to their respective locations. Riders determ ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/235.jpg"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/235"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/235">Chef / Cook at Haven Kitchen &amp;
                                                Cafe (HKC)</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Gwarinpa, Abuja,
                                                    Abuja</b></span></h6>

                                        <p>We require for immediate employment a Chef who will be saddled with the
                                            responsibility of managing the kitchen and also preparing meals in a neat,
                                            efficient and organized manner.</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/234.jpg"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/234"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/234">Cook at Intercommunity Development
                                                Society</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Brono State, (Mafa and
                                                    Kukawa), Mafa</b></span></h6>

                                        <p>The cook is responsible for preparing meals on request for target population,
                                            in accordance with&#xD;&#xA;the rules of hygiene. He/she is also responsible
                                            for purchasing the food and equipment necessary for t ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/233.png"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/233"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/233">Driver at Invent Alliance
                                                Limited</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Lagos, Lagos state, Lagos
                                                    State</b></span></h6>

                                        <p>The ideal candidate must have at least 2 years&#x2019; experience, a minimum
                                            of OND, a valid drivers license and must be resident within Ajah/Sangotedo
                                            axis.</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/232.jpg"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/232"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/232">Auto Electrician (Heavy Duty) at A.G
                                                Leventis Nigeria Limited</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Abuja (FCT), Abuja</b></span>
                                        </h6>

                                        <p>Inspect vehicle electrical components to diagnose issues accurately, Conduct
                                            routine maintenance work aiming to vehicle functionality and longevity,
                                            Maintains vehicle functional condition by listening ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/231.jpg"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/231"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/231">Baker at Winnys Meals on the
                                                Move</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Asokoro, Abuja,
                                                    Abuja</b></span></h6>

                                        <p>Mixing, preparing and baking bread and pastries.&#xD;&#xA;Ordering more
                                            supplies. Crafting and creating new and exciting baked goods. Ensuring all
                                            baked goods are completed on time for opening. Ability to rea ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/230.png"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/230"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/230">Paint Supervisor at Prezicon
                                                Limited</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Nigeria, Lagos
                                                    State</b></span></h6>

                                        <p>The Paint Supervisor is responsible for the coordination of work activities.
                                            He is considered the leader of his working team and is responsible to
                                            complete work activities as per Site Manager&#x2019;s instru ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/229.jpg"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/229"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/229">Quantity Surveyor at Menzon
                                                Limited</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Abuja (FCT), Abuja</b></span>
                                        </h6>

                                        <p>We are looking to hire Quantity Surveyor. Successful candidate will be
                                            involved in maximizing project margin, adding value to the construction
                                            process by proactive involvement in procurement, cost man ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/228.jpg"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/228"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/228">Grill Chef at Strugz</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Lekki, Lagos, Lagos
                                                    Island</b></span></h6>

                                        <p>Proven knowledge in making; Shawarma, chicken &amp; chips, stir fry, indomie,
                                            etc Slicing, cutting, shredding, tenderizing, and skewering meat and
                                            vegetables. Braising and grilling meat and vegetables. Ch ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/227.png"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/227"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/227">Dispatch Rider at Awoof Berekete
                                                &#x2013; Pragmatic Technologies</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Obanikoro, Lagos, Lagos
                                                    Mainland</b></span></h6>

                                        <p>Applicants must have a valid rider&#x2019;s license, Applicants must have at
                                            least 1-year riding and delivery experience, Applicants must be familiar
                                            with and know Lagos routes, Applicants must be smart and ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img src="https://d3ty35mhs7yv2e.cloudfront.net/226.jpg"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/226"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/226">Technical / Service Engineer at
                                                Tenaui Africa Limited</a></h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Abuja (FCT), Abuja</b></span>
                                        </h6>

                                        <p>Carry out Installations of large format production machines at
                                            customer&#x2019;s site. Inspect, maintain and service large format machines.
                                            Maintain good rapport with customers by examining complaints, ident ...</p>
                                    </div>
                                </div>
                                <div class="emply-list">
                                    <div class="emply-list-thumb">
                                        <a href="#" title=""><img
                                                src="https://d3ty35mhs7yv2e.cloudfront.net/handyman_ngList.png"
                                                width="80" height="85" alt="" /></a>

                                    </div>
                                    <div class="emply-list-info">
                                        <div class="emply-pstn btn btn-success"><a
                                                href="/Handworks/handyJobDetail/225"><i class="la la-re"></i>Apply</a>
                                        </div>
                                        <h3><a href="/Handworks/handyJobDetail/225">Grill Chef at Strugz Nigeria</a>
                                        </h3>

                                        <h6><i class="la la-map-marker"></i><span
                                                style="font-size:small; color:#d42525"><b>Lekki, Lagos, Lagos
                                                    Island</b></span></h6>

                                        <p>Slicing, cutting, shredding, tenderizing, and skewering meat and vegetables.
                                            Braising and grilling meat and vegetables.&#xD;&#xA;Checking that
                                            ingredients remain fresh and safe for consumption.</p>
                                    </div>
                                </div>
                                <div class="pagination">
                                    <ul>
                                        <li>
                                            &nbsp;
                                        </li>
                                        <li>
                                            <a class="active btn-success"
                                                href="/Handworks/handyJobs?pageNumber=2"><b>Next</b> </a>
                                        </li>
                                        <li>
                                            <a class="next btn-success"
                                                href="/Handworks/handyJobs?pageNumber=14"><b>Last</b> </a>
                                        </li>

                                    </ul>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

