<textarea placeholder="{{ $element->placeholder }}" name="{{ $element->name }}" class="{{ implode(' ', $element->classes) }} {{ $errors->has($element->name) ? ' invalid' : '' }}">{{ old($element->name) }}</textarea>