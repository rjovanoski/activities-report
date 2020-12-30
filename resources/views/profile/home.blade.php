@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Dashboard') }}</h4>
                </div>

                <div class="card-body">
                    @if($activities->count() > 0)
                    <h4>{{ __('Activities') }}</h4>
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
                    <div class="row justify-content-center mt-4">
                        {{ $activities->links() }}
                    </div>
                    @else
                        <h4>{{ __('No Activities') }}</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
