@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading"> Edit Ujian </div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="#">
							{{csrf_field()}}
							
							<div class="form-group{{ $errors->has('mapel') ? ' has-error' : '' }}">
                            	<label for="mapel" class="col-md-4 control-label">Mata Pelajaran</label>

								<div class="col-md-6">
									<select name="mapel" id="mapel" class="form-control">
										@foreach($mapel as $m)
											<option @if(old('mapel') == $m->nama_mapel) {{ 'selected' }} @endif>{{ $m->nama_mapel }} </option>
										@endforeach
									</select>
									
									@if ($errors->has('mapel'))
										<span class="help-block">
											<strong>{{ $errors->first('mapel') }}</strong>
										</span>
									@endif
								</div>
							</div>	
							
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection