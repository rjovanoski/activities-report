@component('mail::message')
# Activity Report

Click on the button to see the report

@component('mail::button', ['url' => 'http://localhost:8000/home/report/'.$token])
Report
@endcomponent


If you're having trouble clicking the "Report" button, copy and paste the URL below into your browser: 
<a href="http://localhost:8000/home/report/{{ $token }}">http://localhost:8000/home/report/{{ $token }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
