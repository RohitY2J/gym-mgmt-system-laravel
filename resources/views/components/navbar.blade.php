<navbar>
    @php
    $menuItems = [
    ['text' => 'Home', 'url' => url('/')],
    ['text' => 'Contact', 'url' => url('/contact')],
    ['text' => 'About', 'url' => '#about'],
    ['text' => 'Login', 'url' => '#'],
    ['text' => 'Booking History', 'url' => '/booking']
    ];
    @endphp

    <ul>
        @foreach ($menuItems as $item)
        <li><a href="{{ $item['url'] }}">{{ $item['text'] }}</a></li>
        @endforeach
    </ul>

</navbar>