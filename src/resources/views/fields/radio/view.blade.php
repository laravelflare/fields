<dl class="dl-horizontal">
    <dt>
        {{ $attributeTitle }}
    </dt>
    <dd>
        @if (is_scalar($value) || is_null($value))
            {{ $value }}
        @else 
            @foreach ($value as $key => $value)
                {{ $value }} <br>
            @endforeach
        @endif
    </dd>
</dl>
