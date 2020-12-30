@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Report') }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('print',$token) }}" method="POST" id="report" class="mb-2"> 
                        @csrf 
                        <div class="row justify-content-center mb-2">
                            <div class="col-md-12">                    
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
                                <div>
                                    <button type="submit" class="btn btn-dark my-2 px-4"
                                            onclick="document.getElementById('report').submit()">
                                        {{ __('Print') }}
                                    </button>
                                </div>  
                            </div> 
                        </div>                      
                        <x-alert />
                        <table class="table shadow-sm mt-4">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection