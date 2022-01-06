@component('mail::message')
# Your order has been fullfilled! 

Thank you for your purchase with us! Track your order at the order detail page now!


@component('mail::button', ['url' => 'http://localhost:8000/order'])
Track your order
@endcomponent

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
