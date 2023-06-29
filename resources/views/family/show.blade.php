@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Keluarga</h1>

        <ul class="family-tree">
            <li>
                <span class="node">{{ $family->name }}</span>
                <ul>
                    @foreach($family->children as $child)
                        @include('family.partial-family-tree', ['family' => $child])
                    @endforeach
                </ul>
            </li>
        </ul>

        <a href="{{ routed('family.edit', ['family' => $family->id]) }}" class="btn btn-primary">Edit</a>

        <form action="{{ routed('family.destroy', ['family' => $family->id]) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
