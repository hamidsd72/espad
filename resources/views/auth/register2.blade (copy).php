@extends('layouts.layout_first_page')
@section('content')

    <div id="page" data-csrf="eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJAQW5vbnltb3VzOjphM2M4ZjAwMS1kZTJmLTRmY2EtODViNC1kOGMwODQyYmI4ODgiLCJjcmVhdGVkIjoxNjYwNTUwNzQ5ODQ0LCJleHAiOjE2NjA1OTM5NDl9.EPry49Maic3P9mysMP2yGA9PwpBted4Qzmat8OFIKx3lWCPM9D4YcE38SlQHKEroM2-viIkePhN11JkZsra-gg">

	<div class="page-header page-header-mobile">
		<div class="page-header-row-1">
			<div class="page-wrapper">
				<div class="page-header-row-1-inner">
					<div class="page-header-row-1-col-1 page-header-row-1-col-1-mobile">
						<a class="page-header-logo" href="/"> <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
							data-src="https://www.bourse.lu/img/page-HEADER-logo_luxse.png"	alt="Luxembourg Stock Exchange" class="lazy">
						</a>
					</div>
					<div class="page-header-row-1-col-2">
						<div class="JSComponent" id="Suggest1" data-group="search1" data-mode="mobile" data-associatedclass="Suggest" data-template="{urls.template}/Suggest.template"></div>
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
						<p class='page-header-hamburger-menu-text'>MENU</p>
					</div>
					<div class="page-header-row-2-col-2">
						<a class="page-header-logo-fixed" href="/" style='margin: 0 auto; left: 20px;'>Home</a>
					</div>
					<div class="page-header-row-2-col-3">
						<div class="search-container">
							<span class="page-header-search-fixed search-submit"><i	class="fa fa-search" aria-hidden="true"></i></span>
						</div>
						<a class="page-header-login" href="https://auth.bourse.lu"><span class="page-header-login-inner"><i class="fa fa-power-off" aria-hidden="true"></i> &nbsp;</span></a>
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
									<li><a href="https://www.bourse.lu/listing-investment-funds-etf">Listing an investment fund/ETF</a></li>
									<li><a href="https://www.bourse.lu/listing-warrants">Listing a warrant/certificate</a></li>
									<li><a href="https://www.bourse.lu/listing-programmes">Listing under a programme</a></li>
									<li><a href="https://www.bourse.lu/listing/luxse-market-or-euro-mtf">BdL market vs Euro MTF</a></li>
									<li><a href="https://www.bourse.lu/listing-process">Listing process</a></li>
									<li><a href="https://www.bourse.lu/listing-members">Listing Members</a></li>
									<li><a href="https://www.bourse.lu/luxse-sol">Securities Official List (SOL)</a></li>
									<li><a href="https://www.bourse.lu/SecurityTokens">Admitting security tokens on SOL</a></li>
									<li><a href="https://www.bourse.lu/professional-segments">Professional Segments</a></li>										
								</ul>
							</li>
							
							<li class="menu-item">
								<p class='sub-link-2-title'><strong>Trading</strong></p> 
								<ul class='menu-dropdown'>
									<li><a href="https://www.bourse.lu/trading">Trading overview</a></li>
									<li><a href="https://www.bourse.lu/investors">Investors</a></li>
									<li><a href="https://www.bourse.lu/brokers-dealers">Brokers and dealers</a></li>
									<li><a href="https://www.bourse.lu/trading-members">Trading members</a></li>										
									<li><a href="https://www.bourse.lu/closing-days">Opening hours and closing days</a></li>
									<li><a href="https://www.bourse.lu/clearing-settlement">Clearing and settlement</a></li>
									<li><a href="https://www.bourse.lu/market-makers">Market Makers and Liquidity Providers</a></li>
								</ul>
							</li>
							
							<li class="menu-item">
								<p class='sub-link-2-title'><strong>Information Services</strong></p> 
								<ul class='menu-dropdown'>
									<li><a href="https://www.bourse.lu/information-services">Information Services overview</a></li>
									<li><a href="https://www.bourse.lu/first">FIRST</a></li>
									<li><a href="https://www.bourse.lu/fns">FNS</a></li>
									<li><a href="https://www.bourse.lu/oam">OAM</a></li>
									<li><a href="https://www.bourse.lu/market-data-products">Market data products</a></li>
									<li><a href="https://www.bourse.lu/lei">LEI - Legal Entity Identifier</a></li>
									<li><a href="https://www.bourse.lu/perma-link-upload-service">PLUS - Perma Link Upload Service</a></li>
									<li><a href="https://www.bourse.lu/final-terms-filing-service">Final Terms filing service</a></li>
									<li><a href="https://www.bourse.lu/stops-on-bearer-securities">Stops on bearer securities</a></li>
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
									<li><a href="https://www.bourse.lu/lgx-assistance-services">LGX Assistance Services</a></li>
									<li><a href="https://www.bourse.lu/instruments-on-lgx">LGX Bonds</a></li>
									<li><a href="https://www.bourse.lu/lgx-funds">LGX Funds</a></li>
									<li><a href="https://www.bourse.lu/chinese-domestic-green-securities">Chinese domestic green securities</a></li>
									<li><a href="https://www.bourse.lu/climate-bonds-lgx-climate-aligned-issuers">Climate Bonds – LGX Climate-Aligned Issuers</a></li>
									<li><a href="https://www.bourse.lu/sustainability_standards_and_labels">Sustainability standards and labels</a></li>
									<li><a href="https://www.bourse.lu/guide-to-esg-reporting">LuxSE Guide to ESG Reporting</a></li>
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
						<a href="/about-us" class="header-top-link"><span>About Us</span></a>
					<div class="header-top-separator"></div>
						<a href="/careers" class="header-top-link"><span>Careers</span></a>
					<div class="header-top-separator"></div>
						<a href="/press-centre" class="header-top-link"><span>Press</span></a>
					<div class="header-top-separator"></div>
						<a href="http://news.bourse.lu" class="header-top-link"><span>News</span></a>
					<div class="header-top-separator"></div>
						<a href="/contact" class="header-top-link"><span>Contact</span></a>
					<div class="header-top-separator"></div>
					<div class="header-top-login">
						@if (auth()->user())
							<a href="{{ route('user.index') }}" class="header-top-link"><span>{{auth()->user()->first_name.' '.auth()->user()->last_name}}</span></a>
						@else
							<a href="{{ route('login') }}" class="header-top-link"><span>ورود و ثبت نام</span></a>
						@endif
					</div>
				</div>

				<div class="page-header-row-1-inner">
					<div class="page-header-row-1-col-1">
						<a class="page-header-logo" style="background: none;" href="/"><img src="{{ $setting->logo_site }}" alt="Luxembourg Stock Exchange" style="visibility: visible;"></a>
					</div>
					<div class="page-header-row-1-col-2">
						<div class="JSComponent" id="Suggest2" data-group="search1" data-mode="desktop" data-associatedclass="Suggest" data-template="{urls.template}/Suggest.template"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="page-header-row-2">
			<div class="page-wrapper">
				<div class="page-header-row-2-inner">
					<div class="page-header-row-2-col-1"><a class="page-header-logo-fixed" style="background-image: url( {{ url($setting->icon_site) }} )" href="/">خانه</a></div>
					<div class="page-header-row-2-col-2">
						<ul class="page-header-nav">
							@foreach ($serviceCats as $key => $serviceCat)
								<li style="width: {{intval(100/$serviceCats->count())}}%">
									<span class="sub-link-1 has-dropdown @if($key==1) sub-link-information-services @elseif($key==2) bg-lightgrey sub-link-market @elseif($key==3)
									bg-lightgrey sub-link-instruments @elseif($key==4) bg-lightgrey sub-link-regulations @elseif($key==5) bg-lightgrey sub-link-china @elseif($key==6) bg-lightgrey sub-link-lgx @endif">
										{{$serviceCat->title}}
									</span>
									<div class="sub-dropdown">
										<div class="page-wrapper">
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
													{{$slider->link_title}}<i class="fa fa-angle-right" aria-hidden="true"></i>
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
					<div class="grid-container">
						<div class="grid-flex">
							<div class="sub-column-100">
								<div class="LuxSEComponent" data-component-prop-name="Ticker" data-component-prop-api='api:{"urls": ["indice/45"]}'></div>
								<div class="section-content-text" style="min-height: 30px;">
									<h2 class="title-3">Latest news&nbsp;</h2>
									<p><a href="/closing-days#2022"><strong>2022 Closing days</strong></a> of our markets are now available in our Trading section.</p>
								</div>
								<div class="list-news">
									<ul class="box-bg-button box-bg-button-shop">

										<li class="list-news-item">
											<h3 class="title-6">LuxRI Fund Index revision</h3>
											<div class="section-hp-news">
												<a href='pr-luxse-revision-luxri-index-2022' target="_blank">
													<div class="img-container lazy" data-bg="url(https://www.bourse.lu/img/+news-HP-LUXSE-Avis-LuxRI_2022.jpg)" style="background-repeat: no-repeat;background-size: cover;">
														<div class="cache">
															<i class="fa fa-chevron-right" aria-hidden="true"></i>
														</div>
													</div>
													<div class="content">
														<p>The LuxRI Fund Index will be rebalanced as of 1 July 2022, in accordance with the rules governing the index.</p>
													</div>
												</a>
											</div>     
										</li>
					
										<li class="list-news-item">
											<h3 class="title-6">LuxX Index interim revision</h3>
											<div class="section-hp-news">
												<a href='pr-luxse-interim-revision-luxx-index-2022' target="_blank">
													<div class="img-container lazy" data-bg="url(https://www.bourse.lu/img/news-HP-LUXSE-Avis-LuxX-2019)" style="background-repeat: no-repeat;background-size: cover;">
														<div class="cache">
															<i class="fa fa-chevron-right" aria-hidden="true"></i>
														</div>
													</div>
													<div class="content">
														<p>The LuxX Index will be rebalanced as of 1 July 2022, in accordance with the rules governing the index.</p>
													</div>
												</a>
											</div>     
										</li>
									
										<li class="list-news-item">
											<h3 class="title-6">LuxSE wins new award</h3>
											<div class="section-hp-news">
												<a href='/pr-luxse-named-stock-exchange-of-the-year-by-EF' target="_blank">
													<div class="img-container lazy" data-bg="url(https://www.bourse.lu/img/HP_PR-LUXSE-LuxSE_wins_EF_stock_exchange_award.png)" style="background-repeat: no-repeat;background-size: cover;">
														<div class="cache">
															<i class="fa fa-chevron-right" aria-hidden="true"></i>
														</div>
													</div>
													<div class="content">
														<p>The Luxembourg Stock Exchange was granted the ‘Stock Exchange of the Year’ award in Environmental Finance’s Sustainable Investment Awards 2022. </p>
													</div>
												</a>
											</div>     
										</li>
									
										<li class="list-news-item">
											<h3 class="title-6">LuxSE & India INX strengthen ties</h3>
											<div class="section-hp-news">
												<a href='/pr-luxse-and-inx-strengthen-cooperation' target="_blank">
													<div class="img-container lazy" data-bg="url(https://www.bourse.lu/img/HP_PR-LUXSE-LuxSE-and-INX-strengthen-cooperation.ng)" style="background-repeat: no-repeat;background-size: cover;">
														<div class="cache">
															<i class="fa fa-chevron-right" aria-hidden="true"></i>
														</div>
													</div>
													<div class="content">
														<p>LuxSE and India INX took their next steps together by signing a cooperation agreement during a ceremony held in Gujarat, India.</p>
													</div>
												</a>
											</div>     
										</li>
				
									</ul>
								</div>
								<a href='/news' class="btn btn-full" >See all news<i class="fa fa-angle-right" aria-hidden="true"></i></a>
							</div>
						</div>
		
						<div class='grid-flex  no-flex '>

							<div class="sub-column-50">
								<div class="section-content-text" style="min-height: 30px;">
									<h2 class="title-3">LuxSE markets</h2>
								</div>
							</div>

							<div class="sub-column-50">
								<div class="section-content-text" style="min-height: 30px;">
									<h2 class="title-3"></h2>
								</div>
							</div>

						</div>
		
						<div class='grid-flex  no-flex '>
							<div class="sub-column-50">
								<div class="section-content-text" style="min-height: 30px;"><h3 class="title-6">LuxSE indices</h3></div>
								<div class="JSComponent" data-template="{urls.template}/CarouselChart.template"	data-associatedclass="CarouselChart" data-data='json:{"ids": "/index/LU0916824781/45;/index/LU0940704496/67"}'></div>
							</div>

							<div class="sub-column-50">
								<div class="section-content-text" style="min-height: 30px;"><h3 class="title-6">Market Activity</h3></div>
								<div class="LuxSEComponent" data-component-prop-name="TickersMarket" data-component-prop-api='api:{"urls": ["top-traded-securities", "last-trades"]}'></div>
							</div>
						</div>
		
						<div class='grid-flex  no-flex '>
							<div class="sub-column-50">
								<div class="LuxSEComponent" data-component-prop-name="MarketStatus" data-component-prop-api='api:{"urls": ["market-status"]}'></div>
							</div>

							<div class="sub-column-50">
								<a href='/market-data' class="btn btn-full" >Market data<i class="fa fa-angle-right" aria-hidden="true"></i></a>
							</div>
						</div>
		
						<div class="grid-flex">
							<div class="sub-column-100">
								<div class="section-content-text" style="min-height: 30px;"><h2 class="title-3">Issuers and LuxSE notices (FNS)</h2></div>
								<div  data-associatedclass="BoxData" class="JSComponent"  data-data='{urls.api}/latest-fns/5'  data-language="EN"  data-template="/js/NoticesList.template"  data-translations="/js/Issuer.translation">&nbsp;</div>
							</div>
						</div>
		
						<div class='grid-flex  no-flex '>
							<div class="sub-column-50">
								<div class="section-content-text" style="min-height: 30px;"><h2 class="title-3">Gateway to China</h2></div>
								<div class="list-container">
									<ul class="box-bg-button box-bg-button-shop">
										<li class="box-bg-button-item">
											<a href='/gateway-to-china' class="content lazy" data-bg="url(https://www.bourse.lu/img/button-INSTRUMENTS-rmb_bonds-china.jpg)" style="background-position: center; background-repeat: no-repeat;" >
												<h3 class="title">Gateway to China</h3> 
												<span class="btn">Gateway to China <i class="fa fa-angle-right" aria-hidden="true"></i></span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							
							<div class="sub-column-50">
								<div class="section-content-text" style="min-height: 30px;"><h2 class="title-3">Luxembourg Green Exchange</h2></div>
								<div class="list-container">
									<ul class="box-bg-button box-bg-button-shop">
										<li class="box-bg-button-item">
											<a href='/green' class="content lazy" data-bg="url(https://www.bourse.lu/img/button_img-LGX.jpg)" style="background-position: center; background-repeat: no-repeat;" >
												<h3 class="title">Luxembourg Green Exchange</h3> 
												<span class="btn">Luxembourg Green Exchange <i class="fa fa-angle-right" aria-hidden="true"></i></span>
											</a>
										</li>
									</ul>
								</div>
							</div>

						</div>
		
						<div class="grid-flex">
							<div class="sub-column-100">
								<div class="section-content-text" style="min-height: 30px;"><h2 class="title-3">LuxSE: a&nbsp;one-stop-shop solution for issuers</h2></div>
								<div class="grid-lol-grid-3-container">
									<div class="row-lol-grid-3">
										<div class="col-lol-grid-3-lg-4 col-lol-grid-3-md-12 col-lol-grid-3-sm-12 col-lol-grid-3-xs-12">
											<div class="col-content-lol-grid-3 col-content-lol-grid-3-small-height">
												<a href='/listing' class="content lazy" data-bg="url(https://www.bourse.lu/img/button-LISTING.jpg)" style="background-position: center; background-repeat: no-repeat;" >
													<h3 class="title">Listing</h3> 
													<span class="btn">Listing <i class="fa fa-angle-right" aria-hidden="true"></i></span>
												</a>
											</div>
										</div>
									
										<div class="col-lol-grid-3-lg-4 col-lol-grid-3-md-12 col-lol-grid-3-sm-12 col-lol-grid-3-xs-12">
											<div class="col-content-lol-grid-3 col-content-lol-grid-3-small-height">
												<a href='/trading' class="content lazy" data-bg="url(https://www.bourse.lu/img/button-TRADING.jpg)" style="background-position: center; background-repeat: no-repeat;" >
													<h3 class="title">Trading</h3> 
													<span class="btn">Trading <i class="fa fa-angle-right" aria-hidden="true"></i></span>
												</a>
											</div>
										</div>
					
										<div class="col-lol-grid-3-lg-4 col-lol-grid-3-md-12 col-lol-grid-3-sm-12 col-lol-grid-3-xs-12">
											<div class="col-content-lol-grid-3 col-content-lol-grid-3-small-height">
												<a href='/market-data' class="content lazy" data-bg="url(https://www.bourse.lu/img/button-MARKET_DATA.jpg)" style="background-position: center; background-repeat: no-repeat;" >
													<h3 class="title">Market data</h3> 
													<span class="btn">Market data <i class="fa fa-angle-right" aria-hidden="true"></i></span>
												</a>

											</div>
										</div>
									
									</div>
								</div>
							</div>
						</div>
		
						<div class="grid-flex">
							<div class="sub-column-100">
								<div class="section-content-text" style="min-height: 30px;"><h2 class="title-3">Membership of LuxSE</h2></div>
								<div class="section-box section-partners">
									<div class="serialslider" data-serialslider-max='4'>
										<ul class="serialslider-list">
											<li>
												<div class="img-container">
													<a href="https://www.world-exchanges.org/home/" target="_blank">
														<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="https://www.bourse.lu/img/logo-wfe.jpg" alt="logo-wfe.jpg" class="lazy">
													</a>
												</div>
											</li>
										
											<li>
												<div class="img-container">
													<a href="http://www.fese.eu/" target="_blank">
														<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="https://www.bourse.lu/img/logo-fese.png" alt="logo-fese.png" class="lazy">
													</a>
												</div>
											</li>
										
											<li>
												<div class="img-container">
													<a href="http://www.sseinitiative.org/" target="_blank">
														<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="https://www.bourse.lu/img/logo-sse.jpg" alt="logo-sse.jpg" class="lazy">
													</a>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
    
