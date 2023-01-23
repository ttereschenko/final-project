Hey, {{ $name }}!
<br>
Somebody wants to book your apartments!
<br>
<a href="{{ route('booking.request', ['booking' => $booking->id]) }}">Click here</a> to obtain more information.
