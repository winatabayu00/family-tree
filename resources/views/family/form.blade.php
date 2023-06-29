@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Add Family Member
                        <a href="{{ route('family.index') }}" class="btn btn-primary float-right">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            @if(request()->routeIs('family.edit'))
                                @method("PUT")
                            @endif
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="male" @selected(old('gender') == 'male')>Male</option>
                                    <option value="female" @selected(old('gender') == 'female')>Female</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Parent</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($familyMembers as $familyMember)
                                        <option value="{{ $familyMember->id }}" @selected(old('parent_id', ) == $familyMember->id)>{{ $familyMember->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
