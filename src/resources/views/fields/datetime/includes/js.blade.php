@section('enqueued-js')
    <script>
        $('#{{ $attribute }}').daterangepicker(
            {
                timePicker: true, 
                timePickerIncrement: {{ isset($options['increment']) ? $options['increment'] : '30' }},
                singleDatePicker: {{ isset($options['range']) && $options['range'] == true ? 'false' : 'true' }},
                format: {!! isset($options['format']) ? $options['format'] : "'YYYY/MM/DD HH:mm:ss'" !!},
                timePicker12Hour: {{ isset($options['timePicker24Hour']) ? 'false' : 'true' }},
            }
        );
    </script>
@append