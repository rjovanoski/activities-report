@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('New Activity') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>
                        <div class="form-group">
                            <label for="date">{{ __('Date') }}</label>
                            <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                            
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>
                        <div class="form-group">
                            <label for="time">{{ __('Time in minutes') }}</label>
                            <input type="number" min="1" id="time" name="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time') }}">
                            
                            @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Short description: ') }}<small class="text-primary">{{ __('minimum 20 letters') }}</small></label>
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                            
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>
                        <button type="submit" class="btn btn-dark text-white">{{ __('Submit') }}</button>
                        <a href="{{ route('home') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
