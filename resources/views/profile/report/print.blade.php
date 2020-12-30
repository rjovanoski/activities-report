<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        th{
            font-size: 13px;
        }
        td{
            font-size: 10px;
        }
        p{
            font-size: 11px;
        }
        small{
            font-size: 10px;
        }
    </style>

</head>
<body>

    <h5 class="text-uppercase">{{ __('Activity report') }}</h5>

    <table class="table table-sm table-striped mt-3">
        <thead class="bg-dark text-white text-sm">
        <tr>
        <th scope="col">{{ __('Created') }}</th>
        <th scope="col">{{ __('Name') }}</th>
        <th scope="col">{{ __('Date') }}</th>
        <th scope="col">{{ __('Time') }}</th>
        <th scope="col">{{ __('Description') }}</th>
        </tr>
        </thead>
        <tbody class="border-sm">
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
        <p>{{ __('Total time in minutes: ') }}<small class="text-secondary">{{ $activities->sum('time') }}</small></p>
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>