@extends('layouts.admin')

@section('content')

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

    <div class="row p-2">

        <form action="{{ route('companies.index') }}" method="GET" style="border:1px solid black">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="filter[name]" class="form-control" placeholder="Name " value="{{ !empty(request()->get('filter')['name']) ? request()->get('filter')['name'] : '' }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="filter[email]" class="form-control" placeholder="Email" value="{{ !empty(request()->input('filter')['email']) ? request()->get('filter')['email'] : '' }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone:</strong>
                    <input type="text" name="filter[phone]" class="form-control" placeholder="Phone" value="{{ !empty(request()->input('filter')['phone']) ? request()->get('filter')['phone'] : '' }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Website:</strong>
                    <input type="text" name="filter[website]" class="form-control" placeholder="Website" value="{{ !empty(request()->input('filter')['website']) ? request()->get('filter')['website'] : '' }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-success m-2" href="{{ route('companies.index') }}"> Clear</a>
                <button type="submit" class="btn btn-primary m-2">Submit</button>
            </div>
        </form>
    </div>

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

    <div class="d-flex justify-content-center">
    {{ $companies->withQueryString()->links() }}
    </div>

@endsection
