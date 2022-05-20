@extends('layouts.artisan')

@section('content')
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1"
            style="background: url('../images1/myhandwork_repair.jpg') repeat scroll 50% 422.28px transparent;"
            class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header wform">
                        <div class="job-search-sec">
                            <div class="job-search">
                                <h4>find handyman or artisan anywhere in Nigeria...</h4>
                                <form action="/Handworks" class="job_filters" method="post">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="job-field">
                                                <select class="chosen" id="handwork" name="handwork">
                                                    <option value="AC Installation and Repair">AC Installation and
                                                        Repair</option>

                                                </select>
                                                <i class="la la-hand-grab-o"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="job-field">

                                                <select class="chosen" id="location" name="location">
                                                    <option value="Aba">Aba</option>

                                                </select>

                                                <i class="la la-map-marker"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <button type="submit"><i class="la la-search"></i></button>
                                        </div>
                                    </div>
                                    <input name="__RequestVerificationToken" type="hidden"value="" />
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
                                            href="/Handworks?handwork=Electrical&location=Ikeja">Electrical</a></label>
                                </p>
                                <p><input type="radio" name="spealism" id="asd" /><label for="asd"><a
                                            href="/Handworks?handwork=Plumbing&location=Ikeja">Plumbing</a></label></p>
                                <p><input type="radio" name="spealism" id="errwe"><label for="errwe"><a
                                            href="/Handworks?handwork=Painting&location=Ikeja">Painting</a></label></p>
                                <p><input type="radio" name="spealism" id="fdg"><label for="fdg"><a
                                            href="/Handworks?handwork=Ceramics and Tiling&location=Ikeja">Ceramics and
                                            Tiling</a></label></p>
                                <p><input type="radio" name="spealism" id="sc"><label for="sc"><a
                                            href="/Handworks?handwork=Carpentry&location=Ikeja">Carpentry</a></label>
                                </p>
                                <p><input type="radio" name="spealism" id="aw"><label for="aw"><a
                                            href="/Handworks?handwork=Cleaning&location=Ikeja">Cleaning</a></label></p>
                                <p><input type="radio" name="spealism" id="ui"><label for="ui"><a
                                            href="/Handworks?handwork=Door Installation And Repair&location=Ikeja">Door
                                            Installation And Repair</a></label></p>
                                <p><input type="radio" name="spealism" id="saas"><label for="saas"><a
                                            href="/Handworks?handwork=Roofing&location=Ikeja">Roofing</a></label></p>
                                <p><input type="radio" name="spealism" id="rrrt"><label for="rrrt"><a
                                            href="/Handworks?handwork=Inverter Technician&location=Ikeja">Inverter
                                            Technician</a></label></p>
                                <p><input type="radio" name="spealism" id="eweew"><label for="eweew"><a
                                            href="/Handworks?handwork=Soundproof and Mini Generators&location=Ikeja">Soundproof
                                            and Mini Generators</a></label></p>
                                <p><input type="radio" name="spealism" id="bnbn"><label for="bnbn"><a
                                            href="/Handworks?handwork=CableTV and CCTV Installer&location=Ikeja">CableTV
                                            and CCTV Installer</a></label></p>
                                <p><input type="radio" name="spealism" id="ffd"><label for="ffd"><a
                                            href="/Handworks?handwork=Web Designer&location=Ikeja">Web
                                            Designer</a></label></p>
                            </div>
                        </div>
                    </div>

                    <div class="widget">

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
                                    <a href="#" title=""><img
                                            src="https://d19620mnk6hjug.cloudfront.net/BlueflashLimited.jpg" width="120"
                                            height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/BlueflashLtd"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/BlueflashLtd">Blueflash Limited</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Solar and Inverter
                                            Technician</b></span>

                                    <h6><i class="la la-map-marker"></i>Victoria Island, Lagos</h6>

                                    <p>Design, Sales, Installation and Support of INVERTER/SOLAR Power
                                        System&#xD;&#xA;Design, Sales, Installation and Support of Surveillance
                                        System&#xD;&#xA;Design, Sales, Installation and Support of Intruder/Access Cont
                                        ...</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img src="https://d19620mnk6hjug.cloudfront.net/Omotech.jpg"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/Omotech"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/Omotech">God&#x27;s will Ukhurebor</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Soundproof and Mini
                                            Generators</b></span>

                                    <h6><i class="la la-map-marker"></i>Benin City, Edo</h6>

                                    <p>We repair all kinds of generators ,both diesel and petrol generator and we help
                                        you to get it fixed whenever called.</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img
                                            src="https://d19620mnk6hjug.cloudfront.net/Urbanspace.jpeg" width="120"
                                            height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/Urbanspace"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/Urbanspace">Urban space Architects &amp; Consultants
                                            Ltd</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Carpentry</b></span>

                                    <h6><i class="la la-map-marker"></i>Mushin, Lagos</h6>

                                    <p>Design and Fabrication of interior and exterior furniture. We have very good work
                                        ethics and standards in everything we do with good years of experience.</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img
                                            src="https://d19620mnk6hjug.cloudfront.net/Derickelectrical.jpeg"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a
                                            href="/Handworks/Detail/Derickelectrical"><i class="la la-phone"></i>
                                            Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/Derickelectrical">Derick Aghedo</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Electrical</b></span>

                                    <h6><i class="la la-map-marker"></i>Benin City, Edo</h6>

                                    <p>Contact us in all types of electrical works. Such as: Conduit, surface, overhead
                                        wiring and supply of electrical materials such as: UK pipe, MCB, MK box, Y box,
                                        coupler, main bush, cooker unit box and ...</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img src="https://d19620mnk6hjug.cloudfront.net/adex.jpg"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/adex"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/adex">Adebola Iteh </a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>CCTV / Biometric Access
                                            Control</b></span>

                                    <h6><i class="la la-map-marker"></i>Lagos Island, Lagos</h6>

                                    <p>LAN cable installations,data and voice, cable management. Data centre building
                                        from the scratch,cable tray installations and cable management.&#xD;&#xA;CCTV
                                        and IPTV cabling/installations.&#xD;&#xA;UPS/Raw power cabl ...</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img src="https://d19620mnk6hjug.cloudfront.net/Olabiyi.png"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/Olabiyi"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/Olabiyi">Olabiyi Abiola</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Plumbing</b></span>

                                    <h6><i class="la la-map-marker"></i>Ikorodu, Lagos</h6>

                                    <p>Building maintenance,water treatment, drilling of borehole, installation of
                                        sanitary,uses of galvinize pipe,PVC,ppr,henco pipe, maintenance of swimming
                                        pool, we provide service 24hrs 7days</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img src="https://d19620mnk6hjug.cloudfront.net/USK Tilr.jpeg"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/USKTilr"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/USKTilr">Moses George</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Tiling</b></span>

                                    <h6><i class="la la-map-marker"></i>Abuja, Abuja</h6>

                                    <p>USK TILR INC specializes in standard industry Tiling and grouting</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img
                                            src="https://d19620mnk6hjug.cloudfront.net/FridayIbagere.jpg" width="120"
                                            height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/FridayIbagere"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/FridayIbagere">Friday Ibagere</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Plumbing</b></span>

                                    <h6><i class="la la-map-marker"></i>Lagos Island, Lagos</h6>

                                    <p>Plumbing solution to domestic and industrial work&#xD;&#xA;Surface and conduit
                                        piping( leakage)&#xD;&#xA;Installation/maintenance of sanitary
                                        appliances&#xD;&#xA;&#xD;&#xA;</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img src="https://d19620mnk6hjug.cloudfront.net/sirdam.jpg"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/sirdam"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/sirdam">Andrew Dam</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Plumbing</b></span>

                                    <h6><i class="la la-map-marker"></i>Victoria Island, Lagos</h6>

                                    <p>I can help you with your house plumbing works like borehole service and install,
                                        in house and other plumbing works</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img src="https://d19620mnk6hjug.cloudfront.net/Usman.jpg"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/Usman"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/Usman">Usman Adeshina</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Gas Man</b></span>

                                    <h6><i class="la la-map-marker"></i>Lagos State, Lagos</h6>

                                    <p>Am a good gas cutter nd I have been on it for 6 year, I cut any type of iron.etc,
                                        tank, ship, mask, iron rodu, Crain, </p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img src="https://d19620mnk6hjug.cloudfront.net/Grandeur.jpg"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/Grandeur"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/Grandeur">SLYFID VENTURES</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Tiling</b></span>

                                    <h6><i class="la la-map-marker"></i>Lagos Mainland, Lagos</h6>

                                    <p>We specialise on installation and maintenance of all kinds of tiles. We are quite
                                        experienced in this field and can handle any task or contract. Ensuring that we
                                        render the best services to our client ...</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img
                                            src="https://d19620mnk6hjug.cloudfront.net/Bosunoba123.jpg" width="120"
                                            height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/Bosunoba123"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/Bosunoba123">Oluwaseyi Oladipupo</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Painting</b></span>

                                    <h6><i class="la la-map-marker"></i>Lagos State, Ogun</h6>

                                    <p>Painting, wall skimming, Plaster of Paris(POP), 3D Wall Panel, wall Paper, Mural
                                        design, Decorative Paint like Stucco, Ottociento, Travertino, Savanna, Gravitex
                                        faux finish, Artistic work and General ...</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img src="https://d19620mnk6hjug.cloudfront.net/Gabtech.jpg"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/Gabtech"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/Gabtech">Gabriel Okugbe</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Web Designer</b></span>

                                    <h6><i class="la la-map-marker"></i>Lagos State, Lagos</h6>

                                    <p>Website design and development, ecommerce web &amp; App, portals, blogging
                                        system, payment system, mobile Apps, Social media marketing, Web design &amp;
                                        development tutor, Computer and office equipment sales, ...</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img src="https://d19620mnk6hjug.cloudfront.net/Alexander.jpg"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a href="/Handworks/Detail/Alexander"><i
                                                class="la la-phone"></i> Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/Alexander">Olusanya Alexander</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Electrical</b></span>

                                    <h6><i class="la la-map-marker"></i>Abuja, Abuja</h6>

                                    <p> Any can of Electric installation Mentance full conditi of any can of structure
                                        or building</p>
                                </div>
                            </div>
                            <div class="emply-list">
                                <div class="emply-list-thumb">
                                    <a href="#" title=""><img
                                            src="https://d19620mnk6hjug.cloudfront.net/AKOLADEOLANREWAJU.jpg"
                                            width="120" height="100" alt="" /></a>
                                    <br /><br /><br /><br /><br />
                                    <h5><span class="badge badge-info" role="button">Featured</span></h5>
                                </div>

                                <div class="emply-list-info">
                                    <div class="emply-pstn btn btn-success"><a
                                            href="/Handworks/Detail/AKOLADEOLANREWAJU"><i class="la la-phone"></i>
                                            Contact</a></div>

                                    <h3>
                                        <a href="/Handworks/Detail/AKOLADEOLANREWAJU">Akolade lanrewaju</a>
                                    </h3>

                                    <span style="font-size:small; color:#d42525"><b>Plumbing</b></span>

                                    <h6><i class="la la-map-marker"></i>Ilorin, Kwara</h6>

                                    <p> specialized in all kind of plumbing works..e.g W.C toilet, Jacuzzi bath,
                                        cubicle, shower room e.t.c</p>
                                </div>
                            </div>
                            <div class="pagination">
                                <ul>
                                    <li>
                                        &nbsp;
                                    </li>
                                    <li>
                                        <a class="active btn-success" href="/Handworks/Index?pageNumber=2"><b>Next</b>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="next btn-success" href="/Handworks/Index?pageNumber=14"><b>Last</b>
                                        </a>
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