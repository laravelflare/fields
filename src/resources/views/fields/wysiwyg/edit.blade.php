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
                @if(isset($options['tooltip']))
                    <span title="" data-placement="right" data-toggle="tooltip" class="badge bg-black" data-original-title="{{ $options['tooltip'] }}">?</span>
                @endif
            </label>
            <textarea id="{{ $attribute }}"
                        class="form-control {{ $options['class'] or null }}"
                        name="{{ $attribute }}"
                        @if (isset($options['required'])) required="required" @endif>{{ $oldValue }}</textarea>
            
            @if(isset($options['help']))
                <p class="help-block">{!! $options['help'] !!}</p>
            @endif
            
            @if ($errors->has($attribute))
                <p class="help-block">
                    {{ $errors->first($attribute) }}
                </p>
            @endif
        </div>
    </div>
</div>

@section('enqueued-js')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <style>
        .note-group-select-from-files {
            display: none;
        }
    </style>

    <script>
        $(function () {
            $("#{{ $attribute }}").summernote();
        });
    </script>
@append 
