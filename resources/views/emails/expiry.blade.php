
@component('mail::message')
<h2>Hello {{$array['seller']}},</h2>
<p>Your Products are going to expire soon. Please Check Your Products.
</p>

@foreach ($array['details'] as $item)
<li>
{{$item->name}} expires in {{$item->expiry_date}}
</li>	
	
@endforeach
 <br>
Thanks,<br>
{{ config('app.name') }}<br>

@endcomponent