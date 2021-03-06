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

            <div class="col-sm-12">            
                @if(isset($options['options']) && count($options['options']) > 0)
                    @foreach ($options['options'] as $optionValue => $option)
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <p>
                                <input type="checkbox"
                                        value="{{ ($optionValue === 0 && count($options['options']) === 1) ? 1 : $optionValue }}"
                                        name="{{ $attribute }}{{ (count($options['options']) > 1 ? '[]' : '') }}"
                                        @if (
                                                (is_scalar($value) && $value == $optionValue)
                                            ||
                                                (is_array($value) && array_key_exists($optionValue, $value))
                                            ||
                                                (is_array($oldValue) && in_array($value, $oldValue))
                                            ||
                                                ($value instanceof \Illuminate\Database\Eloquent\Model && $optionValue == $value->getKey())
                                            ||
                                                ($value instanceof \Illuminate\Database\Eloquent\Collection && $value->find($optionValue))
                                            ) 
                                            checked="checked" @endif
                                        >
                                {{ $option }}
                            </p>
                        </div>
                    @endforeach

                    @if(isset($options['help']))
                        <div class="col-sm-12">
                            <p class="help-block">{!! $options['help'] !!}</p>
                        </div>
                    @endif
                @else 
                    <div class="callout callout-warning">
                        No options available for {{ $attributeTitle }}!
                    </div>
                @endif
            </div>
            
            @if ($errors->has($attribute))
                <p class="help-block">
                    <strong>{{ $errors->first($attribute) }}</strong>
                </p>
            @endif
        </div>
    </div>
</div>
