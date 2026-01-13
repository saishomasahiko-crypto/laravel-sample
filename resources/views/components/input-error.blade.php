@props(['message'])
@if(!empty($message))
    <ul class="text-sm text-red-600 space-y-1">
        @foreach($message as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif