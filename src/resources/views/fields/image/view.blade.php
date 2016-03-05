<dl class="dl-horizontal">
    <dt>
        {{ $attributeTitle }}
    </dt>
    <dd>
        @if (strpos($value, 'http://') === 0 || strpos($value, 'https://') === 0)
            <a href="{{ $value  }}">
                <img src="{{ $value }}" class="img-responsive">
            </a>
        @else
            {{ $value }}
        @endif
    </dd>
</dl>
