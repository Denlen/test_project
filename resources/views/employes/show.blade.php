@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show employe</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <table class="table table-bordered">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            <tr>
                <td>{{ $employe->first_name }}</td>
                <td>{{ $employe->last_name }}</td>
                <td>{{ $employe->company->name }}</td>
                <td>{{ $employe->email }}</td>
                <td>{{ $employe->phone }}</td>
            </tr>
        </table>

    </div>
@endsection
