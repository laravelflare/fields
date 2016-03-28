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
                    @foreach ($options['options'] as $value => $option)
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <p>
                                <input type="radio"
                                        value="{{ $value }}"
                                        name="{{ $attribute }}"
                                        @if (isset($options['required'])) required="required" @endif
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
                        <strong>
                            No options available for {{ $attributeTitle }}!
                        </strong>
                    </div>
                @endif
            </div>
            
            @if ($errors->has($attribute))
                <p class="help-block">
                    {{ $errors->first($attribute) }}
                </p>
            @endif
        </div>
    </div>
</div>
