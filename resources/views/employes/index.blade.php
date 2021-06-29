@extends('layouts.admin')

@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employes </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employes.create') }}"> Add New Employe</a>
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
            <th>First Name</th>
            <th>Last Name</th>
            <th>Company</th>
            <th>Email</th>
            <th>Phone</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($employes as $employe)
        <tr>
            <td>{{ $employe->first_name }}</td>
            <td>{{ $employe->last_name }}</td>
            <td>{{ $employe->company->name }}</td>
            <td>{{ $employe->email }}</td>
            <td>{{ $employe->phone }}</td>
            <td>
                 <a class="btn btn-info" href="{{ route('employes.show',$employe->id) }}">View</a>
                    <a class="btn btn-primary" href="{{ route('employes.edit',$employe->id) }}">Edit</a>
                <form action="{{ route('employes.destroy',$employe->id) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {{ $employes->links() }}
    </div>

@endsection
