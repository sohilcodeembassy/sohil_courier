@extends('layouts.user')

@section('content')
<div class="bg-image page-title">
				<div class="container-fluid">
					<a href="#"><h1>road transportation</h1></a>
					<div class="pull-right">
						<a href="01_home.html"><i class="fa fa-home fa-lg"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="06_services.html">Our services</a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="08_services-details.html">Road Transportation</a>
					</div>
				</div>
			</div>

			<iframe class="we-onmap wow fadeInUp" data-wow-delay="0.3s" src="https://www.google.com/maps/d/embed?mid=z2qirMhgTWQA.kXIVQWqn-ONc"></iframe>

			<div class="container-fluid block-content">
				<div class="row main-grid">
					<div class="col-sm-4">
						<h4>Head Office</h4>
						<p>Everyday is a new day for us and we work really hard to
							satisfy our customers everywhere.</p>
						<div class="adress-details wow fadeInLeft" data-wow-delay="0.3s">
							<div>
								<span><i class="fa fa-location-arrow"></i></span>
								<div><strong>TRANSCARGO LTD.</strong><br>3608 NewHill Station Ave CA,  Newyork 33102 </div>
							</div>
							<div>
								<span><i class="fa fa-phone"></i></span>
								<div>1.800.987.6543</div>
							</div>
							<div>
								<span><i class="fa fa-envelope"></i></span>
								<div>quote@domain.com</div>
							</div>
							<div>
								<span><i class="fa fa-clock-o"></i></span>
								<div>Mon - Sat  8.00 - 19.00</div>
							</div>
						</div>
						<br><br><hr><br>
						<h4>Branch Office</h4>
						<div class="adress-details wow fadeInLeft" data-wow-delay="0.3s">
							<div>
								<span><i class="fa fa-location-arrow"></i></span>
								<div><strong>TRANSCARGO LTD.</strong><br>3608 NewHill Station Ave CA,  Newyork 33102 </div>
							</div>
							<div>
								<span><i class="fa fa-phone"></i></span>
								<div>1.800.987.6543</div>
							</div>
							<div>
								<span><i class="fa fa-envelope"></i></span>
								<div>quote@domain.com</div>
							</div>
							<div>
								<span><i class="fa fa-clock-o"></i></span>
								<div>Mon - Sat  8.00 - 19.00</div>
							</div>
						</div>
					</div>
					<div class="col-sm-8 wow fadeInRight" data-wow-delay="0.3s">
						<h4>SEND us a message</h4>
						<p>Integer congue elit noin semper laoreet sed lectus orcil posuer nisal tempor se felis acm Pelentesque inyd urna. Integer vitae felis magna po estibulm Nam rutrumc diam. Aliquam malesuada maurs.</p>
						<div id="success"></div>
						<form novalidate id="contactForm" class="reply-form form-inline">
							<div class="row form-elem">	
								<div class="col-sm-6 form-elem">
									<div class="default-inp form-elem">
										<i class="fa fa-user"></i>
										<input type="text" name="user-name" id="user-name" placeholder="Full Name" required="required">
									</div>
									<div class="default-inp form-elem">
										<i class="fa fa-envelope"></i>
										<input type="text" name="user-email" id="user-email" placeholder="Email Address" required="required">
									</div>
								</div>
								<div class="col-sm-6 form-elem">
									<div class="default-inp form-elem">
										<i class="fa fa-user"></i>
										<input type="text" name="user-lastname" id="user-lastname" placeholder="Last Name">
									</div>
									<div class="default-inp form-elem">
										<i class="fa fa-phone"></i>
										<input type="text" name="user-phone" id="user-phone" placeholder="Phone No.">
									</div>
								</div>
							</div>
							<div class="default-inp form-elem">
								<input type="text" name="user-subject" id="user-subject" placeholder="Subject">
							</div>
							<div class="form-elem default-inp">
								<textarea id="user-message" placeholder="Message"></textarea>
							</div>
							<div class="form-elem">
								<button type="submit" class="btn btn-success btn-default">send message</button>
							</div>
						</form>
					</div>
				</div>
			</div>
@endsection