@endsection























{{-- @extends('layouts.app')
@section('content')

    <div class="home-guest d-none d-lg-block">
        
        <section id="navigation" class="shadow" >
            <div class="content navigation">
                <div class="nav-menu">
                    <ul class="nav main-nav">
                        <li class="active"><a class="scroll" href="#slider-one">تازه ها</a></li>
                        <li><a class="scroll" href="#i-moshaver">آی مشاور</a></li>
                        <li><a class="scroll" href="#text_rule">درباره ما ۲</a></li>
                        <li><a class="scroll" href="#serviceCat">کارکاه ها</a></li>
                        <li><a class="scroll" href="#foter">تماس با ما</a></li>
                        <li><a href="{{route('user.home-guost-pwa')}}" class="" > راهنمای نصب اپلیکیشن</a></li>
                    </ul>
                    <div class="logo-custom-one"><img src="{{asset('assets/images/logo.png')}}" alt="imshaaver.ir"></div>
                </div>
            </div>
        </section>

        <section id="slider-one" class="container my-lg-5 p-0">
            <div id="demo2" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    @for ($i = 0; $i < $sliders->count(); $i++)
                        @if ($i == 0)
                            <li data-target="#demo" data-slide-to="0" class="active"></li> 
                        @else
                            <li data-target="#demo" data-slide-to="{{$i}}"></li>
                        @endif
                    @endfor
                </ul>
                <div class="carousel-inner">
                    @foreach ($sliders as $slider)
                        @if ($sliders[0]->id == $slider->id)

                            <div class="carousel-item active">
                                <a href="{{$slider->link}}" target="_blank" >
                                    <img src="{{$slidersPhotos->where('pictures_id', $slider->id)->first()->path}}" alt="Los Angeles" ">
                                    <div class="carousel-caption ">
                                        <h4 class="text-light">{{$slider->title}}</h4>
                                    </div>   
                                </a>
                            </div>
                            
                        @else
                        
                            <div class="carousel-item">
                                <a href="{{$slider->link}}" target="_blank" >
                                    <img src="{{$slidersPhotos->where('pictures_id', $slider->id)->first()->path}}" alt="Los Angeles" ">
                                    <div class="carousel-caption ">
                                        <h4 class="text-light">{{$slider->title}}</h4>
                                    </div>   
                                </a>
                            </div>

                        @endif

                    @endforeach
                </div>
            </div>
        </section>

        <section id="i-moshaver"><h1 class="text-white text-center py-lg-4 bg-custom-green">اپلیکیشن آی مشاور</h1></section>

        <section id="title-one">

            <div class="container">
                <div class="bg-white redu30 row p-5 my-5">
                    <div class="col pt-5 px-5 h5 head">
                        {!! $about->text_target !!}
                        <hr class="my-5">
                        <a href="{{route('user.home-guost-pwa')}}" class="btn bg-custom-green text-white px-5 py-3 redu20" >ورود و راهنمای نصب اپلیکیشن</a>
                    </div>
                    <div class="col"><img src="{{$about->pic_rule}}" alt="" class="redu50 shadow" style="width: 100%;"></div>
                </div>
            </div>
                    
        </section>

        <section id="text_rule" class="bg-custom-green pt-4">
            <div class="container py-4">
                <div class="px-lg-5">
                    <h1 class="text-white pb-3">درباره آی مشاور</h1>
                    {!! $about->text_rule !!}
                </div>
            </div>
        </section>

        <section id="serviceCat" class="py-5">
            <div class="container bg-white redu40 p-4">
                <div class="row">
                    <div class="col-12 mx-5 px-4">
                        <h1 class="pb-4">دسترسی به همه کارگاه ها</h1>
                    </div>
                    @foreach($serviceCat as $service)
                        <a href="{{route('user.home-guost-pwa')}}" class="@if($serviceCat->count()==4) col-lg-3 @else col-lg-4 @endif text-center px-5">
                            <div class="card card-style">
                                <img src="{{ url('/source/asset/assets/images/categories/'.$service->title.'.jpg') }}" alt="{{$service->title}}">
                            </div>
                            <h3>کارگاه های {{$service->title}}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="foter" class="social-network text-center bg-custom-green pt-4">
            <div class="row text-white m-0">
                <h1 class="col-12 text-white py-1">تماس با آی مشاور</h1>
                
                <small class="col-12 my-2 foter">{!!$about->text_home!!}</small>
                <hr class="my-2">
                <div class="col-12 my-2">
                    @foreach ($network as $net)
                        <a href="{{$net->address}}" class="box mx-1">
                            @switch($net->config)
                                @case("instagram")
                                    <i class="fab fa-instagram text-white"></i>
                                    @break
                                @case("whatsapp")
                                    <i class="fab fa-whatsapp text-white"></i>
                                    @break
                                @case("email")
                                    <i class="fa fa-envelope text-white"></i>
                                    @break
                            @endswitch
                        </a>
                    @endforeach
                </div>

            </div>
        </section>
            
    </div>

    <div class="home-guest-big d-lg-none">

        <div class="content navigation nav-99 m-0 bg-custom-green"> 
            <a href="{{route('user.home-guost-pwa')}}" > اپلیکیشن</a>
            <div class="logo-custom-one-sm"><img src="{{asset('assets/images/logo.png')}}" alt="imshaaver.ir"></div>
        </div>

        <section id="slider-one" class="pt-5">
            <div id="demo" class="carousel slide p-3" data-ride="carousel">
                <ul class="carousel-indicators">
                    @for ($i = 0; $i < $sliders->count(); $i++)
                        @if ($i == 0)
                            <li data-target="#demo" data-slide-to="0" class="active"></li> 
                        @else
                            <li data-target="#demo" data-slide-to="{{$i}}"></li>
                        @endif
                    @endfor
                </ul>
                <div class="carousel-inner">
                    @foreach ($sliders as $slider)
                        @if ($sliders[0]->id == $slider->id)
        
                            <div class="carousel-item active">
                                <a href="{{$slider->link}}" target="_blank" >
                                    <img src="{{$slidersPhotos->where('pictures_id', $slider->id)->first()->path}}" alt="Los Angeles" ">
                                    <div class="carousel-caption p-0 pt-2" style="right: 12px !important;">
                                        <a href="{{$slider->link}}" target="_blank" class="p-1 px-2 text-white bg-secondary " style="font-weight: bold;border-radius: 20px;">{{$slider->title}}</a>
                                    </div>   
                                </a>
                            </div>
                            
                        @else
                        
                            <div class="carousel-item">
                                <a href="{{$slider->link}}" target="_blank" >
                                    <img src="{{$slidersPhotos->where('pictures_id', $slider->id)->first()->path}}" alt="Los Angeles" ">
                                    <div class="carousel-caption p-0 pt-2" style="right: 12px !important;">
                                        <a href="{{$slider->link}}" target="_blank" class="p-1 px-2 text-white bg-secondary " style="font-weight: bold;border-radius: 20px;">{{$slider->title}}</a>
                                    </div>   
                                </a>
                            </div>
        
                        @endif
        
                    @endforeach
                </div>
            </div>
        </section>

        <section id="i-moshaver" style="background: #2f665f;" class="py-3 mt-2"><h1 class="text-white text-center">آی مشاور</h1></section>

        <section id="title-one">
            <div class="col-10 mx-auto">
                <img src="{{$about->pic_rule}}" alt="" class="border-redius50 shadow p-1 mt-3" style="width: 100%;">
            </div>
            <div class="p-4 h6 head-c">
                {!! $about->text_target !!}
                <hr class="my-4">
                <a href="{{route('user.home-guost-pwa')}}" class="btn btn-success border-redius20" style="background: #2f665f;">ورود و راهنمای نصب اپلیکیشن</a>
            </div>
        </section>

        <section id="text_rule" class="bg-secondary p-4">
            <h1 class="text-white pb-3">درباره آی مشاور</h1>
            {!! $about->text_rule !!}
        </section>

        <section id="serviceCat" class="pt-4">
            <div class="mx-auto" style="max-width: 1240px;">
                <div class="row mx-2">
                    <div class="col-12 text-center">
                        <h1 class="pb-4">دسترسی به همه کارگاه ها</h1>
                    </div>
                    @foreach($serviceCat as $service)
                        <div class="col-10 mx-auto bg-white text-center p-3 redu30 mb-4">
                            <a href="{{route('user.home-guost-pwa')}}" class="mb-2">
                                <img style="width: 100%;border-radius: 20px;max-height: 140px;" src="{{ url('/source/asset/assets/images/categories/'.$service->title.'.jpg') }}" alt="{{$service->title}}">
                            </a>    
                            <h6 style="font-weight: bold;margin: 12px 0px 0px;">کارگاه های {{$service->title}}</h6>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="foter" class="social-network text-center bg-secondary p-3">
            <div class="row text-white mb-0">
                <h1 class="col-12 text-white py-1">تماس با آی مشاور</h1>
                
                <small class="col-12 my-2 foter">{!!$about->text_home!!}</small>
                <hr >
                <div class="col-12 mt-2">
                    @foreach ($network as $net)
                        <a href="{{$net->address}}" class="box mx-1">
                            @switch($net->config)
                                @case("instagram")
                                    <i class="fab fa-instagram text-white"></i>
                                    @break
                                @case("whatsapp")
                                    <i class="fab fa-whatsapp text-white"></i>
                                    @break
                                @case("email")
                                    <i class="fa fa-envelope text-white"></i>
                                    @break
                            @endswitch
                        </a>
                    @endforeach
                </div>

            </div>
        </section>

    </div>

    <script type="text/javascript" src="{{ asset('assets/scripts/js/jquery-1.10.2.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/js/bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/js/jquery.appear.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/scripts/js/jquery.countTo.js')}}"></script>

	<script type="text/javascript" src="{{ asset('assets/scripts/js/waypoints.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/js/jquery.prettyPhoto.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/js/modernizr-latest.js')}}"></script>
    
	<script type="text/javascript" src="{{ asset('assets/scripts/js/jquery.parallax-1.1.3.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/js/jquery.easing.1.3.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/js/jquery.sticky.js')}}"></script>
    
	<script type="text/javascript" src="{{ asset('assets/scripts/js/owl.carousel.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/js/jquery.isotope.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/js/rev-slider/jquery.themepunch.plugins.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/scripts/js/rev-slider/jquery.themepunch.revolution.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/js/scripts.js')}}"></script>
@endsection --}}
