@foreach($routes as $route => $value)
    {!!  sprintf('%20s', "'".$route."'")  !!} => ['action' => '{{ $value['action'] }}', 'permission'=>[] ],
@endforeach

];