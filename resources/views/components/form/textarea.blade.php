@props(['name'])

<x-form.label name="{{ $name }}" class="form-label" />
    <textarea name="{{ $name }}" id="{{ $name }}" cols="30" rows="5" class="form-control">{{ $slot }}</textarea>
<x-form.error name="{{ $name }}" />
