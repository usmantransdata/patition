@component('mail::message')
# {{$data['subject']}}
## {{$data['title']}} {{$data['name']}}

{{$data['template']}}

## {{$data['name']}},


{{ URL::to('/confirmation/' . $data['verification_token']) }}.<br/>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
