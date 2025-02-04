@props([
    'action',
    'method' => 'POST'
])
<form action="{{$action}}" method="{{$method ==='GET' ? 'GET' : 'POST'}}" {{$attributes}}>
    @csrf
    {{-- for put and delete  --}}
    @unless (in_array($method,['GET','POST']))
     @method($method)
    @endunless
    {{$slot}}
</form>
