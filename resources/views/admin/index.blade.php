@extends('layouts.app')

@section('content')

            <div class="container-fluid pt-25">
				
				<!-- Row -->
				<div class="row">
					<div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">sales analytics</h6>
								</div>
								<div class="pull-right">
									<div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
										<select class="selectpicker" data-style="form-control">
											<option selected value='1'>Janaury</option>
											<option value='2'>February</option>
											<option value='3'>March</option>
											<option value='4'>April</option>
											<option value='5'>May</option>
											<option value='6'>June</option>
											<option value='7'>July</option>
											<option value='8'>August</option>
											<option value='9'>September</option>
											<option value='10'>October</option>
											<option value='11'>November</option>
											<option value='12'>December</option>
										</select>
									</div>	
									<a href="#" class="pull-left inline-block full-screen">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
                                <div class="panel-body">
									<ul class="flex-stat mb-10 ml-15">
										<li class="text-left auto-width mr-60">
											<span class="block">Traffic</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">3,24,222</span></span>
											<span class="block txt-success mt-5">
												<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+15%</span>
											</span>
											<div class="clearfix"></div>
										</li>
										<li class="text-left auto-width mr-60">
											<span class="block">Orders</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">1,23,432</span></span>
											<span class="block txt-success mt-5">
												<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+4%</span>
											</span>
											<div class="clearfix"></div>
										</li>
										<li class="text-left auto-width">
											<span class="block">Revenue</span>
											<span class="block txt-dark weight-500 font-18">$<span class="counter-anim">324,222</span></span>
											<span class="block txt-danger mt-5">
												<i class="zmdi zmdi-caret-down pr-5 font-20"></i><span class="weight-500">-5%</span>
											</span>
											<div class="clearfix"></div>
										</li>
									</ul>
									<div id="chart_1" class="morris-chart" style="height:345px;"></div>
								</div>
							</div>
                        </div>
                    </div>
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">top 5 products</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row">
									<div class="col-sm-6 pa-0">
										<canvas id="chart_7" height="164"></canvas>
									</div>
									<div class="col-sm-6 pr-0 pt-25">
										<div class="label-chatrs">
											<div class="mb-5">
												<span class="clabels inline-block bg-yellow mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Paleo Bars</span>
											</div>
											<div class="mb-5">
												<span class="clabels inline-block bg-pink mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Bow Ties</span>
											</div>
											<div class="mb-5">
												<span class="clabels inline-block bg-blue mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Pocket Squares</span>
											</div>
											<div class="mb-5">
												<span class="clabels inline-block bg-red mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Wood Sunglasses</span>
											</div>	
											<div class="">
												<span class="clabels inline-block bg-green mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Leggings</span>
											</div>												
										</div>
									</div>										
								</div>	
							</div>
						</div>
						<div class="panel panel-default card-view sm-data-box-3">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">conversion rate</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="col-sm-6 pa-0">
										<span id="pie_chart_4" class="easypiechart" data-percent="33">
											<span class="percent block txt-dark weight-500"></span>
											<span class="block txt-success text-center">
												<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+33%</span>
											</span>
										</span>
									</div>	
									<div class="col-sm-6 pr-0">
										<ul class="flex-stat mb-15">
											<li class="text-left block no-float full-width mb-15">
												<span class="block">Cart Abandonment</span>
												<span class="block txt-dark weight-500  font-18"><span class="counter-anim">73</span>%</span>
												<span class="block txt-success pull-left mt-5">
													<i class="zmdi zmdi-caret-up pr-5 font-20 pull-left"></i><span class="weight-500 pull-left">+15%</span>
												</span>
												<div class="clearfix"></div>
											</li>
											<li class="text-left block no-float full-width">
												<span class="block">Revenue Left</span>
												<span class="block txt-dark weight-500  font-18">$<span class="counter-anim">12,432</span></span>
												<span class="block txt-success pull-left mt-5">
													<i class="zmdi zmdi-caret-up pr-5 font-20 pull-left"></i><span class="weight-500 pull-left">+4%</span>
												</span>
												<div class="clearfix"></div>
											</li>
										</ul>
									</div>	
								</div>	
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">earnings by item type</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row">
									<div class="col-sm-6 pa-0">
										<canvas id="chart_8" height="185"></canvas>
									</div>
									<div class="col-sm-6 pr-0 pt-30">
										<div class="label-chatrs">
											<div class="mb-5">
												<span class="clabels circular-clabels inline-block bg-yellow mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Paleo Bars</span>
											</div>
											<div class="mb-5">
												<span class="clabels circular-clabels inline-block bg-green mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Bow Ties</span>
											</div>
											<div class="mb-5">
												<span class="clabels circular-clabels inline-block bg-blue mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Pocket Squares</span>
											</div>
											<div class="">
												<span class="clabels circular-clabels inline-block bg-red mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Wood Sunglasses</span>
											</div>											
										</div>
									</div>										
								</div>	
							</div>
						</div>
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Top Keywords</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block mr-15">
										<i class="zmdi zmdi-download"></i>
									</a>
									<a href="#" class="pull-left inline-block close-panel" data-effect="fadeOut">
										<i class="zmdi zmdi-close"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
										<div class="table-wrap sm-data-box-2">
										<div class="table-responsive">
										  <table class="table table-striped mb-0">
											<thead>
											  <tr>
												<th>Keyword</th>
												<th>Revenue</th>
												<th>Conversion Rate</th>
											  </tr>
											</thead>
											<tbody>
											  <tr>
												<td>adidas</td>
												<td>$49,897</td>
												<td>8.61%</td>
											  </tr>
											  <tr>
												<td>men's park</td>
												<td>$15,478</td>
												<td>2.10%</td>
											  </tr>
											  <tr>
												<td>nutiva coconut oil</td>
												<td>$23,546</td>
												<td>4.35%</td>
											  </tr>
											  <tr>
												<td>cart software</td>
												<td>$36,589</td>
												<td>1.58%</td>
											  </tr>
											   <tr>
												<td>where to buy</td>
												<td>$55,467</td>
												<td>56%</td>
											  </tr>
											   <tr>
												<td>pink adhesive</td>
												<td>$71,245</td>
												<td>47.6%</td>
											  </tr>
											</tbody>
										  </table>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pt-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-white">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-left pl-0 pr-0 data-wrap-left">
													<span class="txt-dark block counter">$<span class="counter-anim">15,678</span></span>
													<span class="block"><span class="weight-500 uppercase-font txt-grey font-13">Visits</span><i class="zmdi zmdi-caret-down txt-danger font-21 ml-5 vertical-align-middle"></i></span>
												</div>
												<div class="col-xs-6 text-left  pl-0 pr-0 pt-25 data-wrap-right">
													<div id="sparkline_4" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default card-view pt-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-white">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-left pl-0 pr-0 data-wrap-left">
													<span class="txt-dark block counter"><span class="counter-anim">46.41</span>%</span>
													<span class="block"><span class="weight-500 uppercase-font txt-grey font-13">Bounce Rate</span><i class="zmdi zmdi-caret-up txt-success font-21 ml-5 vertical-align-middle"></i></span>
												</div>
												<div class="col-xs-6 text-left  pl-0 pr-0 pt-25 data-wrap-right">
													<div id="sparkline_5" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default card-view pt-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-white">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-left pl-0 pr-0 data-wrap-left">
													<span class="txt-dark block counter"><span class="counter-anim">142,357</span></span>
													<span class="block"><span class="weight-500 uppercase-font txt-grey font-13">Products</span><i class="zmdi zmdi-caret-down txt-danger font-21 ml-5 vertical-align-middle"></i></span>
												</div>
												<div class="col-xs-6 text-left  pl-0 pr-0 pt-25 data-wrap-right">
													<div id="sparkline_6" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body">
									<!-- START carousel-->
									<div id="testimonial_slider" data-ride="carousel" class="carousel slide testimonial-slider-wrap text-slider">
										<ol class="carousel-indicators">
										   <li data-target="#testimonial_slider" data-slide-to="0" class="active"></li>
										   <li data-target="#testimonial_slider" data-slide-to="1"></li>
										   <li data-target="#testimonial_slider" data-slide-to="2"></li>
										</ol>
										<div role="listbox" class="carousel-inner mb-50">
											<div class="item active"> 
												<div class="testimonial-wrap text-center  pl-30 pr-30">
													<img class="img-circle" src="../img/user1.png" alt="First slide image"> 
													<p class="mt-20 font-16">"Activist, criteria planned giving dignity, committed democratizing the global financial system progressive."</p>
													<span class="testi-pers-name block mt-15  txt-dark capitalize-font head-font">
														Jens Brincker
													</span>
													<span class="testi-pers-desg block capitalize-font">
														Interaction Designer
													</span>
												</div>
											</div>
											<div class="item"> 
												<div class="testimonial-wrap text-center  pl-30 pr-30">
													<img class="img-circle" src="../img/user2.png" alt="First slide image"> 
													<p class="mt-20 font-16">"Nelson Mandela equal opportunity change accelerate pathway to a better life invest our ambitions catalyst."</p>
													<span class="testi-pers-name block mt-15  txt-dark capitalize-font head-font">
														Mark Hay
													</span>
													<span class="testi-pers-desg block capitalize-font">
														Interface Designer
													</span>
												</div>
											</div>
											
											<div class="item"> 
												<div class="testimonial-wrap text-center  pl-30 pr-30">
													<img class="img-circle" src="../img/user3.png" alt="First slide image"> 
													<p class="pt-20 font-16">"Making progress contribution compassion Ford Foundation, cross-agency coordination Bill development."</p>
													<span class="testi-pers-name block mt-15  txt-dark capitalize-font head-font">
														Anthony Davie	
													</span>
													<span class="testi-pers-desg block capitalize-font">
														Project Manager
													</span>
												</div>
											</div>
											
										</div>
									</div>
									<!-- END carousel-->
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-default border-panel  review-box card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">recent reviews</h6>
								</div>
								<div class="pull-right">
									<div class="form-group mb-0 sm-bootstrap-select">
										<select class="selectpicker" data-style="form-control">
											<option>Sort by Newest</option>
											<option>Sort by Highest Rating</option>
											<option>Sort by Lowest Rating</option>
										</select>
									</div>	
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
							<div class="panel-body row pa-0">
									<div class="streamline">
										<div class="sl-item">
											<div class="sl-content">
												<div class="per-rating inline-block pull-left">
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star-outline"></a>
													<span class="inline-block">for Paleo Bars</span>
												</div>
												<a href="javascript:void(0);"  class=" pull-right txt-grey"><i class="zmdi zmdi-mail-reply"></i></a>
												<div class="clearfix"></div>
												<div class="inline-block pull-left">
													<span class="reviewer font-13">
														<span>By</span>
														<a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">Jens Brincker</a>
													</span>	
													<span class="inline-block font-13  mb-5">11 day ago</span>
												</div>	
												<div class="clearfix"></div>
												<p class="mt-5">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
											</div>
										</div>
										<hr class="light-grey-hr"/>
										<div class="sl-item">
											<div class="sl-content">
												<div class="per-rating inline-block pull-left">
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a>
													<span class="inline-block">for Bow Ties</span>
												</div>
												<a href="javascript:void(0);"  class=" pull-right txt-grey"><i class="zmdi zmdi-mail-reply"></i></a>
												<div class="clearfix"></div>
												<div class="inline-block pull-left">
													<span class="reviewer font-13">
														<span>By</span>
														<a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">Madalyn Rascon</a>
													</span>	
													<span class="inline-block font-13  mb-5">11 day ago</span>
												</div>	
												<div class="clearfix"></div>
												<p class="mt-5">Neque porro quisquam est qui dolorem ipsum quiipsum quia dolor sit amet.</p>
											</div>
										</div>
										<hr class="light-grey-hr"/>
										<div class="sl-item">
											<div class="sl-content">
												<div class="per-rating inline-block pull-left">
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star-outline"></a>
													<span class="inline-block">for Pocket Squares</span>
												</div>
												<a href="javascript:void(0);"  class=" pull-right txt-grey"><i class="zmdi zmdi-mail-reply"></i></a>
												<div class="clearfix"></div>
												<div class="inline-block pull-left">
													<span class="reviewer font-13">
														<span>By</span>
														<a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">Evie Ono</a>
													</span>	
													<span class="inline-block font-13  mb-5">13 day ago</span>
												</div>	
												<div class="clearfix"></div>
												<p class="mt-5">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur.ipsum quia dolor sit amet.</p>
											</div>
										</div>
											<hr class="light-grey-hr"/>
										<div class="sl-item">
											<div class="sl-content">
												<div class="per-rating inline-block pull-left">
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star"></a><a href="javascript:void(0);" class="zmdi zmdi-star-outline"></a>
													<span class="inline-block">for Wood Sunglasses</span>
												</div>
												<a href="javascript:void(0);"  class=" pull-right txt-grey"><i class="zmdi zmdi-mail-reply"></i></a>
												<div class="clearfix"></div>
												<div class="inline-block pull-left">
													<span class="reviewer font-13">
														<span>By</span>
														<a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">Evie Ono</a>
													</span>	
													<span class="inline-block font-13  mb-5">13 day ago</span>
												</div>	
												<div class="clearfix"></div>
												<p class="mt-5">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur.ipsum quia dolor sit amet, consectetur.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-lg-8 col-md-6 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Invoice List</h6>
								</div>
								<div class="pull-right">
									<a href="javascript:void(0)" class="pull-left btn btn-primary btn-xs mr-15">view all</a>
									<a href="#" class="pull-left inline-block refresh mr-15">
										<i class="zmdi zmdi-replay"></i>
									</a>
									<a href="#" class="pull-left inline-block full-screen mr-15">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
									<div class="pull-left inline-block dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>option 1</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>option 2</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>option 3</a></li>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table  display table-hover border-none">
												<thead>
													<tr>
														<th>#Invoice</th>
														<th>Description</th>
														<th>Amount</th>
														<th>Status</th>
														<th>issue date</th>
														<th>due date</th>
														<th>View</th>
													</tr>
												</thead>

												<tbody>
													<tr>
														<td>#5012</td>
														<td>System Architect</td>
														<td>$205,500</td>
														<td>
															<span class="label label-danger">unpaid</span>
														</td>
														<td>2011/04/25</td>
														<td>2012/12/02</td>
														<td>
															<a href="#">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
															</a>	
														</td>
													</tr>
													<tr>
														<td>#5013</td>
														<td>Accountant</td>
														<td>$205,500</td>
														<td>
															<span class="label label-success">paid</span>
														</td>
														<td>2011/07/25</td>
														<td>2012/12/02</td>
														<td>
															<a href="#">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
															</a>	
														</td>
													</tr>
													<tr>
														<td>#5014</td>
														<td>Junior Technical Author</td>
														<td>$205,500</td>
														<td>
															<span class="label label-warning">pending</span>
														</td>
														<td>2009/01/12</td>
														<td>2012/12/02</td>
														<td>
															<a href="#">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
															</a>	
														</td>
													</tr>
													<tr>
														<td>#5015</td>
														<td>Senior Javascript Developer</td>
														<td>$205,500</td>
														<td>
															<span class="label label-success">paid</span>
														</td>
														<td>2012/03/29</td>
														<td>2012/12/02</td>
														<td>
															<a href="#">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
															</a>	
														</td>
													</tr>
													<tr>
														<td>#5010</td>
														<td>Integration Specialist</td>
														<td>$205,500</td>
														<td>
															<span class="label label-success">paid</span>
														</td>
														<td>2010/10/14</td>
														<td>2014/09/15</td>
														<td>
															<a href="#">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
															</a>	
														</td>
													</tr>
													<tr>
														<td>#5011</td>
														<td>Javascript Developer</td>
														<td>$205,500</td>
														<td>
															<span class="label label-success">paid</span>
														</td>
														<td>2009/09/15</td>
														<td>2013/09/15</td>
														<td>
															<a href="#">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
															</a>	
														</td>
													</tr>
													
												</tbody>
											</table>
										</div>
									</div>	
								</div>	
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-xs-12">
						<div class="panel panel-default border-panel card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">recent activity</h6>
								</div>
								<a class="txt-danger pull-right right-float-sub-text inline-block" href="javascript:void(0)"> clear all </a>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper task-panel collapse in">
								<div class="panel-body row pa-0">
									<div class="list-group mb-0">
										<a href="#" class="list-group-item">
											<span class="badge transparent-badge badge-info capitalize-font">just now</span>
											<i class="zmdi zmdi-calendar-check pull-left"></i><p class="pull-left">Calendar updated</p>
											<div class="clearfix"></div>
										</a>
										<a href="#" class="list-group-item">
											<span class="badge transparent-badge badge-success capitalize-font">4 min</span>
											<i class="zmdi zmdi-comment-alert pull-left"></i><p class=" pull-left">Commented on a post</p>
											<div class="clearfix"></div>
										</a>
										<a href="#" class="list-group-item">
											<span class="badge transparent-badge badge-warning capitalize-font">23 min </span>
											<i class="zmdi zmdi-truck pull-left"></i><p class=" pull-left">Order 392 shipped</p>
											<div class="clearfix"></div>
										</a>
										<a href="#" class="list-group-item">
											<span class="badge transparent-badge badge-success capitalize-font">46 min</span>
											<i class="zmdi zmdi-money pull-left"></i><p class=" pull-left">Invoice 653 has been paid</p>
											<div class="clearfix"></div>
										</a>
										<a href="#" class="list-group-item">
											<span class="badge transparent-badge badge-danger capitalize-font">1 hr</span>
											<i class="zmdi zmdi-account pull-left"></i><p class="pull-left">A new user has been added</p>
											<div class="clearfix"></div>
										</a>
										<a href="#" class="list-group-item">
											<span class="badge transparent-badge badge-warning capitalize-font">just now</span>
											<i class="zmdi zmdi-picture-in-picture pull-left"></i><p class=" pull-left">Finance report has been released</p>
											<div class="clearfix"></div>
										</a>
										<a href="#" class="list-group-item">
											<span class="badge transparent-badge badge-success capitalize-font">1 hr</span>
											<i class="zmdi zmdi-device-hub pull-left"></i><p class="pull-left">Web server hardware updated</p>
											<div class="clearfix"></div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
			</div>
			
			

@endsection