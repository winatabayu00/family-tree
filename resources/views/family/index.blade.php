
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Family Members
                        <a href="{{ routed('family.create') }}" class="btn btn-primary float-right">Add Member</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Parent</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($families as $family)
                                <tr>
                                    <td>{{ $family->name }}</td>
                                    <td>{{ $family->gender }}</td>
                                    <td>{{ $family->parent ? $family->parent->name : '-' }}</td>
                                    <td>
                                        <a href="{{ routed('family.show', ['family' => $family->id]) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ routed('family.edit', ['family' => $family->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ routed('family.destroy', ['family' => $family->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this family member?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                data belum ada
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
