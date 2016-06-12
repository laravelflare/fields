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
                    @if (isset($options['required'])) required="required" @endif
                    @if (isset($options['disabled'])) disabled="disabled" @endif
                    @if (isset($options['readonly'])) readonly="readonly" @endif
                    @if (isset($options['autofocus'])) autofocus="autofocus" @endif
                    @if (isset($options['maxlength'])) maxlength="{{ $options['maxlength'] }}" @endif
                    @if (isset($options['placeholder'])) placeholder="{{ $options['placeholder'] }}" @endif
                >{{ $oldValue }}</textarea>
            
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
