Hello, {{ $guest }}!
<br>
Good news! Your Booking request was confirmed!
<br>
<br>
Owner:
<br>
Name: {{ $property->user->name }}
<br>
Surname: {{ $property->user->surname }}
<br>
Email: {{ $property->user->email }}
<br>
Phone: {{ $property->user->phone }}
<br>
<br>
Property:
<br>
Address: {{ $property->country }}, {{ $property->city }}, {{ $property->address }}, {{ $property->house }},
<br>
Details: <a href="{{route('property.show', ['property' => $property->id])}}"></a>

