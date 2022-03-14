@props(['name', 'type' => 'text', 'value' => ''])

<x-form.label name="{{ $name }}" />
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" class="form-control">
<x-form.error name="{{ $name }}" />
