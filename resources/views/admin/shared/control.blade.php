@php
    $type = $type ?? 'text';
    $class = $class ?? null;
    $name = $name ?? '';
    $value = $value ?? '';
    $label = $label ?? ucfirst($name);
@endphp

<div class="mb-3 input-group input-group-outline">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <input type="{{$type}}" class="form-control {{--@error($name) is-invalid @enderror--}}" id="{{$name}}" name="{{$name}}" value="{{ old($name, $value) }}" />
    {{--@error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror--}}
</div>
