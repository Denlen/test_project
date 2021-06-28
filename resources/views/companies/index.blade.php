@extends('layouts.admin')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">

    </div>
</div> --}}

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Companies </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('companies.create') }}"> Add New Company</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Website</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($companies as $company)
        <tr>
            <td>{{ $company->name }}</td>
            <td>{{ $company->email }}</td>
            <td>{{ $company->phone }}</td>
            <td>{{ $company->website }}</td>
            <td>
                 <a class="btn btn-info" href="{{ route('companies.show',$company->id) }}">View</a>
                    <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
                <form action="{{ route('companies.destroy',$company->id) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
