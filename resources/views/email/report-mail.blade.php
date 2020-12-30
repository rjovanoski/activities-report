@component('mail::message')
# Activity Report

Click on the button to see the report

@component('mail::button', ['url' => 'http://localhost:8000/home/report/'.$token])
Report
@endcomponent


If you can't enter through the button please copy this link
http://localhost:8000/home/report/{{ $token }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
