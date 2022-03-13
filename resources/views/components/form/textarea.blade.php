@props(['name'])

<x-form.label name="{{ $name }}" />
    <textarea name="{{ $name }}" id="{{ $name }}" cols="30" rows="5">{{ $slot }}</textarea>
<x-form.error name="{{ $name }}" />
