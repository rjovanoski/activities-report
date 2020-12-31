@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Send Report') }}</h4>
                </div>
                <div class="card-body">
                
                    @if($activities->count() > 0)
                        <div class="col-md-12 mt-2">
                            <form action="{{ route('store-report') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <label for="date_from">{{ __('Date From') }}</label>
                                                <input type="date" class="form-control" name="date_from" id="date_from" value="{{ old('date_from') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <label for="date_to">{{ __('Date To') }}</label>
                                                <input type="date" class="form-control" name="date_to" id="date_to" value="{{ old('date_to') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                    </div>
                                </div>                       
                            </form>               
                        </div>
                            
                        <x-alert />
                        
                            <table class="table shadow-sm">
                                <thead class="thead-dark">
                                  <tr>
                                    <th scope="col">{{ __('Created') }}</th>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Date') }}</th>
                                    <th scope="col">{{ __('Time') }}</th>
                                    <th scope="col">{{ __('Description') }}</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities as $activity)
                                        <tr>      
                                            <td>{{ $activity->created_at }}</td>             
                                            <td>{{ $activity->name }}</td>
                                            <td>{{ $activity->date }}</td>
                                            <td>{{ $activity->time }}</td>
                                            <td>{{ $activity->description }}</td>
                                        </tr>  
                                    @endforeach                        
                                </tbody>                        
                            </table>
                                <p>{{ __('Total time in minutes: ') }}<small class="text-primary">{{ $activities->sum('time') }}</small></p>
                                    <div class="row justify-content-center mt-4">
                                        {{ $activities->links() }}
                                    </div>
                        @else
                            <h4>{{ __('No activities to make report') }}</h4>
                        @endif
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
