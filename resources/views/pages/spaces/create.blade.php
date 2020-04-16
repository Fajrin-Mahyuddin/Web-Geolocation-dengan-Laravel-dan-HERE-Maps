@extends('layouts.app')

@section('content')
<div class="container">
    @include('components.navigation')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'space.store', 'method' => 'post', 'files' => true]) !!}
                      <div class="form-group">
                        <label for="">Title</label>
                        {!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid': 'form-control']) !!}
                        @error('title')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                          </span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="">Address</label>
                        {!! Form::textarea('address', null, ['class' => $errors->has('address') ? 'form-control is-invalid': 'form-control', 'cols' => '10', 'rows' => '3']) !!}
                        @error('address')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                          </span>
                        @enderror
                      </div>

                      <div id="here-maps">
                        <label for="">Pin Location</label>
                        <div style="height:500px" id="mapContainer"></div>
                      </div>

                      <div class="form-group">
                        <label for="">Latitude</label>
                        {!! Form::text('lat', null, ['class' => $errors->has('lat') ? 'form-control is-invalid': 'form-control', 'id' => 'lat']) !!}
                        @error('lat')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                          </span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="">Longitude</label>
                        {!! Form::text('lng', null, ['class' => $errors->has('lng') ? 'form-control is-invalid': 'form-control', 'id' => 'lng']) !!}
                        @error('lng')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                          </span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="">Description</label>
                        {!! Form::textarea('desc', null, ['class' => $errors->has('desc') ? 'form-control is-invalid': 'form-control', 'cols' => '10', 'rows' => '3']) !!}
                        @error('desc')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                          </span>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
  <script>
    window.action = 'submit';
  </script>
@endpush