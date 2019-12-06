<!DOCTYPE html>
<html lang="en">
    <head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Visitor</title>
		<!-- Bootstrap - Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<link rel="stylesheet" href="{{ URL::asset('css/admin.css') }}" type="text/css" >
		<link rel="stylesheet" href="{{ URL::asset('css/dashboard.css') }}"/>

		<script src="{{ URL::asset('node_modules/jquery/dist/jquery.min.js') }}"></script>
@php	
	$card_id = substr($_SERVER['REQUEST_URI'],10);
@endphp
	</head>
	<body>
		<header>
			<h1><img src="{{ asset('img/Logo_Duplico.png') }}" /><span>portal za zaposlenike</span></h1>
			<ul class="">
				@if(Sentinel::check())
					<li><a href="{{ route('auth.logout') }}">Odjava</a></li>
				@else
				<!--	<li><a href="{{ route('auth.login.form') }}">Login</a></li>-->
				@endif
			</ul>
		</header>
		<section class="language">
			<div class="lang_choose">
				<img class="img_flag flag_hr" src="{{ asset('img/flag/hr-flag.png') }}" /><img class="img_flag flag_de" src="{{ asset('img/flag/de-flag.png') }}" /><img class="img_flag flag_en" src="{{ asset('img/flag/en-flag.png') }}" />
			</div>			
		</section>
		<main class="visitors">
			@include('notifications')
			<section class="hr col-md-12 col-lg-9 col-xl-6" >			
				<h1>Upute za sigurnost posjetitelja</h1>
				<form accept-charset="UTF-8" role="form" class="visitor_form" method="post" action="{{ route('admin.visitors.store') }}">
				
						<div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }} ">
							<input class="form-control" placeholder="Ime" name="first_name" type="text" maxlength="20" value="{{ old('first_name') }}" autofocus/>
							{!! ($errors->has('first_name') ? $errors->first('first_name', '<p class="text-danger">:message</p>') : '') !!}
						</div>
						<div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
							<input class="form-control" placeholder="Prezime" name="last_name" type="text" maxlength="20" value="{{ old('last_name') }}" />
							{!! ($errors->has('last_name') ? $errors->first('last_name', '<p class="text-danger">:message</p>') : '') !!}
						</div>
						<div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
							<input class="form-control" placeholder="E-mail" name="email" type="text" maxlength="50" value="{{ old('email') }}">
							{!! ($errors->has('email') ? $errors->first('email', '<p class="text-danger">:message</p>') : '') !!}
						</div>
						<div class="form-group {{ ($errors->has('company')) ? 'has-error' : '' }}">
							<input class="form-control" placeholder="Tvrtka" name="company" type="text" maxlength="50" value="{{ old('company') }}">
							{!! ($errors->has('company') ? $errors->first('company', '<p class="text-danger">:message</p>') : '') !!}
						</div>
						<input class="form-control" name="lang" type="hidden" value="hr">					
					<div class="form-group smjernice">
						@include('admin.visitors.smjernice')
						
						<div class="{{ ($errors->has('accept')) ? 'has-error' : '' }} ">
							<label>
								<input name="accept" type="checkbox" value="1" {{ old('accept') == 'checked' ? 'checked' : ''}}  > <b>Potvrđujem da sam upoznat sa uvjetima i smjernicama zaštite na radu tvrtke Duplico.</b>
							</label>
							{!! ($errors->has('accept') ? $errors->first('accept', '<p class="text-danger">:message</p>') : '') !!}
						</div>
						<div class="{{ ($errors->has('confirm')) ? 'has-error' : '' }} ">
							<label>
								<input name="confirm" type="checkbox" value="1" {{ old('confirm') == 'true' ? 'checked' : ''}} > <b>Potvrđujem da sam preuzeo/la i da sam upoznat s načinom korištenja ključa za ulazak u prostorije tvrtke </b>
							</label>
							{!! ($errors->has('confirm') ? $errors->first('confirm', '<p class="text-danger">:message</p>') : '') !!}
						</div>
					</div>
					
						<input class="form-control" name="card_id" type="hidden" maxlength="20" value="{{ $card_id }}">
						{{ csrf_field() }}
						<input class="btn-submit btn_submit_reg" type="submit" value="Potvrda"> 
					
				</form>
				<p>* Vaše osobne podatke obrađujemo sukladno članku 6. Opće uredbe o zaštiti podataka (GDPR), a u svrhu poštivanja pravnih obveza Duplico d.o.o. i zaštite Vaših ključnih interesa.</p>
				@if(! isset($_COOKIE['cookie_confirme'])  )
					<footer class="cookie">
						<span>Kolačiće koristimo kako bismo Vam pružili najbolje iskustvo na našoj web stranici. Ako nastavite koristiti ovu stranicu pretpostaviti ćemo da ste zadovoljni njome. </span>
						<button class="close_cookie">OK</button>
						<a class="cookie_info" href="http://www.duplico.hr/pravila-o-zastiti-i-privatnosti/" >Pročitaj više</a>
					</footer>
				@endif
			</section>
		</main>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<!-- Restfulizer.js - A tool for simulating put,patch and delete requests -->
		<script src="{{ asset('js/restfulizer.js') }}"></script>

		<script>
			$('.img_flag.flag_de').click(function(){
				url = window.location.origin + '/de' + window.location.pathname;
				window.location = url;
			});
			$('.img_flag.flag_en').click(function(){
				url = window.location.origin + '/en' + window.location.pathname;
				window.location = url;
			});
			$('.img_flag.flag_hr').click(function(){
			
			});
			$('.close_cookie').click(function(){
				$('.cookie').remove();
				document.cookie = 'cookie_confirme=Duplico_'+Math.random().toString(36).substring(7);				
			});

		</script>
	</body>
</html>