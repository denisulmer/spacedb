<div class="{{ implode(' ', $element->classes) }}">
    <span>{{ trans($element->text) }}</span>
    <input type="file" name="{{ $element->name }}" accept="image/">
</div>
<div class="file-path-wrapper">
    <input class="file-path" type="text">
</div>