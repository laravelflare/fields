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
            @elseif (is_array($value))
                @foreach ($value as $key => $value)
                    @if (!is_scalar($value) && array_key_exists($value->{$value->getKeyName()}, $options['options'])) 
                        {{ $options['options'][$value->{$value->getKeyName()}] }} <br>
                    @else
                        @if (array_key_exists($value, $options['options']))
                            {{ $options['options'][$value] }} <br>
                        @else
                            {{ $value }} <br>
                        @endif
                    @endif
                @endforeach
            @elseif ($value instanceof \Illuminate\Database\Eloquent\Model && $optionValue = $value->getKey())
                {{ $options['options'][$optionValue] }}
            @endif
        @endif
    </dd>
</dl>
