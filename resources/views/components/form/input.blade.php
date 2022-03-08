@props(['name', 'type' => 'text'])

<x-form.label name="{{ $name }}" />
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}">
<x-form.error name="{{ $name }}" />
