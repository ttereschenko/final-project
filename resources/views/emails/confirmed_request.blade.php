Hello, {{ $booking->user->name }}!
<br>
Good news! Your Booking request was confirmed!
<br>
<br>
Owner:
<br>
Name: {{ $booking->property->user->name }}
<br>
Surname: {{ $booking->property->user->surname }}
<br>
Email: {{ $booking->property->user->email }}
<br>
Phone: {{ $booking->property->user->phone }}
<br>
<br>
Address: {{ $booking->property->country->name }}, {{ $booking->property->city->name }}, {{ $booking->property->address }}
{{ $booking->property->house_number }}
<br>
<a href="{{route('property.show', ['property' => $booking->property->id])}}">Details</a>

