@extends('layouts.layout_first_page')
@section('content')
<style>
	#page-footer .page-footer-btn:after {
		content: "\f104";
		position: absolute;
		top: -2px;
		right: unset;
		left: -15px;
		font-family: 'Font Awesome 5 Pro';
	}
	#page-body {
		background: #f5f5f6;
	}
	#page-body .list-news-item div.box {
		text-align: right;
	}
	#page-body .section-hp-news {
		text-align: right;
	}
	#page-body .section-hp-news a {
		text-align: -webkit-right;
	}
	#site-title {
		text-align: center;
	    padding: 3% 18%;
	}
	#page-footer .page-footer-logos .page-footer-logo {
		width: 50px;
		text-align: center;
	}
	#page-footer .page-footer-logos {
		margin-bottom: 20px;
	}
	#page-footer-row-3 {
		padding-bottom: 0px;
	}
	#section-content {
		padding: 0px;
		background: white;
	}
	.page-wrapper {
		max-width: 100%;
		padding: 0px;
	}
	.grid-lol-grid-3-container , #section-content .list-news , #page-footer .grid-adaptive , .page-header-desktop .page-header-row-2-inner, #page-footer-row-3-inner {
		max-width: 1120px;
		margin: auto;
	}
	.grid-container .grid-flex > [class*="sub-column-"] > :first-child > .title-3 , .grid-flex:first-child > .sub-column-100 > .section-content-text:first-child .title-3 {
		margin-top: 20px;
	}
	.banafsh , #page-footer-row-2 {
		background: #323a56 !important;
	}
	.grid-container .title-3::before {
		display: none;
	}
	.banafsh h3 {
		color: white;
		text-align: right;
	}
    .list-news-item {
        margin: auto;
    }
	.list-news-item div.box i {
		font-size: 14px;
		padding: 0px 2%;
		color: #ff8c6c;
	}
	.list-news-item div.box {
		width: 40%;
		background: #323a56;
		color: white;
		font-size: 18px;
		font-weight: bold;
		margin: 4%;		
		padding: 1% 4%;
	}
	.section-hp-news {
		background: #f5f5f6;
	}
	.section-hp-news .content {
		padding: 0px 20px;
	}
	.grid-container {
		padding: 0px;
	}
	#home-learn__search-form_1-0 {
		margin: 12px auto 0px;
		max-width: 780px;
		margin: 0 auto;
	}
	#search-form_1-0 {
		margin-bottom: 24px;
		position: relative;
		overflow: hidden;
		text-align: left;
	}
	#search-form_1-0 svg {
		opacity: .8;
		z-index: 1;
		width: 2.5rem;
		height: 2.5rem;
		position: absolute;
		top: 50%;
		padding: 0.625rem;
		transform: translateY(-50%);
	}
	#search-form_1-0 .search__wrapper {
		display: flex;
		position: relative;
		top: 0;
		padding: 0;
		box-shadow: none;
		direction: rtl;
	}
	#search-form_1-0 input {
		height: 3.125rem;
		padding-left: 2.5rem;
		box-shadow: 0 0 0 1px #ccc inset;
		background: #fff;
	}
	#search-form_1-0 button {
		letter-spacing: .05rem;
		text-transform: uppercase;
		display: flex;
		align-items: center;
		flex: 0 0 auto;
		padding: 0.75rem 1.25rem 0.5rem;
		font-family: Cabin-semi-bold,sans-serif;
		font-size: .875rem;
		text-decoration: none;
		color: #fff;
		background: #323a56;
	}
	#slider-hero .slider-hero-content {
		float: right;
	}
	#slider-hero .btn-slider .fa {
		font-size: 14px;
		margin-top: 20px;
		padding: 0px 2px;
	}
	.top-search {
		direction: rtl;
	}
	.top-search #home-learn__search-form_1-0 {
		margin: 12px 0px 0px !important;
	}
	.title-3 {
		color: #666;
	}
	.counter {
		padding: 26px 6px;
	    color: #ff8c6c;
	}
	#page-footer .page-footer-title {
		font-size: 22px;
	}
	#page-footer .page-footer-btn {
		font-size: 16px;
	}
	#logo-top-site {
		visibility: visible;
		width: 140px;
	}
	@media only screen and (min-width: 920px) {
		.page-header-desktop .page-header-row-1-inner {
			margin-bottom: 0px;
		}
		#page-footer .page-footer-logos {
			margin-bottom: 20px;
			margin: 12px;
		}
		#home-learn__search-form_1-0 {
			margin: 12px auto 0px;
		}
		#slider-hero .slider-hero-content {
			padding-right: 5%;
		}
		.list-news-item {
			width: 33%;
		}
		.col-lol-grid-3-lg-4 {
			flex-basis: 50%;
			max-width: 50%;
		}
		.mix-for-sm {
			margin-top: 0px
		}
		.page-header-desktop .page-header-row-1 {
			max-width: 1120px;
			margin: auto;
		}
		.dir-lg-r {
			direction: rtl;
		}
	}
	@media only screen and (max-width: 640px) {
		#home-learn__search-form_1-0 {
			max-width: 88%;
		}
		.mix-for-sm .col-lol-grid-3-lg-4 {
			flex-basis: 50%;
			max-width: 50%;
			padding: 2%;
		}
		.page-header-row-1-inner {
			margin-top: 0px;
			margin-bottom: 0px;
			padding: 0px;
		}
		#page-footer .page-footer-title , #page-footer a {
			text-align: center;
		}
		#page-footer .sub-column-100 {
			margin-bottom: 0px;
		}
		img.footer-logo {
			width: 100%;
		    padding: 0px 20%;
		}
		#page-footer .page-footer-logos .page-footer-logo {
			width: 50% !important;
		}
		.text-sm-center {
			text-align: center;
		}
		.page-header-mobile .page-header-row-2-inner {
			width: 92%;
			margin: auto;
		}
		.page-header-row-1-inner {
			padding-right: 5%;
		}
		.page-header-logo {
			height: 68px;
			margin-top: 6px;
			width: 152px;
		}
	}				
