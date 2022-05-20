<?php include 'header.php'; ?>
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url(/job-stock/assets/img/banner-10.jpg);">
				<div class="container">
					<h1>Artisn Job Detail</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Candidate Detail Start -->
			<section class="detail-desc">
				<div class="container">
				
					<div class="ur-detail-wrap top-lay">
						
						<div class="ur-detail-box">
							
							<div class="ur-thumb">
								<img src="/job-stock/assets/img/com-2.jpg" class="img-responsive" alt="" />
							</div>
							<div class="ur-caption">
								<h4 class="ur-title">Software Developer</h4>
								<p class="ur-location"><i class="ti-location-pin mrg-r-5"></i>Enugu</p>
								<span class="ur-designation">Company</span>
								<div class="rateing">
									<i class="fa fa-star filled"></i>
									<i class="fa fa-star filled"></i>
									<i class="fa fa-star filled"></i>
									<i class="fa fa-star filled"></i>
									<i class="fa fa-star"></i>
								</div>
							</div>
							
						</div>
						
						<div class="ur-detail-btn">
							<a href="#" data-toggle="modal" data-target="#apply-job" class="btn btn-warning mrg-bot-10 full-width"><i class="ti-thumb-up mrg-r-5"></i>Apply For This Job</a><br>
						</div>
						
					</div>
					
				</div>
			</section>
			<!-- Candidate Detail End -->
			
			<!-- Candidate full detail Start -->
			<section class="full-detail-description full-detail">
				<div class="container">
					<div class="row">
						
						<div class="col-lg-8 col-md-8">
							
							<div class="row-bottom">
								<h2 class="detail-title">Job Description</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							</div>
							
							<div class="row-bottom">
								<h2 class="detail-title">Skills requirement</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								<ul class="detail-list">
									<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</li>
									<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
									<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
									<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
									<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
								</ul>
							</div>
							
						</div>
						
						<div class="col-lg-4 col-md-4">
						
						</div>
					
					</div>
				</div>
			</section>
			<!-- company full detail End -->
			
			<!-- More Jobs -->
			<section class="padd-top-20">
				<div class="container">
				
					<div class="row mrg-0">
						<div class="col-md-12 col-sm-12">
							<h3>Related Jobs</h3>
						</div>
					</div>
					<!--Browse Job In Grid-->
					<div class="row mrg-0">
                    <?php for($i=1; $i < 4; $i++){ ?>
						<div class="col-md-4 col-sm-6">
							<div class="grid-view brows-job-list">
								<div class="brows-job-company-img">
									<img src="/job-stock/assets/img/com-3.jpg" class="img-responsive" alt="" />
								</div>
								<div class="brows-job-position">
									<h3><a href="job-detail.html"> Solar Installation</a></h3>
									<p><span>Company</span></p>
								</div>
								
								<ul class="grid-view-caption">
									<li>
										<div class="brows-job-location">
											<p><i class="fa fa-map-marker"></i>QBL Park, C40</p>
										</div>
									</li>
								</ul>
								
							</div>
                        </div>
                        
                    <?php } ?>	
						
						
					</div>
					<!--/.Browse Job In Grid-->
					
				</div>
			</section>
            <!-- More Jobs End -->
            
            <div class="modal fade" id="apply-job" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							
							<div class="new-logwrap">
						
								<div class="form-group">
									<label>Are you registered Artisan ?</label>
		
								</div>
								
								
								
								<div class="form-groups">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-info full-width">Yes</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-sm btn-danger full-width">No</button> 
                                        </div>
                                    </div>
                                    
                                    
                                    
								</div>
								
								
							</div>
							
						</div>
						</div>
				</div>
			</div> 
<?php include 'footer.php'; ?>