<dl class="dl-horizontal">
    <dt>
        {{ $attributeTitle }}
    </dt>
    <dd>
        <div class="col-sm-6">
            <div id="{{ $attribute }}-map" style="width: auto; height: 400px; margin-bottom: 10px;"></div>
            <input type="hidden" name="{{ $attribute }}[latitude]" id="{{ $attribute }}-latitude" value="{{ $oldValue['latitude'] ?? null }}">
            <input type="hidden" name="{{ $attribute }}[longitude]" id="{{ $attribute }}-longitude" value="{{ $oldValue['longitude'] ?? null }}">
        </div>
    </dd>
</dl>

@section('enqueued-js')
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ $google_api_key }}&sensor=false&libraries=places'></script>
    <script src="{{ url('vendor/flare/js/locationpicker.jquery.js') }}"></script>

    <script>
        $('#{{ $attribute }}-map').locationpicker({
            zoom: {{ $options['zoom'] ?? 9 }},
            location: {
                latitude: {{ $oldValue['latitude'] ?? ($options['latitude'] ?? '51.4816145') }},
                longitude: {{ $oldValue['longitude'] ?? ($options['longitude'] ?? '-0.1531235') }}
            },
            radius: {{ $options['radius'] ?? 0 }},
            inputBinding: {
                latitudeInput: $('#{{ $attribute }}-latitude'),
                longitudeInput: $('#{{ $attribute }}-longitude'),
                // locationNameInput: $('#{{ $attribute }}-address'),
            },
            markerDraggable: false,
            draggable: false,
        });
    </script>
@endsection