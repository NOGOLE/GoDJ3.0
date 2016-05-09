Thank you for your recent GoDJ purchase. Below is your order, please print for your records!
<br>
Name Of Event: {{$party->name}}
<br>
# of Tickets Bought: {{$request->amount}}
<br>
Event Address: {{$party->address}} {{$party->city}} {{$party->state}} {{$party->zip}}
<br>
Event Starts: {{$party->starts_at->toDayDateTimeString()}}
<br>
Event Ends: {{$party->ends_at->toDayDateTimeString()}}
<br>
Total Amount Spent: {{$party->price * $request->amount}} 
