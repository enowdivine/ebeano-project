<?php include 'header.php'; ?>
            <!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url(/job-stock/assets/img/bn2.jpg);">
				<div class="container">
					<h1>Artisn Job listing</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<section class="advance-search">
				<div class="container">
					<div class="row">
					
						<div class="col-md-4 col-sm-12">
							<div class="full-sidebar-wrap">
								
								<a href="javascript:void(0)" onclick="openNav()" class="btn btn-dark full-width mrg-bot-20 hidden-lg hidden-md hidden-xl"><i class="ti-filter mrg-r-5"></i>Filter Search</a>
								
								<!-- Job Alert -->
								<!-- <a href="javascript:void(0)" class="btn btn-info full-width mrg-bot-20" data-toggle="modal" data-target="#job-alert">Get Job Alert!</a> -->
								<!-- /Job Alert -->
								
								<div class="show-hide-sidebar hidden-xs hidden-sm">
								
									<!-- Search Job -->
									<div class="sidebar-widgets">
									
										<div class="ur-detail-wrap">
											<div class="ur-detail-wrap-header">
												<h4>Search Artisn Job Here</h4>
											</div>
											<div class="ur-detail-wrap-body">
												<form>
													<div class="form-group">
														<label>Keyword</label>
														<input type="text" class="form-control" placeholder="Job Title or Keyword">
													</div>
													<div class="form-group">
														<label>Location</label>
														<input type="text" class="form-control" placeholder="ex. Enugu">
													</div>
													<div class="form-group">
														<label>Category</label>
														<select id="choose-category" class="form-control">
															<option>Choose Category</option>
															<option>Banking Job</option>
															<option>IT / Software</option>
															<option>Medical & Hospital</option>
															<option>Networking</option>
															<option>Automotive</option>
															<option>Business Development</option>
														</select>
													</div>
													<button type="submit" class="btn btn-primary full-width">Find Artisn Job</button>
												</form>
											</div>
										</div>
										
									</div>
									<!-- /Search Job -->
								</div>
								
							</div>
						</div>
					
						<div class="col-md-8 col-sm-12">
							
							<!--Filter -->							
							<div class="row">
								<div class="col-md-12">
									<div class="filter-wraps">
										
										<div class="filter-wraps-one">
											<i class="ti-search"></i>
											<ul>
												<li><a href="#">CSS3<i class="ti-close"></i></a></li>
												<li><a href="#">Wordpress<i class="ti-close"></i></a></li>
												<li><a href="#">Photoshop<i class="ti-close"></i></a></li>
											</ul>
										</div>
										<div class="filter-wraps-two">
											<h5><a href="#">RESET FILTERS</a></h5>
										</div>
										
									</div>
								</div>
							</div>
							<!--/.Filter -->
							
							<!--Browse Candidates -->							
							<div class="row">
								<div class="col-md-12">
                                    
                                <?php for($i=1; $i < 9; $i++){ ?>
									<!-- Single Candidate List -->
									<div class="candidate-list-layout">
										<div class="cll-wrap">
											<div class="cll-thumb">
												<a href="resume-detail.html"><img src="/job-stock/assets/img/can-1.png" class="img-responsive img-circle" alt="" /></a>
											</div>
											<div class="cll-caption">
												<h4><a href="resume-detail.html">Web Designer</a><span><i class="ti-briefcase"></i>posted by: Ebeano</span></h4>
												<ul>
													<li><i class="ti-location-pin cl-danger"></i>801 Harper Street, India</li>
													
												</ul>
											</div>
										</div>
										
										<div class="cll-right">
											<a href="#" class="btn theme-btn btn-shortlist">Apply</a>
										</div>
                                    </div>
                                <?php } ?>
									
								</div>
							</div>
							<!--/.Browse Job-->
							
							
							<div class="row mrg-0">
								<ul class="pagination">
									<li><a href="#"><i class="ti-arrow-left"></i></a></li>
									<li class="active"><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li> 
									<li><a href="#">4</a></li> 
									<li><a href="#"><i class="fa fa-ellipsis-h"></i></a></li> 
									<li><a href="#"><i class="ti-arrow-right"></i></a></li> 
								</ul>
							</div>
							
						</div>
						
					</div>
				</div>
            </section>
            <div id="filter-sidebar" class="filter-sidebar">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="ti-close"></i></a>
				<div class="show-hide-sidebar">
								
					<!-- Search Job -->
					<div class="sidebar-widgets">
					
						<div class="ur-detail-wrap">
							<div class="ur-detail-wrap-header">
								<h4>Search Artisn Job Here</h4>
							</div>
							<div class="ur-detail-wrap-body">
								<form>
									<div class="form-group">
										<label>Keyword</label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
										<label>Location</label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
										<label>Category</label>
										<select id="choose-category" class="form-control">
											<option>Choose Category</option>
											<option>Banking Job</option>
											<option>IT / Software</option>
											<option>Medical & Hospital</option>
											<option>Networking</option>
											<option>Automotive</option>
											<option>Business Development</option>
										</select>
									</div>
									<button type="submit" class="btn btn-primary full-width">Find Artisn Jobs</button>
								</form>
							</div>
						</div>
						
					</div>
					<!-- /Search Job -->
				</div>
			</div>
            <?php include 'footer.php'; ?>