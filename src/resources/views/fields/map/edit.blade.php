<div class="row">
    <div class="col-sm-6">
        <div class="form-group @if ($errors->has($attribute)) has-error @endif">
            <label class="control-label" for="{{ $attribute }}">
                @if ($errors->has($attribute))
                    <i class="fa fa-times-circle-o"></i>
                @endif
                {{ $attributeTitle }}
                @if (isset($options['required'])) 
                    <span title="" data-placement="right" data-toggle="tooltip" data-original-title="This field is required">*</span>
                @endif
                <span title="" 
                    data-placement="right" 
                    data-toggle="tooltip"
                    class="badge bg-black" 
                    @if(isset($options['tooltip'])) 
                    data-original-title="{{ $options['tooltip'] }}"
                    @else
                    data-original-title="Drag map pin to location"
                    @endif
                    >?</span>
            </label>
            <input type="text" id="{{ $attribute }}-address" class="form-control {{ $options['class'] ?? null }}" placeholder="Address..." autocomplete="off">
            <div id="{{ $attribute }}-map" style="width: auto; height: 400px; margin-bottom: 10px; margin-top: 10px;"></div>
            <input type="hidden" name="{{ $attribute }}[latitude]" id="{{ $attribute }}-latitude" value="{{ $oldValue['latitude'] ?? null }}">
            <input type="hidden" name="{{ $attribute }}[longitude]" id="{{ $attribute }}-longitude" value="{{ $oldValue['longitude'] ?? null }}">
        </div>
    </div>
</div>

@section('enqueued-js')
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ $google_api_key }}&sensor=false&libraries=places'></script>
    <script src="{{ url('vendor/flare/js/locationpicker.jquery.js') }}"></script>

    <script>
        $('#{{ $attribute }}-map').locationpicker({
            oninitialized: function(){
            var cb = function (event) {
                $('#{{ $attribute }}-map').locationpicker('location', {
                    latitude: event.latLng.lat(),
                    longitude: event.latLng.lng()
                })
            };
            $('#{{ $attribute }}-map').locationpicker('subscribe', {
                event: 'click',
                callback: cb
            });
            },
            zoom: {{ $options['zoom'] ?? 14 }},
            location: {
                latitude: {{ $oldValue['latitude'] ?? ($options['latitude'] ?? '51.4816145') }},
                longitude: {{ $oldValue['longitude'] ?? ($options['longitude'] ?? '-0.1531235') }}
            },
            radius: {{ $options['radius'] ?? 0 }},
            inputBinding: {
                latitudeInput: $('#{{ $attribute }}-latitude'),
                longitudeInput: $('#{{ $attribute }}-longitude'),
                locationNameInput: $('#{{ $attribute }}-address'),
            },
            enableAutocomplete: true
        });
    </script>
@append