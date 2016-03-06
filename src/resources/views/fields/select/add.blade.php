<div class="row">
    <div class="col-sm-6">
        <div class="form-group @if ($errors->has($attribute)) has-error @endif">
            <label class="control-label" for="{{ $attribute }}">
                {{ $attributeTitle }}
                @if (isset($options['required'])) 
                    <span title="" data-placement="right" data-toggle="tooltip" data-original-title="This field is required">*</span>
                @endif
                @if(isset($options['tooltip']))
                    <span title="" data-placement="right" data-toggle="tooltip" class="badge bg-black" data-original-title="{{ $options['tooltip'] }}">?</span>
                @endif
            </label>
            
            @if(isset($options['options']) && count($options['options']) > 0)
                <select class="form-control"
                        name="{{ $attribute }}{{ isset($options['multiple']) ? '[]' : '' }}"
                        id="{{ $attribute }}"
                        @if (isset($options['multiple'])) multiple="multiple" @endif
                        @if (isset($options['required'])) required="required" @endif>
                    <option></option>
                    @foreach ($options['options'] as $value => $option)
                        <option value="{{ $value }}">{{ $option }}</option>
                    @endforeach
                </select>

                @if(isset($options['help']))
                    <p class="help-block">{!! $options['help'] !!}</p>
                @endif
            @else
                <div class="callout callout-warning">
                    <strong>
                        No options available for {{ $attributeTitle }}!
                    </strong>
                </div>
            @endif
            
            @if ($errors->has($attribute))
                <p class="help-block">
                    <strong>{{ $errors->first($attribute) }}</strong>
                </p>
            @endif
        </div>
    </div>
</div>
