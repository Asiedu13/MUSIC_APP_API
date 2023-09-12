@component('mail::message')
    
<x-mail::panel>
    Join our mailing list today Prince
</x-mail::panel>

<x-mail::button :url="$url" color='success'>
    View order
</x-mail::button>
{{$user}}
@endcomponent
