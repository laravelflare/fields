<dl class="dl-horizontal">
    <dt>
        {{ $attributeTitle }}
    </dt>
    <dd>
        @if (strpos($value, 'http://') === 0 || strpos($value, 'https://') === 0)
            <a href="{{ $value  }}">
                {{ $value }}
            </a>
        @else
            {{ $value }}
        @endif
    </dd>
</dl>
