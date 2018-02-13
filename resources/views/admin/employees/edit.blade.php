@extends('layouts.admin')

@section('title', 'Kandidat - ispravak')

@section('content')
</br>
</br>
</br>
<div class="row">
  <h1>Ispravi podatke kandidata</h1>
  <h2 align="center">{{ $employee->first_name . ' '. $employee->last_name }}</h2>

</div> 
<div class="container">

	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-body">
				 <form accept-charset="UTF-8" role="form" method="post" action="{{ route('admin.employees.update', $employee->id) }}">
					<div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
						<label>Ime:</label>
						<input name="first_name" type="text" class="form-control" value="{{ $employee->first_name }}">
						{!! ($errors->has('first_name') ? $errors->first('first_name', '<p class="text-danger">:message</p>') : '') !!}
					</div>
					<div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
						<label>Prezime:</label>
						<input name="last_name" type="text" class="form-control" value="{{ $employee->last_name }}" }}">
					</div>
					{!! ($errors->has('last_name') ? $errors->first('last_name', '<p class="text-danger">:message</p>') : '') !!}
					<div class="form-group {{ ($errors->has('oib')) ? 'has-error' : '' }}">
						<label>OIB</label>
						<input name="oib" type="text" class="form-control" value="{{ $employee->oib }}">
					</div>
					{!! ($errors->has('oib') ? $errors->first('oib', '<p class="text-danger">:message</p>') : '') !!}
					<div class="form-group">
						<label>Datum rođenja</label>
						<input name="datum_rodjenja" class="date form-control" type="text" value ="{{ date('d-m-Y', strtotime($employee->datum_rodjenja)) }}">
						{!! ($errors->has('datum_rodjenja') ? $errors->first('datum_rodjenja', '<p class="text-danger">:message</p>') : '') !!}
					</div>
					<script type="text/javascript">
								$('.date').datepicker({  
								   format: 'dd-mm-yyyy'
								 });  
					</script> 
					<div class="form-group">
						<label>	Mobitel</label>
						<input name="mobitel" type="text" class="form-control" value="{{ $employee->mobitel }}">
					</div>
					<div class="form-group">
						<label>E-mail</label>
						<input name="email" type="text" class="form-control" value="{{ $employee->email }}">
					</div>
					<div class="form-group {{ ($errors->has('prebivaliste_adresa')) ? 'has-error' : '' }}">
						<label>Prebivalište - adresa:</label>
						<input name="prebivaliste_adresa" type="text" class="form-control" value="{{ $employee->prebivaliste_adresa }}">
					</div>
					{!! ($errors->has('prebivaliste_adresa') ? $errors->first('prebivaliste_adresa', '<p class="text-danger">:message</p>') : '') !!}
					<div class="form-group {{ ($errors->has('prebivaliste_grad')) ? 'has-error' : '' }}">
						<label>Prebivalište - grad:</label>
						<input name="prebivaliste_grad" type="text" class="form-control" value="{{ $employee->prebivaliste_grad }}">
					</div>
					{!! ($errors->has('prebivaliste_grad') ? $errors->first('prebivaliste_grad', '<p class="text-danger">:message</p>') : '') !!}
					<?php 
						$i = 0;
					?>	
					<label role="button" data-toggle="collapse" href="#collapseExample{{$i}}" aria-expanded="false" aria-controls="collapseExample{{$i}}">Boravište nije isto kao prebivalište<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></label>
					
					<div class="collapse" id="collapseExample{{$i}}">	
						<div class="form-group">
							<label>Boravište - adresa:</label>
							<input name="boraviste_adresa" type="text" class="form-control" value="{{ $employee->boraviste_adresa }}">
						</div>	
						<div class="form-group">
							<label>Boravište - grad:</label>
							<input name="boraviste_grad" type="text" class="form-control" value="{{ $employee->boraviste_grad }}">
						</div>				
					</div>

					<div class="form-group {{ ($errors->has('zvanje')) ? 'has-error' : '' }}">
						<label>Zvanje:</label>
						<input name="zvanje" type="text" class="form-control" value="{{ $employee->zvanje }}">
					</div>
					{!! ($errors->has('zvanje') ? $errors->first('zvanje', '<p class="text-danger">:message</p>') : '') !!}
					<div class="form-group">
						<label>Bračno stanje:</label>
						<select class="form-control" name="bracno_stanje" value="{{ $employee->bracno_stanje }}">
							<option>U braku</option>
							<option>nije u braku</option>
						</select>
					</div>
					<div class="form-group {{ ($errors->has('radnoMjesto_id'))  ? 'has-error' : '' }}">
                        <label>Radno mjesto:</label>
						<select class="form-control" name="radnoMjesto_id" id="sel1" value="{{ old('radnoMjesto_id') }}">
							@foreach (DB::table('works')->orderBy('naziv','ASC')->get() as $work)
								<option name="radnoMjesto_id" value="{{ $work->id }}">{{ $work->naziv }}</option>
							@endforeach	
							<option selected="selected" name="radnoMjesto_id" value="{{ $employee->radnoMjesto_id}}">{{ $employee->work['naziv'] }}</option>
						</select>
						{!! ($errors->has('radnoMjesto_id') ? $errors->first('radnoMjesto_id', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group">
						<label>Datum liječničkog pregleda: </label>
						@if($employee->lijecn_pregled)
						<input name="lijecn_pregled" class="date form-control" type="text" value="{{ date('d-m-Y', strtotime($employee->lijecn_pregled)) }}">
						@else
							<input name="lijecn_pregled" class="date form-control" type="text">
						@endif
					</div>
					<div class="form-group">
						<label>Datum obuke zaštite na radu: </label>
						@if($employee->ZNR)
							<input name="ZNR" class="date form-control" type="text" value ="{{ date('d-m-Y', strtotime($employee->ZNR)) }}">
						@else
							<input name="ZNR" class="date form-control" type="text" >
						@endif
					</div>
					<script type="text/javascript">
								$('.date').datepicker({  
								   format: 'dd-mm-yyyy'
								 });  
					</script> 
					<div class="form-group">
						<label>Napomena: </label>
						<textarea class="form-control" rows="4" name="napomena">{{ $employee->napomena }}</textarea>
					</div>
					
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Ispravi podatke" id="stil1">
				</form>

			</div>
		</div>
	</div>
</div>

@stop