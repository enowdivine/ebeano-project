<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>@yield('meta_title', config('app.name', 'Dashboard'))</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<!-- vector map CSS -->
	<link href="{{asset('assets/vendors/bower_components/jquery-wizard.js/css/wizard.css')}}" rel="stylesheet"
		type="text/css" />

	<!-- jquery-steps css -->
	<link rel="stylesheet" href="{{asset('assets/vendors/bower_components/jquery.steps/demo/css/jquery.steps.css')}}">

	<!-- Morris Charts CSS -->
	<link href="{{asset('assets/vendors/bower_components/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />

	<!-- multi-select CSS -->
	<link href="{{asset('assets/vendors/bower_components/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css"/>

	<!-- select2 CSS -->
	<link href="{{asset('assets/vendors/bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
	
	<!-- bootstrap-select CSS -->
	<link href="{{asset('assets/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>

	<!-- Summernote css -->
	<link rel="stylesheet" href="{{asset('assets/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.css')}}" />

	<!-- Data table CSS -->
	<link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}"
		rel="stylesheet" type="text/css" />

	<!-- Bootstrap Dropify CSS -->
	<link href="{{asset('assets/vendors/bower_components/dropify/dist/css/dropify.min.css')}}" rel="stylesheet"
		type="text/css" />

	<link href="{{asset('assets/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css')}}"
		rel="stylesheet" type="text/css">

	<link href="{{asset('assets/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}"
		rel="stylesheet" type="text/css">

	<!-- bootstrap-select CSS -->
	<link href="{{asset('assets/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}"
		rel="stylesheet" type="text/css" />

	<!-- Bootstrap Switches CSS -->
	<link
		href="{{asset('assets/vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css')}}"
		rel="stylesheet" type="text/css" />

	<!-- bootstrap-touchspin CSS -->
	<link
		href="{{asset('assets/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}"
		rel="stylesheet" type="text/css" />

	<!-- switchery CSS -->
	<link href="{{asset('assets/vendors/bower_components/switchery/dist/switchery.min.css')}}" rel="stylesheet"
		type="text/css" />

	<!-- Custom CSS -->
	<link href="{{asset('assets/admin/dist/css/style.css')}}" rel="stylesheet" type="text/css">
	<style>
    .d-none {
        display: none;
    }
</style>
</head>

