@extends('layouts.admin')

@section('title', 'Radno mjesto')

@section('content')

<div class="page-header">
  <h2>Ispravak radnog mjesta</h2>
</div> 
<div class="">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-body">
				 <form accept-charset="UTF-8" role="form" method="post" action="{{ route('admin.works.update', $work1->id) }}">
					<div class="form-group {{ ($errors->has('employee_id'))  ? 'has-error' : '' }}">
                        <label>Odjel</label>
						<select class="form-control" name="odjel" id="sel1" value="{{ $work->odjel }}">
							<option selected="selected" name="pravilnik" value="{{ $work->odjel}}">{{ $work->odjel}}</option>
							<option name="odjel">{{ 'Zajednički poslovi' }}</option>
							<option name="odjel">{{ 'Odjel informatičkih tehnologija' }}</option>
							<option name="odjel">{{ 'Inženjering'  }}</option>
						</select>
						{!! ($errors->has('employee_id') ? $errors->first('employee_id', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('ime')) ? 'has-error' : '' }}">
						<label>Naziv radnog mjesta:</label>
						<input name="naziv" type="text" class="form-control" value="{{ $work->naziv }}">
						{!! ($errors->has('naziv') ? $errors->first('naziv', '<p class="text-danger">:message</p>') : '') !!}
					</div>
					<div class="form-group">
						<label>Pravilnik:</label>
						<select class="form-control" name="pravilnik" id="sel1" value="{{ old('pravilnik') }}">
							<option selected="selected" name="pravilnik" value="{{ $work->pravilnik}}">{{ $work->pravilnik}}</option>
							<option name="pravilnik">{{ 'Pravilnik o poslovima s posebnim uvjetima rada, čl. 3.' }}</option>
							<option name="pravilnik">{{ 'Pravilnik o sigurnosti i zaštiti zdravlja pri radu sa računalom' }}</option>
						</select>
					</div>
					<div class="form-group">
						<label>Prema točkama:</label>
						<input name="tocke" type="text" class="form-control" value="{{ $work->tocke }}">
					</div>
					<div class="form-group {{ ($errors->has('user_id'))  ? 'has-error' : '' }}">
					    <label>Nadređen djelatnik</label>
						<select class="form-control" name="user_id" id="sel1" value="{{ old('user_id') }}"required>
							<option selected="selected" name="user_id" value="{{ $work->user_id }}">{{  $work->nadredjeni['last_name'] . ' ' . $work->nadredjeni['first_name'] }}</option>
						@foreach($users as $user)
							<option name="user_id" value="{{ $user->employee_id }}">{{ $user->last_name . ' ' . $user->first_name }} </option>
						@endforeach
						</select>
						{!! ($errors->has('user_id') ? $errors->first('user_id', '<p class="text-danger">:message</p>') : '') !!}
					</div>
					<div class="form-group">
					    <label>Prvi nadređen djelatnik</label>
						<select class="form-control" name="prvi_userId" id="sel1" value="{{ old('prvi_userId') }}">
							<option selected="selected" name="prvi_userId" value="{{ $work->prvi_userId }}">{{  $work->prvi_nadredjeni['last_name'] . ' ' . $work->prvi_nadredjeni['first_name'] }}</option>
						@foreach($users as $user)
							<option name="prvi_userId" value="{{ $user->employee_id }}">{{ $user->last_name . ' ' . $user->first_name }} </option>
						@endforeach
						</select>
					</div>
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Ispravi radno mjesto" id="stil1">
				</form>
			</div>
		</div>
	</div>
</div>

@stop