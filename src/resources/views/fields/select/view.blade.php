<dl class="dl-horizontal">
    <dt>
        {{ $attributeTitle }}
    </dt>
    <dd>
        @if ($value)
            @if (is_scalar($value))
                @if (array_key_exists($value, $options['options']))
                    {{ $options['options'][$value] }}
                @else
                    {{ $value }}
                @endif
            @else 
                @foreach ($value as $key => $value)
                    @if (array_key_exists($value, $options['options']))
                        {{ $options['options'][$value] }} <br>
                    @else
                        {{ $value }} <br>
                    @endif
                @endforeach
            @endif
        @endif
    </dd>
</dl>
