@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Family Tree Query</h1>

        <form action="{{ route('query.executeQuery') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="queryOption">Pilih Query:</label>
                <select id="queryOption" name="queryOption" class="form-select" onchange="this.form.submit()">
                    <option value="3" @selected(old('queryOption', ) == 3)>Dapatkan semua anak Budi</option>
                    <option value="4" @selected(old('queryOption', ) == 4)>Dapatkan cucu dari Budi</option>
                    <option value="5" @selected(old('queryOption', ) == 5)>Dapatkan cucu perempuan dari Budi</option>
                    <option value="6" @selected(old('queryOption', ) == 6)>Dapatkan bibi dari Farah</option>
                    <option value="7" @selected(old('queryOption', ) == 7)>Dapatkan sepupu laki-laki dari Hani</option>
                </select>
            </div>
        </form>

        @if(isset($family) && $scriptQuery)
            <div id="queryResult">
                <h2>Script Query</h2>
                <pre id="scriptQuery">{{ $scriptQuery ?? '' }}</pre>

                <h2>Hasil</h2>
                <h1>Detail Keluarga</h1>

                <ul class="family-tree">
                    <li>
                        <ul>
                            @foreach($family as $child)
                                @include('family.partial-family-tree', ['family' => $child])
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        @endif
    </div>
@endsection
