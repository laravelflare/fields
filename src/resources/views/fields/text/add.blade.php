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
            <input id="{{ $attribute }}"
                    class="form-control {{ $options['class'] or null }}"
                    type="{{ $field or 'text' }}"
                    name="{{ $attribute }}"
                    @if (isset($options['maxlength'])) maxlength="{{ $options['maxlength'] }}" @endif
                    @if (isset($options['disabled'])) disabled="disabled" @endif
                    @if (isset($options['readonly'])) readonly="readonly" @endif
                    @if (isset($options['autocomplete'])) autocomplete="{{ $options['autocomplete'] ? 'on' : 'off' }}" @endif
                    @if (isset($options['autofocus'])) autofocus="autofocus" @endif
                    @if (isset($options['pattern'])) pattern="{{ $options['pattern'] }}" @endif
                    @if (isset($options['data-inputmask'])) data-mask="" @endif
                    @if (isset($options['data-inputmask'])) data-inputmask="{!! $options['data-inputmask'] !!}" @endif
                    @if (isset($options['required'])) required="required" @endif
                    @if (isset($options['placeholder'])) placeholder="{{ $options['placeholder'] }}" @endif
                    value="{{ $oldValue }}">
                    
            @if(isset($options['help']))
                <p class="help-block">{!! $options['help'] !!}</p>
            @endif

            @if ($errors->has($attribute))
                <p class="help-block">
                    {{ $errors->first($attribute) }}
                </p>
            @endif        
        </div>
        
        @if(isset($options['confirmed']) && $options['confirmed'])
            <div class="form-group @if ($errors->has($attribute)) has-error @endif">
                <label class="control-label" for="{{ $attribute }}_confirmation">
                    Confirm {{ $attributeTitle }}
                    @if (isset($options['required'])) 
                        <span title="" data-placement="right" data-toggle="tooltip" data-original-title="This field is required">*</span>
                    @endif
                    @if(isset($options['tooltip']))
                        <span title="" data-placement="right" data-toggle="tooltip" class="badge bg-black" data-original-title="{{ $options['tooltip'] }}">?</span>
                    @endif
                </label>
                <input id="{{ $attribute }}_confirmation"
                        class="form-control {{ $options['class'] or null }}"
                        type="{{ $field or 'text' }}"
                        name="{{ $attribute }}_confirmation"
                        @if (isset($options['maxlength'])) maxlength="{{ $options['maxlength'] }}" @endif
                        @if (isset($options['disabled'])) disabled="disabled" @endif
                        @if (isset($options['readonly'])) readonly="readonly" @endif
                        @if (isset($options['autocomplete'])) autocomplete="{{ ($options['autocomplete'] ? 'on' : 'off') }}" @endif
                        @if (isset($options['autofocus'])) autofocus="autofocus" @endif
                        @if (isset($options['pattern'])) pattern="{{ $options['pattern'] }}" @endif
                        @if (isset($options['data-inputmask'])) data-mask="" @endif
                        @if (isset($options['data-inputmask'])) data-inputmask="{!! $options['data-inputmask'] !!}" @endif
                        @if (isset($options['required'])) required="required" @endif
                        @if (isset($options['placeholder'])) placeholder="{{ $options['placeholder'] }}" @endif
                        value="">
                        
                @if(isset($options['help']))
                    <p class="help-block">{!! $options['help'] !!}</p>
                @endif

                @if ($errors->has($attribute))
                    <p class="help-block">
                        {{ $errors->first($attribute) }}
                    </p>
                @endif
            </div>
        @endif
    </div>
</div>

@if(isset($options['data-inputmask']))
    @section('enqueued-js')
        <script src="{{ asset('vendor/flare/plugins/input-mask/jquery.inputmask.js') }}"></script>
        <script src="{{ asset('vendor/flare/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
        <script src="{{ asset('vendor/flare/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script> 

        <script>
            $(function () {
                $("[data-inputmask]").inputmask();
            });
        </script>
    @append
@endif