</style>

	<div class="page-header page-header-mobile">
		<div class="page-header-row-1">
			<div class="page-wrapper">
				<div class="page-header-row-1-inner">
					<div class="page-header-row-1-col-1 page-header-row-1-col-1-mobile">
						<a class="page-header-logo" href="/" style="background: url( {{url($setting->logo_site)}} );">
							<img src="{{url($setting->logo_site)}}" data-src="{{url($setting->logo_site)}}"	alt="{{$setting->title}}" class="lazy">
						</a>
					</div>
					<div class="page-header-row-1-col-2">
						{{$setting->title}}
						{{-- <div class="JSComponent" id="Suggest1" data-group="search1" data-mode="mobile" data-associatedclass="Suggest" data-template="{urls.template}/Suggest.template"></div> --}}
					</div>
				</div>
			</div>
		</div>
		<div class="page-header-row-2">
			<div class="page-wrapper">
				<div class="page-header-row-2-inner">
					<div class="page-header-row-2-col-1">
						<button class="page-header-hamburger-menu">
							<span></span> <span></span> <span></span>
						</button>
						<p class='page-header-hamburger-menu-text'>منو</p>
					</div>
					<div class="page-header-row-2-col-2" style="height: 60px;">
						<a class="page-header-logo-fixed" style="background-image: url( {{$setting->icon_site}} );margin: auto;height: 100%;width: 64px;" href="/" style='margin: 0 auto; left: 20px;'>خانه</a>
					</div>
					<div class="page-header-row-2-col-3">
						<div class="search-container">
							<span class="page-header-search-fixed search-submit"><i	class="fa fa-search" aria-hidden="true"></i></span>
						</div>
						<a class="page-header-login" href="#"><span class="page-header-login-inner"><i class="fa fa-power-off" aria-hidden="true"></i> &nbsp;</span></a>
					</div>
				</div>
				<div class="page-header-row-3-inner">
					<div class="page-header-row-3-content">
						<ul>
							<li class="menu-item">
								<p class='sub-link-2-title'><strong>Listing</strong></p> 
								<ul class='menu-dropdown'>
									<li><a href="https://www.bourse.lu/listing">Listing	overview</a></li>
									<li><a href="https://www.bourse.lu/e-Listing">e-Listing</a></li>
									<li><a href="https://www.bourse.lu/listing-bonds">Listing a bond</a></li>
									<li><a href="https://www.bourse.lu/listing-shares-gdr">Listing a share/GDR</a></li>									
								</ul>
							</li>
							
							<li class="menu-item">
								<p class='sub-link-2-title'><strong>Trading</strong></p> 
								<ul class='menu-dropdown'>
									<li><a href="https://www.bourse.lu/trading">Trading overview</a></li>
									<li><a href="https://www.bourse.lu/investors">Investors</a></li>
									<li><a href="https://www.bourse.lu/brokers-dealers">Brokers and dealers</a></li>
								</ul>
							</li>
							
							<li class="menu-item">
								<p class='sub-link-2-title'><strong>Information Services</strong></p> 
								<ul class='menu-dropdown'>
									<li><a href="https://www.bourse.lu/information-services">Information Services overview</a></li>
									<li><a href="https://www.bourse.lu/first">FIRST</a></li>
									<li><a href="https://www.bourse.lu/fns">FNS</a></li>
									<li><a href="https://www.bourse.lu/oam">OAM</a></li>
								</ul>
							</li>
							
							<li class="menu-item">
								<p class='sub-link-2-title'><strong>Market data & news</strong></p> 
								<ul class='menu-dropdown'>
									<li><a href="https://www.bourse.lu/market-data-news">Market data & news overview</a></li>
									<li><a href="https://www.bourse.lu/market-news">Market news</a></li>
									<li><a href="https://www.bourse.lu/market-data">Market data</a></li>
									<li><a href="https://www.bourse.lu/market-statistics">Market statistics</a></li>
									<li><a href="https://www.bourse.lu/official-list">Official list</a></li>
								</ul>
							</li>
						
							<li class="menu-item">
								<p class='sub-link-2-title'><strong>Instruments</strong></p> 
								<ul class='menu-dropdown'>
									<li><a href="https://www.bourse.lu/instruments">Instruments overview</a></li>
									<li><a href="https://www.bourse.lu/bonds">Bonds</a></li>
									<li><a href="https://www.bourse.lu/shares-gdr">Shares and GDRs</a></li>
									<li><a href="https://www.bourse.lu/investment-funds-and-etf">Investment funds</a></li>
									<li><a href="https://www.bourse.lu/warrants">Warrants</a></li>
									<li><a href="https://www.bourse.lu/certificates">Certificates</a></li>
									<li><a href="https://www.bourse.lu/short-term-papers">Short term papers</a></li>
								</ul>
							</li>
						
							<li class="menu-item">
								<p class='sub-link-2-title'><strong>Regulation</strong></p> 
								<ul class='menu-dropdown'>
									<li><a href="https://www.bourse.lu/regulations-overview">Regulationoverview</a></li>
									<li><a href="https://www.bourse.lu/the-prospectus-regime">The New Prospectus Regime</a></li>
									<li><a href="https://www.bourse.lu/mifid2-mifir">MiFID II/MiFIR</a></li>
									<li><a href="https://www.bourse.lu/eu-regulatory-landscape">EU Regulatory Landscape</a></li>
									<li><a href="https://www.bourse.lu/corporate-governance">Corporate governance</a></li>
									<li><a href="https://www.bourse.lu/regulatory-mapping">Regulatory Mapping</a></li>
									<li><a href="https://www.bourse.lu/luxse-rules-regulations">LuxSE Rules and Regulations</a></li>
								</ul>
							</li>
						
							<li class="menu-item">
								<p class='sub-link-2-title'><strong>Gateway to China</strong></p> 
								<ul class='menu-dropdown'>
									<li><a href="https://www.bourse.lu/gateway-to-china">Gateway to China overview</a></li>
									<li><a href="https://www.bourse.lu/chinese-domestic-securities-listed-on-chinese-exchanges">Bonds listed and traded on Chinese exchanges </a></li>
									<li><a href="https://www.bourse.lu/chinese-domestic-bonds-traded-on-cibm">Bonds traded on CIBM </a></li>
									<li><a href="https://www.bourse.lu/chinese-domestic-index-series">Chinese domestic index series </a></li>
								</ul>
							</li>
						
							<li class="menu-item">
								<p class='sub-link-2-title'><strong>LGX - Green exchange</strong></p> 
								<ul class='menu-dropdown'>
									<li><a href="https://www.bourse.lu/green">LGX - Green exchange overview</a></li>
									<li><a href="https://www.bourse.lu/how-to-join-lgx">How to join LGX</a></li>
									<li><a href="https://www.bourse.lu/lgx-datahub">The LGX DataHub</a></li>
									<li><a href="https://www.bourse.lu/lgx-academy">LGX Academy</a></li>
								</ul>
							</li>
							
						</ul>
						<ul class='menu-quicknav'>
							<li><a href="/careers">Careers</a></li>
							<li><a href="/about-us">Abouts us</a></li>
							<li><a href="/contact">Contact</a></li>
							<li><a href="/corporate-governance">Corporate governance</a></li>
                            <li><a href="/press-centre">Press</a></li>
						</ul>

						<div class='change-viewport-device-width-button-box'>
							<a href='#' class="change-viewport-device-width-button" data-device="desktop">View desktop version</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- mobile -->

	<div class="page-header page-header-desktop">
		<div class="page-header-row-1">
			<div class="page-wrapper">
				<div class="header-top-box">                                       
						<a href="/about-us" class="header-top-link"><span>درباره ما</span></a>
					<div class="header-top-separator"></div>
						<a href="/careers" class="header-top-link"><span>مشاوران</span></a>
					<div class="header-top-separator"></div>
						<a href="/press-centre" class="header-top-link"><span>بلاگ</span></a>
					<div class="header-top-separator"></div>
						<a href="http://news.bourse.lu" class="header-top-link"><span>اخبار</span></a>
					<div class="header-top-separator"></div>
						<a href="/contact" class="header-top-link"><span>ارتباط با ما</span></a>
					<div class="header-top-separator"></div>
					<div class="header-top-login">
						@if (auth()->user())
							<a href="{{ route('user.index') }}" class="header-top-link"><span style="color: green;">{{auth()->user()->first_name.' '.auth()->user()->last_name}}</span></a>
						@else
							<a href="{{ route('login') }}" class="header-top-link"><span style="color: red;">ورود و ثبت نام</span><i class="fa fa-power-off" style="margin: 0px 6px;color: red;font-size: 14px;" aria-hidden="true"></i></a>
						@endif
					</div>
				</div>

				<div class="page-header-row-1-inner">
					<div class="page-header-row-1-col-1">
						<a class="page-header-logo" style="background: none;" href="/"><img id="logo-top-site" src="{{ $setting->logo_site }}" alt="{{ $setting->title }}" style="visibility: visible;width: 140px;"></a>
					</div>
					<div class="page-header-row-1-col-2 top-search" style="direction: rtl;">
						<div id="home-learn__search-form_1-0">
							<form id="search-form_1-0" role="search" method="get" action="/search" data-tracking-container="true">
								<svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-magnifying-glass"></use></svg>
								<div class="search__wrapper">
									<input type="text" name="q" value="" placeholder="جستجو" maxlength="200" required="">
									<button type="submit">جستجو</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="page-header-row-2">
			<div class="page-wrapper" >
				<div class="page-header-row-2-inner">
					<div class="page-header-row-2-col-1"><a class="page-header-logo-fixed" style="background-image: url( {{ url($setting->icon_site) }} );height: auto;margin-bottom: 12px;width: 42px;" href="/">خانه</a></div>
					<div class="page-header-row-2-col-2">
						<ul class="page-header-nav">
							@foreach ($serviceCats as $key => $serviceCat)
								<li style="width: {{intval(100/$serviceCats->count())}}%" class="@if($key==0||$key==1) list-pre-division @elseif($key==2) list-pre-division-instruments 
									@elseif($key==3) list-pre-division-regulations @elseif($key==4) list-pre-division-china @elseif($key==5) list-pre-division-lgx @elseif($key==6) list-division @endif ">
									
									<span class="sub-link-1 has-dropdown @if($key==0||$key==1) sub-link-information-services @elseif($key==2) bg-lightgrey sub-link-market @elseif($key==3)
									 bg-lightgrey sub-link-instruments @elseif($key==4) bg-lightgrey sub-link-regulations @elseif($key==5) bg-lightgrey sub-link-china @elseif($key=6) bg-lightgrey sub-link-lgx @endif">
										{{$serviceCat->title}}
									</span>
									<div class="sub-dropdown">
										<div class="page-wrapper" style="max-width: 1120px;margin: auto;">
											<div class="page-header-nav-dropdown-grid">
												<div class="sub-column-1">
													<ul class="sub-list-2">
														@foreach ($SubServices->where('service_id', $serviceCat->id) as $item)
															<li>
																<a class="sub-link-2" href="{{ route('user.subServices',$item->id) }}">
																	<span class="sub-link-2-title">{{$item->title}}</span>
																	<span class="sub-link-2-description">{{$item->description}}</span>
																</a>
															</li>
														@endforeach
													</ul>
												</div>
												<div class="sub-column-2">
													<h5 class="page-header-nav-dropdown-title">دسترسی سریع</h5>
													<div class="section-content-text" style="min-height: 30px;">
														<ul class="bullet-list">
															@foreach ($SubServices->where('service_id', $serviceCat->id) as $item)
																<li><a href="{{ route('user.subServices',$item->id) }}">{{$item->title}}</a></li>
															@endforeach
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
					<div class="page-header-row-2-col-3">
						<div class="search-container">
							<span class="page-header-search-fixed">
								<i class="fa fa-search" aria-hidden="true"></i>
							</span>
						</div>
						<div class="search-ghost"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- desktop -->

	<div id="page-body">

		<div class="section-introduction-hp">
			<div id="slider-hero" class="serialswipe">
				<div class="serialswipe-wrapper">
					<ul class="serialswipe-list">
						@foreach ($sliders as $slider)
							<li>
								<div class="slider-hero-item" data-serialswipe-background="{{$slider->photo->path}}">
									<div class="slider-hero-inner">
										<div class="page-wrapper">
											<div class="slider-hero-content">
												<h3 data-serialswipe-fx="slidetop" class="slider-hero-title">{{$slider->title}}</h3>
												<p data-serialswipe-fx="slideleft">{{$slider->description}}</p>
												<a href="{{$slider->link}}" target="_blank" data-serialswipe-fx="slidebottom" class="btn btn-slider">
													<i class="fa fa-angle-left" aria-hidden="true"></i>
													{{$slider->link_title}}
												</a>
											</div>
										</div>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
				
		<div id="section-content"  >
			<div class="page-wrapper">
				<div id="section-content-col-1">
					<div class="grid-container" >
						<div class="grid-flex" style="background: #f5f5f6">
							<div class="sub-column-100">
								<div class="section-content-text" style="min-height: 30px;">
									<h2 class="title-3 text-center">متن عنوان این سکشن&nbsp;</h2>
								</div>
								<div id="home-learn__search-form_1-0">
									<form id="search-form_1-0" role="search" method="get" action="/search" data-tracking-container="true">
										<svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-magnifying-glass"></use></svg>
										<div class="search__wrapper">
											<input type="text" name="q" value="" placeholder="جستجو" maxlength="200" required="">
											<button type="submit">جستجو</button>
										</div>
									</form>
								</div>
								<div class="list-news">
									<ul class="box-bg-button box-bg-button-shop" style="width: -webkit-fill-available;">
										@foreach($serviceCats->take(6) as $service)
                                            <li class="list-news-item">
                                                <div class="section-hp-news">
													<div class="img-container lazy" data-bg="url( {{is_null($service->pic)?'https://www.bourse.lu/img/+news-HP-LUXSE-Avis-LuxRI_2022.jpg':url($service->pic)}} )" style="margin: auto;background-repeat: no-repeat;background-size: cover;">
														<div class="cache">
															<i class="fa fa-chevron-right" aria-hidden="true"></i>
														</div>
													</div>
													<a href="#" target="_blank" style="margin: 10% 6% 0px;color: blue;">
														{{$service->title}}
													</a>
													<div class="content">
														<p>{{$service->description}}</p>
													</div>
													<a href="{{ route('user.services',$service->id) }}">
														<div class="box">
															<i class="fa fa-angle-left" aria-hidden="true"></i>
															نمایش
														</div>
													</a>
                                                </div>     
                                            </li>
                                        @endforeach
										
									</ul>
								</div>
								<a href='/news' class="btn btn-full" ><i class="fa fa-angle-left" aria-hidden="true" style="margin: 0px 8px;"></i>نمایش همه دسته ها</a>
							</div>
						</div>
		
						<div class="grid-flex">
							<div class="sub-column-100">
								<div class="section-content-text" style="min-height: 30px;"><h2 class="title-3 text-center">متن عنوان این سکشن </h2></div>
								<div class="grid-lol-grid-3-container">
									<div class="row-lol-grid-3">
										<div class="col-lol-grid-3-lg-4 col-lol-grid-3-md-12 col-lol-grid-3-sm-12 col-lol-grid-3-xs-12">
											<div class="col-content-lol-grid-3 col-content-lol-grid-3-small-height" style="display: flex;direction: rtl;">
												<span class="counter">01</span>
												<a href='/listing' class="content lazy" data-bg="url(https://www.bourse.lu/img/button-LISTING.jpg)" style="background-position: center; background-repeat: no-repeat;width:35%" >
													{{-- <h3 class="title">Listing</h3> 
													<span class="btn">Listing <i class="fa fa-angle-right" aria-hidden="true"></i></span> --}}
												</a>
												<div style="width: 55%;margin: 5%;">
													<p style="margin: 0px">عنوان پست</p>
													<h3>توضیحات مربوط به این پست یک یا دو خط باشد</h3>
												</div>
											</div>
										</div>
					
										<div class="col-lol-grid-3-lg-4 col-lol-grid-3-md-12 col-lol-grid-3-sm-12 col-lol-grid-3-xs-12">
											<div class="col-content-lol-grid-3 col-content-lol-grid-3-small-height" style="display: flex;direction: rtl;">
												<span class="counter">02</span>
												<a href='/market-data' class="content lazy" data-bg="url(https://www.bourse.lu/img/button-MARKET_DATA.jpg)" style="background-position: center; background-repeat: no-repeat;width:35%" >
													{{-- <h3 class="title">Market data</h3> 
													<span class="btn">Market data <i class="fa fa-angle-right" aria-hidden="true"></i></span> --}}
												</a>
												<div style="width: 55%;margin: 5%;">
													<p style="margin: 0px">عنوان پست</p>
													<h3>توضیحات مربوط به این پست یک یا دو خط باشد</h3>
												</div>
											</div>
										</div>
									</div>
									<a href="#" style="text-decoration: none;color: #2c40d0;font-size: 1.2rem;float: right;margin: auto 16px;">
										<i class="fa fa-angle-left" aria-hidden="true" style="font-size: 16px;padding: 0px 4px;color: #ff8c6c;font-weight: bold;"></i>
										نمایش همه موارد
									</a>
								</div>
							</div>
						</div>

						<div class="grid-flex banafsh" style="padding: 0px 3% 2%;">
							<div class="sub-column-100">
								{{-- <div class="section-content-text" style="min-height: 30px;">
									<h2 class="title-3 text-center">LuxSE: a&nbsp;one-stop-shop solution for issuers</h2>
								</div> --}}
								<div class="grid-lol-grid-3-container">
									<div class="row-lol-grid-3">
										<div class="col-lol-grid-3-lg-4 col-lol-grid-3-md-12 col-lol-grid-3-sm-12 col-lol-grid-3-xs-12">
											<div class="col-content-lol-grid-3 col-content-lol-grid-3-small-height" style="display: flex;height: 368px !important;">
												<video width="100%" controls>
													<source src="{{asset('/test.mp4')}}" type="video/mp4">
													Your browser does not support the video tag.
												</video>
											</div>
											<h3>توضیحات مربوط به این ویدیو یک یا دو خط باشد</h3>
										</div>
					
										<div class="col-lol-grid-3-lg-4 col-lol-grid-3-md-12 col-lol-grid-3-sm-12 col-lol-grid-3-xs-12">
											<div class="row-lol-grid-3 mix-for-sm">
												<div class="col-lol-grid-3-lg-4">
													<div class="col-content-lol-grid-3 col-content-lol-grid-3-small-height" style="display: flex;">
														<video width="100%" controls>
															<source src="{{asset('/test.mp4')}}" type="video/mp4">
															Your browser does not support the video tag.
														</video>
													</div>
													<h3>توضیحات مربوط به این ویدیو یک یا دو خط باشد</h3>
												</div>
							
												<div class="col-lol-grid-3-lg-4">
													<div class="col-content-lol-grid-3 col-content-lol-grid-3-small-height" style="display: flex;">
														<video width="100%" controls>
															<source src="{{asset('/test.mp4')}}" type="video/mp4">
															Your browser does not support the video tag.
														</video>
													</div>
													<h3>توضیحات مربوط به این ویدیو یک یا دو خط باشد</h3>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>



		
					</div>
				</div>
			</div>
		</div>

		<div id="site-title">
			<h3>محل نمایش شعار سایت یک الی دو خط</h3>
		</div>
		
	</div>
    
@endsection