<body>
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
	<div class="wrapper theme-3-active pimary-color-green ">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="index.html">
							{{-- <img class="brand-img" src="../img/logo.png" alt="brand" /> --}}
							<span class="brand-text">Ebeano</span>
						</a>
					</div>
				</div>
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left"
					href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view"
					href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i
						class="zmdi zmdi-more"></i></a>
				<form id="search_form" role="search" class="top-nav-search collapse pull-left">
					<div class="input-group">
						<input type="text" name="example-input1-group2" class="form-control" placeholder="Search">
						<span class="input-group-btn">
							<button type="button" class="btn  btn-default" data-target="#search_form"
								data-toggle="collapse" aria-label="Close" aria-expanded="true"><i
									class="zmdi zmdi-search"></i></button>
						</span>
					</div>
				</form>
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">

					<li class="dropdown auth-drp">
					<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="{{asset('assets/admin/dist/img/null_male.png')}}"
								alt="user_auth" class="user-auth-img img-circle" /><span
								class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX"
							data-dropdown-out="flipOutX">
							<li>
								<a href="profile.html"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
							</li>
							<li>
								<a href="#"><i class="zmdi zmdi-card"></i><span>my balance</span></a>
							</li>
							<li>
								<a href="inbox.html"><i class="zmdi zmdi-email"></i><span>Inbox</span></a>
							</li>
							<li>
								<a href="#"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
							</li>
							<li class="divider"></li>
							<li class="sub-menu show-on-hover">
								<a href="#" class="dropdown-toggle pr-0 level-2-drp"><i
										class="zmdi zmdi-check text-success"></i> available</a>
								<ul class="dropdown-menu open-left-side">
									<li>
										<a href="#"><i
												class="zmdi zmdi-check text-success"></i><span>available</span></a>
									</li>
									<li>
										<a href="#"><i class="zmdi zmdi-circle-o text-warning"></i><span>busy</span></a>
									</li>
									<li>
										<a href="#"><i
												class="zmdi zmdi-minus-circle-outline text-danger"></i><span>offline</span></a>
									</li>
								</ul>
							</li>
							<li class="divider"></li>
							<li>
								<a href="{{route('logout')}}"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<!-- /Top Menu Items -->

		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span>
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a href="{{url('eb-admin')}}" data-toggle="collapse" data-target="#dashboard_dr">
						<div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span
								class="right-nav-text">Dashboard</span></div>
						<div class="clearfix"></div>
					</a>
				</li>
				<li>
					<hr class="light-grey-hr mb-10">
				</li>
				<li>
					<a class="" href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_pr">
						<div class="pull-left"><i class="zmdi zmdi-shopping-cart-add mr-20"></i><span
								class="right-nav-text">Products</span></div>
						<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
						<div class="clearfix"></div>
					</a>
					<ul id="ecom_pr" class="collapse collapse-level-1">
						<li>
							<a class="active-page" href="{{url('eb-admin/products')}}">All Products</a>
						</li>
						<li>
							<a href="{{url('eb-admin/products/sellers')}}">Sellers products</a>
						</li>
						<li>
							<a href="{{url('eb-admin/categories')}}">Categories</a>
						</li>
						<li>
							<a href="{{url('eb-admin/subcategories')}}">SubCategories</a>
						</li>
						
						<li>
							<a href="{{url('eb-admin/subsubcategories')}}">Sub SubCategories</a>
						</li>
						<li>
							<a href="{{route('brand.index')}}">Brands</a>
						</li>
						<li>
							<a href="{{route('shipping.index')}}">Shipping Zones</a>
						</li>

					</ul>
				</li>
				<li>
					<a class="" href="{{route('market.index')}}" >
						<div class="pull-left"><i class="zmdi zmdi-shopping-bag mr-20"></i><span
								class="right-nav-text">Markets</span></div>
						<div class="clearfix"></div>
					</a>
				
				</li>
				<li>
					<a class="" href="{{route('orders.list')}}" >
						<div class="pull-left"><i class="zmdi zmdi-dropbox mr-20"></i><span
								class="right-nav-text">Orders</span></div>
						<div class="clearfix"></div>
					</a>
				
				</li>
				<li>
					<hr class="light-grey-hr mb-10">
				</li>
				<li>
					<a class="" href="javascript:void(0);" data-toggle="collapse" data-target="#estate_category">
						<div class="pull-left"><i class="zmdi zmdi-home mr-20"></i><span
								class="right-nav-text">Real Estate</span></div>
						<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
						<div class="clearfix"></div>
					</a>
					<ul id="estate_category" class="collapse collapse-level-1">
						<li>
							<a class="active-page" href="{{url('eb-admin/estate-category')}}">Categories</a>
						</li>
						<li>
							<a href="{{url('eb-admin/estate-features')}}">Features</a>
						</li>
						<li>
							<a href="{{url('eb-admin/estate-requests')}}">Customer Request</a>
						</li>
						<!--<li>-->
						<!--	<a href="{{url('eb-admin/estate-types')}}">Room Types</a>-->
						<!--</li>-->
					</ul>
				</li>
				<li>
					<a class="active" href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr">
						<div class="pull-left"><i class="zmdi zmdi-account mr-20"></i><span
								class="right-nav-text">Manage staff</span></div>
						<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
						<div class="clearfix"></div>
					</a>
					<ul id="ecom_dr" class="collapse collapse-level-1">
						<li>
							<a href="{{url('eb-admin/staff')}}">Staff list</a>
						</li>
						<li>
							<a href="{{url('eb-admin/staff/roles')}}">Roles</a>
						</li>
						<li>
							<a href="{{url('eb-admin/staff/permissions')}}">Permissions</a>
						</li>

					</ul>
				</li>
				<li>
					<a class="" href="javascript:void(0);" data-toggle="collapse" data-target="#users">
						<div class="pull-left"><i class="zmdi zmdi-accounts mr-20"></i><span
								class="right-nav-text">Manage users</span></div>
						<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
						<div class="clearfix"></div>
					</a>
					<ul id="users" class="collapse collapse-level-1">
						<li>
							<a class="active-page" href="{{url('eb-admin/users')}}">Users</a>
						</li>
						<li>
							<a href="{{url('eb-admin/users/create')}}">Add users</a>
						</li>
					</ul>
				</li>
				<li>
					<a class="" href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_sell">
						<div class="pull-left"><i class="zmdi zmdi-account-box mr-20"></i><span
								class="right-nav-text">Sellers</span></div>
						<div class="pull-right"><i class="zmdi zmdi-caret-down "></i></div>
						<div class="clearfix"></div>
					</a>
					<ul id="ecom_sell" class="collapse collapse-level-1">
						<li>
							<a href="{{url('eb-admin/sellers')}}">Sellers list</a>
						</li>
						<li>
							<a href="{{url('eb-admin/sellers/create')}}">Add seller</a>
						</li>
						<li>
							<a href="{{url('eb-admin/stores')}}">Stores</a>
						</li>

					</ul>
				</li>
				<li>
					<a href="{{route('page.index')}}">
						<div class="pull-left"><i class="zmdi zmdi-pages mr-20"></i><span
							class="right-nav-text">Pages
						</span></div>
						<div class="clearfix"></div>
					</a>
				</li>
				
				<li>
					<a class="" href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_pay">
						<div class="pull-left"><i class="zmdi zmdi-money mr-20"></i><span
								class="right-nav-text">Payments</span></div>
						<div class="pull-right"><i class="zmdi zmdi-caret-down "></i></div>
						<div class="clearfix"></div>
					</a>
					<ul id="ecom_pay" class="collapse collapse-level-1">
						<li>
							<a  href="{{route('payment.index')}}">All payments</a>
						</li>
						<li>
							<a href="{{route('payment.approve')}}">Verify/Approve Payment</a>
						</li>
					

					</ul>
				</li>
				<li>
					<a class="" href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_sub">
						<div class="pull-left"><i class="zmdi zmdi-account-box mr-20"></i><span
								class="right-nav-text">Subscription</span></div>
						<div class="pull-right"><i class="zmdi zmdi-caret-down "></i></div>
						<div class="clearfix"></div>
					</a>
					<ul id="ecom_sub" class="collapse collapse-level-1">
						<li>
							<a href="{{route('subscribers')}}">Subscribed Vendors</a>
						</li>
						<li>
							<a href="{{route('sub.plans')}}">Plans</a>
						</li>
						<li>
							<a href="{{route('sub.subscribe')}}">Add Suscription</a>
						</li>

					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#app_set">
						<div class="pull-left"><i class="zmdi zmdi-settings mr-20"></i><span
								class="right-nav-text">Settings
							</span></div>
						<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
						<div class="clearfix"></div>
					</a>
					<ul id="app_set" class="collapse collapse-level-1">
						<li>
							<a href="{{url('eb-admin/site-settings')}}">Site settings</a>
						</li>
						<li>
							<a href="{{url('eb-admin/seo-settings')}}">Seo settings</a>
						</li>
						<li>
							<a href="{{url('eb-admin/home-settings')}}">Home Settings</a>
						</li>
					</ul>
				</li>
				<li>
					<hr class="light-grey-hr mb-10">
				</li>

			</ul>
		</div>
		<!-- /Left Sidebar Menu -->

		<!-- Right Sidebar Menu -->
		{{-- <div class="fixed-sidebar-right">
			<ul class="right-sidebar">
				<li>
					<div class="tab-struct custom-tab-1">
						<ul role="tablist" class="nav nav-tabs" id="right_sidebar_tab">
							<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab"
									id="chat_tab_btn" href="#chat_tab">chat</a></li>
							<li role="presentation" class=""><a data-toggle="tab" id="messages_tab_btn" role="tab"
									href="#messages_tab" aria-expanded="false">messages</a></li>
							<li role="presentation" class=""><a data-toggle="tab" id="todo_tab_btn" role="tab"
									href="#todo_tab" aria-expanded="false">todo</a></li>
						</ul>
						<div class="tab-content" id="right_sidebar_content">
							<div id="chat_tab" class="tab-pane fade active in" role="tabpanel">
								<div class="chat-cmplt-wrap">
									<div class="chat-box-wrap">
										<div class="add-friend">
											<a href="javascript:void(0)" class="inline-block txt-grey">
												<i class="zmdi zmdi-more"></i>
											</a>
											<span class="inline-block txt-dark">users</span>
											<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i
													class="zmdi zmdi-plus"></i></a>
											<div class="clearfix"></div>
										</div>
										<form role="search" class="chat-search pl-15 pr-15 pb-15">
											<div class="input-group">
												<input type="text" id="example-input1-group2"
													name="example-input1-group2" class="form-control"
													placeholder="Search">
												<span class="input-group-btn">
													<button type="button" class="btn  btn-default"><i
															class="zmdi zmdi-search"></i></button>
												</span>
											</div>
										</form>
										<div id="chat_list_scroll">
											<div class="nicescroll-bar">
												<ul class="chat-list-wrap">
													<li class="chat-list">
														<div class="chat-body">
															<a href="javascript:void(0)">
																<div class="chat-data">
																	<img class="user-img img-circle"
																		src="../img/user.png" alt="user" />
																	<div class="user-data">
																		<span class="name block capitalize-font">Clay
																			Masse</span>
																		<span class="time block truncate txt-grey">No
																			one saves us but ourselves.</span>
																	</div>
																	<div class="status away"></div>
																	<div class="clearfix"></div>
																</div>
															</a>
															<a href="javascript:void(0)">
																<div class="chat-data">
																	<img class="user-img img-circle"
																		src="../img/user1.png" alt="user" />
																	<div class="user-data">
																		<span class="name block capitalize-font">Evie
																			Ono</span>
																		<span class="time block truncate txt-grey">Unity
																			is strength</span>
																	</div>
																	<div class="status offline"></div>
																	<div class="clearfix"></div>
																</div>
															</a>
															<a href="javascript:void(0)">
																<div class="chat-data">
																	<img class="user-img img-circle"
																		src="../img/user2.png" alt="user" />
																	<div class="user-data">
																		<span class="name block capitalize-font">Madalyn
																			Rascon</span>
																		<span
																			class="time block truncate txt-grey">Respect
																			yourself if you would have others respect
																			you.</span>
																	</div>
																	<div class="status online"></div>
																	<div class="clearfix"></div>
																</div>
															</a>
															<a href="javascript:void(0)">
																<div class="chat-data">
																	<img class="user-img img-circle"
																		src="../img/user3.png" alt="user" />
																	<div class="user-data">
																		<span class="name block capitalize-font">Mitsuko
																			Heid</span>
																		<span class="time block truncate txt-grey">I’m
																			thankful.</span>
																	</div>
																	<div class="status online"></div>
																	<div class="clearfix"></div>
																</div>
															</a>
															<a href="javascript:void(0)">
																<div class="chat-data">
																	<img class="user-img img-circle"
																		src="../img/user.png" alt="user" />
																	<div class="user-data">
																		<span
																			class="name block capitalize-font">Ezequiel
																			Merideth</span>
																		<span
																			class="time block truncate txt-grey">Patience
																			is bitter.</span>
																	</div>
																	<div class="status offline"></div>
																	<div class="clearfix"></div>
																</div>
															</a>
															<a href="javascript:void(0)">
																<div class="chat-data">
																	<img class="user-img img-circle"
																		src="../img/user1.png" alt="user" />
																	<div class="user-data">
																		<span class="name block capitalize-font">Jonnie
																			Metoyer</span>
																		<span
																			class="time block truncate txt-grey">Genius
																			is eternal patience.</span>
																	</div>
																	<div class="status online"></div>
																	<div class="clearfix"></div>
																</div>
															</a>
															<a href="javascript:void(0)">
																<div class="chat-data">
																	<img class="user-img img-circle"
																		src="../img/user2.png" alt="user" />
																	<div class="user-data">
																		<span class="name block capitalize-font">Angelic
																			Lauver</span>
																		<span class="time block truncate txt-grey">Every
																			burden is a blessing.</span>
																	</div>
																	<div class="status away"></div>
																	<div class="clearfix"></div>
																</div>
															</a>
															<a href="javascript:void(0)">
																<div class="chat-data">
																	<img class="user-img img-circle"
																		src="../img/user3.png" alt="user" />
																	<div class="user-data">
																		<span
																			class="name block capitalize-font">Priscila
																			Shy</span>
																		<span class="time block truncate txt-grey">Wise
																			to resolve, and patient to perform.</span>
																	</div>
																	<div class="status online"></div>
																	<div class="clearfix"></div>
																</div>
															</a>
															<a href="javascript:void(0)">
																<div class="chat-data">
																	<img class="user-img img-circle"
																		src="../img/user4.png" alt="user" />
																	<div class="user-data">
																		<span class="name block capitalize-font">Linda
																			Stack</span>
																		<span class="time block truncate txt-grey">Our
																			patience will achieve more than our
																			force.</span>
																	</div>
																	<div class="status away"></div>
																	<div class="clearfix"></div>
																</div>
															</a>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="recent-chat-box-wrap">
										<div class="recent-chat-wrap">
											<div class="panel-heading ma-0">
												<div class="goto-back">
													<a id="goto_back" href="javascript:void(0)"
														class="inline-block txt-grey">
														<i class="zmdi zmdi-chevron-left"></i>
													</a>
													<span class="inline-block txt-dark">ryan</span>
													<a href="javascript:void(0)"
														class="inline-block text-right txt-grey"><i
															class="zmdi zmdi-more"></i></a>
													<div class="clearfix"></div>
												</div>
											</div>
											<div class="panel-wrapper collapse in">
												<div class="panel-body pa-0">
													<div class="chat-content">
														<ul class="nicescroll-bar pt-20">
															<li class="friend">
																<div class="friend-msg-wrap">
																	<img class="user-img img-circle block pull-left"
																		src="../img/user.png" alt="user" />
																	<div class="msg pull-left">
																		<p>Hello Jason, how are you, it's been a long
																			time since we last met?</p>
																		<div class="msg-per-detail text-right">
																			<span class="msg-time txt-grey">2:30
																				PM</span>
																		</div>
																	</div>
																	<div class="clearfix"></div>
																</div>
															</li>
															<li class="self mb-10">
																<div class="self-msg-wrap">
																	<div class="msg block pull-right"> Oh, hi Sarah I'm
																		have got a new job now and is going great.
																		<div class="msg-per-detail text-right">
																			<span class="msg-time txt-grey">2:31
																				pm</span>
																		</div>
																	</div>
																	<div class="clearfix"></div>
																</div>
															</li>
															<li class="self">
																<div class="self-msg-wrap">
																	<div class="msg block pull-right"> How about you?
																		<div class="msg-per-detail text-right">
																			<span class="msg-time txt-grey">2:31
																				pm</span>
																		</div>
																	</div>
																	<div class="clearfix"></div>
																</div>
															</li>
															<li class="friend">
																<div class="friend-msg-wrap">
																	<img class="user-img img-circle block pull-left"
																		src="../img/user.png" alt="user" />
																	<div class="msg pull-left">
																		<p>Not too bad.</p>
																		<div class="msg-per-detail  text-right">
																			<span class="msg-time txt-grey">2:35
																				pm</span>
																		</div>
																	</div>
																	<div class="clearfix"></div>
																</div>
															</li>
														</ul>
													</div>
													<div class="input-group">
														<input type="text" id="input_msg_send" name="send-msg"
															class="input-msg-send form-control"
															placeholder="Type something">
														<div class="input-group-btn emojis">
															<div class="dropup">
																<button type="button"
																	class="btn  btn-default  dropdown-toggle"
																	data-toggle="dropdown"><i
																		class="zmdi zmdi-mood"></i></button>
																<ul class="dropdown-menu dropdown-menu-right">
																	<li><a href="javascript:void(0)">Action</a></li>
																	<li><a href="javascript:void(0)">Another action</a>
																	</li>
																	<li class="divider"></li>
																	<li><a href="javascript:void(0)">Separated link</a>
																	</li>
																</ul>
															</div>
														</div>
														<div class="input-group-btn attachment">
															<div class="fileupload btn  btn-default"><i
																	class="zmdi zmdi-attachment-alt"></i>
																<input type="file" class="upload">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div id="messages_tab" class="tab-pane fade" role="tabpanel">
								<div class="message-box-wrap">
									<div class="msg-search">
										<a href="javascript:void(0)" class="inline-block txt-grey">
											<i class="zmdi zmdi-more"></i>
										</a>
										<span class="inline-block txt-dark">messages</span>
										<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i
												class="zmdi zmdi-search"></i></a>
										<div class="clearfix"></div>
									</div>
									<div class="set-height-wrap">
										<div class="streamline message-box nicescroll-bar">
											<a href="javascript:void(0)">
												<div class="sl-item unread-message">
													<div class="sl-avatar avatar avatar-sm avatar-circle">
														<img class="img-responsive img-circle" src="../img/user.png"
															alt="avatar" />
													</div>
													<div class="sl-content">
														<span
															class="inline-block capitalize-font   pull-left message-per">Clay
															Masse</span>
														<span
															class="inline-block font-11  pull-right message-time">12:28
															AM</span>
														<div class="clearfix"></div>
														<span class=" truncate message-subject">Themeforest message sent
															via your envato market profile</span>
														<p class="txt-grey truncate">Neque porro quisquam est qui
															dolorem ipsu messm quia dolor sit amet, consectetur,
															adipisci velit</p>
													</div>
												</div>
											</a>
											<a href="javascript:void(0)">
												<div class="sl-item">
													<div class="sl-avatar avatar avatar-sm avatar-circle">
														<img class="img-responsive img-circle" src="../img/user1.png"
															alt="avatar" />
													</div>
													<div class="sl-content">
														<span
															class="inline-block capitalize-font   pull-left message-per">Evie
															Ono</span>
														<span class="inline-block font-11  pull-right message-time">1
															Feb</span>
														<div class="clearfix"></div>
														<span class=" truncate message-subject">Pogody theme
															support</span>
														<p class="txt-grey truncate">Neque porro quisquam est qui
															dolorem ipsum quia dolor sit amet, consectetur, adipisci
															velit</p>
													</div>
												</div>
											</a>
											<a href="javascript:void(0)">
												<div class="sl-item">
													<div class="sl-avatar avatar avatar-sm avatar-circle">
														<img class="img-responsive img-circle" src="../img/user2.png"
															alt="avatar" />
													</div>
													<div class="sl-content">
														<span
															class="inline-block capitalize-font   pull-left message-per">Madalyn
															Rascon</span>
														<span class="inline-block font-11  pull-right message-time">31
															Jan</span>
														<div class="clearfix"></div>
														<span class=" truncate message-subject">Congratulations from
															design nominees</span>
														<p class="txt-grey truncate">Neque porro quisquam est qui
															dolorem ipsum quia dolor sit amet, consectetur, adipisci
															velit</p>
													</div>
												</div>
											</a>
											<a href="javascript:void(0)">
												<div class="sl-item unread-message">
													<div class="sl-avatar avatar avatar-sm avatar-circle">
														<img class="img-responsive img-circle" src="../img/user3.png"
															alt="avatar" />
													</div>
													<div class="sl-content">
														<span
															class="inline-block capitalize-font   pull-left message-per">Ezequiel
															Merideth</span>
														<span class="inline-block font-11  pull-right message-time">29
															Jan</span>
														<div class="clearfix"></div>
														<span class=" truncate message-subject">Themeforest item support
															message</span>
														<p class="txt-grey truncate">Neque porro quisquam est qui
															dolorem ipsum quia dolor sit amet, consectetur, adipisci
															velit</p>
													</div>
												</div>
											</a>
											<a href="javascript:void(0)">
												<div class="sl-item unread-message">
													<div class="sl-avatar avatar avatar-sm avatar-circle">
														<img class="img-responsive img-circle" src="../img/user4.png"
															alt="avatar" />
													</div>
													<div class="sl-content">
														<span
															class="inline-block capitalize-font   pull-left message-per">Jonnie
															Metoyer</span>
														<span class="inline-block font-11  pull-right message-time">27
															Jan</span>
														<div class="clearfix"></div>
														<span class=" truncate message-subject">Help with beavis contact
															form</span>
														<p class="txt-grey truncate">Neque porro quisquam est qui
															dolorem ipsum quia dolor sit amet, consectetur, adipisci
															velit</p>
													</div>
												</div>
											</a>
											<a href="javascript:void(0)">
												<div class="sl-item">
													<div class="sl-avatar avatar avatar-sm avatar-circle">
														<img class="img-responsive img-circle" src="../img/user.png"
															alt="avatar" />
													</div>
													<div class="sl-content">
														<span
															class="inline-block capitalize-font   pull-left message-per">Priscila
															Shy</span>
														<span class="inline-block font-11  pull-right message-time">19
															Jan</span>
														<div class="clearfix"></div>
														<span class=" truncate message-subject">Your uploaded theme is
															been selected</span>
														<p class="txt-grey truncate">Neque porro quisquam est qui
															dolorem ipsum quia dolor sit amet, consectetur, adipisci
															velit</p>
													</div>
												</div>
											</a>
											<a href="javascript:void(0)">
												<div class="sl-item">
													<div class="sl-avatar avatar avatar-sm avatar-circle">
														<img class="img-responsive img-circle" src="../img/user1.png"
															alt="avatar" />
													</div>
													<div class="sl-content">
														<span
															class="inline-block capitalize-font   pull-left message-per">Linda
															Stack</span>
														<span class="inline-block font-11  pull-right message-time">13
															Jan</span>
														<div class="clearfix"></div>
														<span class=" truncate message-subject"> A new rating has been
															received</span>
														<p class="txt-grey truncate">Neque porro quisquam est qui
															dolorem ipsum quia dolor sit amet, consectetur, adipisci
															velit</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div id="todo_tab" class="tab-pane fade" role="tabpanel">
								<div class="todo-box-wrap">
									<div class="add-todo">
										<a href="javascript:void(0)" class="inline-block txt-grey">
											<i class="zmdi zmdi-more"></i>
										</a>
										<span class="inline-block txt-dark">todo list</span>
										<a href="javascript:void(0)" class="inline-block text-right txt-grey"><i
												class="zmdi zmdi-plus"></i></a>
										<div class="clearfix"></div>
									</div>
									<div class="set-height-wrap">
										<!-- Todo-List -->
										<ul class="todo-list nicescroll-bar">
											<li class="todo-item">
												<div class="checkbox checkbox-default">
													<input type="checkbox" id="checkbox01" />
													<label for="checkbox01">Record The First Episode</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr" />
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-pink">
													<input type="checkbox" id="checkbox02" />
													<label for="checkbox02">Prepare The Conference Schedule</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr" />
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-warning">
													<input type="checkbox" id="checkbox03" checked />
													<label for="checkbox03">Decide The Live Discussion Time</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr" />
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-success">
													<input type="checkbox" id="checkbox04" checked />
													<label for="checkbox04">Prepare For The Next Project</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr" />
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-danger">
													<input type="checkbox" id="checkbox05" checked />
													<label for="checkbox05">Finish Up AngularJs Tutorial</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr" />
											</li>
											<li class="todo-item">
												<div class="checkbox checkbox-purple">
													<input type="checkbox" id="checkbox06" checked />
													<label for="checkbox06">Finish Infinity Project</label>
												</div>
											</li>
											<li>
												<hr class="light-grey-hr" />
											</li>
										</ul>
										<!-- /Todo-List -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div> --}}
		<!-- /Right Sidebar Menu -->

		<!-- Right Setting Menu -->
		<div class="setting-panel">
			<ul class="right-sidebar nicescroll-bar pa-0">
				<li class="layout-switcher-wrap">
					<ul>
						<li>
							<span class="layout-title">Scrollable header</span>
							<span class="layout-switcher">
								<input type="checkbox" id="switch_3" class="js-switch" data-color="#2ecd99"
									data-secondary-color="#dedede" data-size="small" />
							</span>
							<h6 class="mt-30 mb-15">Theme colors</h6>
							<ul class="theme-option-wrap">
								<li id="theme-1"><i class="zmdi zmdi-check"></i></li>
								<li id="theme-2"><i class="zmdi zmdi-check"></i></li>
								<li id="theme-3" class="active-theme"><i class="zmdi zmdi-check"></i></li>
								<li id="theme-4"><i class="zmdi zmdi-check"></i></li>
								<li id="theme-5"><i class="zmdi zmdi-check"></i></li>
								<li id="theme-6"><i class="zmdi zmdi-check"></i></li>
							</ul>
							<h6 class="mt-30 mb-15">Primary colors</h6>
							<div class="radio mb-5">
								<input type="radio" name="radio-primary-color" id="pimary-color-green" checked
									value="pimary-color-green">
								<label for="pimary-color-green"> Green </label>
							</div>
							<div class="radio mb-5">
								<input type="radio" name="radio-primary-color" id="pimary-color-red"
									value="pimary-color-red">
								<label for="pimary-color-red"> Red </label>
							</div>
							<div class="radio mb-5">
								<input type="radio" name="radio-primary-color" id="pimary-color-blue"
									value="pimary-color-blue">
								<label for="pimary-color-blue"> Blue </label>
							</div>
							<div class="radio mb-5">
								<input type="radio" name="radio-primary-color" id="pimary-color-yellow"
									value="pimary-color-yellow">
								<label for="pimary-color-yellow"> Yellow </label>
							</div>
							<div class="radio mb-5">
								<input type="radio" name="radio-primary-color" id="pimary-color-pink"
									value="pimary-color-pink">
								<label for="pimary-color-pink"> Pink </label>
							</div>
							<div class="radio mb-5">
								<input type="radio" name="radio-primary-color" id="pimary-color-orange"
									value="pimary-color-orange">
								<label for="pimary-color-orange"> Orange </label>
							</div>
							<div class="radio mb-5">
								<input type="radio" name="radio-primary-color" id="pimary-color-gold"
									value="pimary-color-gold">
								<label for="pimary-color-gold"> Gold </label>
							</div>
							<div class="radio mb-35">
								<input type="radio" name="radio-primary-color" id="pimary-color-silver"
									value="pimary-color-silver">
								<label for="pimary-color-silver"> Silver </label>
							</div>
							<button id="reset_setting"
								class="btn  btn-success btn-xs btn-outline btn-rounded mb-10">reset</button>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<button id="setting_panel_btn" class="btn btn-success btn-circle setting-panel-btn shadow-2dp"><i
				class="zmdi zmdi-settings"></i></button>
		<!-- /Right Setting Menu -->

		<!-- Right Sidebar Backdrop -->
		<div class="right-sidebar-backdrop"></div>
		<!-- /Right Sidebar Backdrop -->
		<!-- Main Content -->
		<div class="page-wrapper">
			@yield('content')
			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p>2020 &copy; Ebeano Marketplace. </p>
					</div>
				</div>
			</footer>
			<!-- /Footer -->

		</div>
		<!-- /Main Content -->
	</div>
	<!-- /#wrapper -->

	<!-- JavaScript -->

	<!-- jQuery -->
	<script src="{{asset('assets/vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

	<!-- Data table JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	{{-- <script src="{{asset('assets/admin/dist/js/dataTables-data.js')}}"></script> --}}
	<script>
		/*DataTable Init*/
		"use strict";
		$(document).ready(function() {
			"use strict";
			$('#datable_g_1').DataTable();
			$('#datable_2').DataTable({
				"lengthChange": false
			});
		});
	</script>
	<!-- Slimscroll JavaScript -->
	<script src="{{asset('assets/admin/dist/js/jquery.slimscroll.js')}}"></script>

	<!-- simpleWeather JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/moment/min/moment.min.js')}}"></script>
	<script src="{{asset('assets/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js')}}"></script>
	<script src="{{ asset('assets/admin/dist/js/simpleweather-data.js') }}"></script>

	<!-- Form Wizard JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/jquery.steps/build/jquery.steps.min.js')}}"></script>
	<script src="{{asset('assets/ajax/jquery.validate/1.15.0/jquery.validate.min.js')}}"></script>

	<!-- Form Wizard Data JavaScript -->
	<script src="{{asset('assets/admin/dist/js/form-wizard-data.js')}}"></script>

	<!-- Bootstrap Touchspin JavaScript -->
	<script
		src="{{asset('assets/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}">
	</script>

	<!-- Starrr JavaScript -->
	<script src="{{asset('assets/admin/dist/js/starrr.js')}}"></script>

	<!-- Bootstrap Daterangepicker JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/dropify/dist/js/dropify.min.js')}}"></script>

	<!-- Form Flie Upload Data JavaScript -->
	<script src="{{asset('assets/admin/dist/js/form-file-upload-data.js')}}"></script>

	<!-- Progressbar Animation JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('assets/vendors/bower_components/jquery.counterup/jquery.counterup.min.js')}}"></script>

	<!-- Fancy Dropdown JS -->
	<script src="{{asset('assets/admin/dist/js/dropdown-bootstrap-extended.js')}}"></script>

	<!-- Sparkline JavaScript -->
	<script src="{{asset('assets/vendors/jquery.sparkline/dist/jquery.sparkline.min.js')}}"></script>

	<!-- Owl JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js')}}"></script>

	<!-- ChartJS JavaScript -->
	<script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>

	<!-- EasyPieChart JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}">
	</script>

	<!-- Bootstrap Tagsinput JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}">
	</script>
	<!-- Summernote Plugin JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.js')}}"></script>
	<!-- Summernote Wysuhtml5 Init JavaScript -->
	<script>
		/*Bootstrap wysihtml5 Init*/

		$(document).ready(function () {
			"use strict";
			
			$('.summernote').wysihtml5({
				toolbar: {
				fa: true,
				"link": true,
				}
			});
			
		});
	</script>

	<!-- Morris Charts JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/raphael/raphael.min.js')}}"></script>
	<script src="{{asset('assets/vendors/bower_components/morris.js/morris.min.js')}}"></script>
	<script src="{{asset('assets/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
    <!-- Bootstrap Switch JavaScript -->
		<!--<script src="asset('assets/vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js')"></script>-->
	<!-- Switchery JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/switchery/dist/switchery.min.js')}}"></script>

	<!-- Bootstrap Select JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}">
	</script>

	<!-- Select2 JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	
	<!-- Multiselect JavaScript -->
	<script src="{{asset('assets/vendors/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>

	<!--Spartan Image JavaScript [ REQUIRED ]-->
	<script src="{{asset('assets/vendors/bower_components/spartan/dist/js/spartan-multi-image-picker-min.js')}}">
	</script>

	<!-- Init JavaScript -->
	<script src="{{asset('assets/admin/dist/js/init.js')}}"></script>
	<script src="{{asset('assets/admin/dist/js/ecommerce-data.js')}}"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('ul li a').click(function() {
				$('li a').removeClass("active");
				$(this).addClass("active");
			});
		});
		$(document).ready(function() {
			$("#featured").spartanMultiImagePicker({
				fieldName: 'featured_img',
				maxCount: 1,
				rowHeight: '200px',
				groupClassName: 'col-md-4 col-sm-4 col-xs-6',
				allowedExt: 'png|jpg|jpeg',
				dropFileLabel: "Drop Here",
				onExtensionErr: function(index, file) {
					console.log(index, file);
					alert('Please only input png or jpg type file');
				},
				onSizeErr: function(index, file) {
					console.log(index, file);
					alert('File size too big');
				}
			});
			$("#images").spartanMultiImagePicker({
				fieldName: 'images[]',
				maxCount: 10,
				rowHeight: '200px',
				groupClassName: 'col-md-4 col-sm-4 col-xs-6',
				allowedExt: 'png|jpg|jpeg',
				dropFileLabel: "Drop Here",
				onExtensionErr: function(index, file) {
					console.log(index, file);
					alert('Please only input png or jpg type file');
				},
				onSizeErr: function(index, file) {
					console.log(index, file);
					alert('File size too big');
				}
			});
		});
	</script>
	@yield('script')
	<!-- Form Advance Init JavaScript -->
	<script src="{{asset('assets/admin/dist/js/form-advance-data.js')}}"></script>
</body>

</html>