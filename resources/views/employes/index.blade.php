@extends('layouts.admin')

@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employes </h2>
            </div>
            <div class="pull-right p-2">
                <a class="btn btn-success" href="{{ route('employes.create') }}"> Add New Employe</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row p-2">

        <form action="{{ route('employes.index') }}" method="GET" style="border:1px solid black">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" name="first_name" class="form-control" placeholder="First Name " value="{{request()->input('first_name')}}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{request()->input('last_name')}}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company:</strong>
                    <select class="form-control" name="company_id">
                        <option selected value="">Виберіть Компанію</option>
                    @foreach($companies_name as $company_name)
                    @if ($company_name->id == request()->input('company_id'))
                        <option selected value="{{ $company_name->id }}">{{$company_name->name}}</option>
                    @else
                        <option value="{{ $company_name->id }}">{{$company_name->name}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{request()->input('email')}}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone:</strong>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{request()->input('phone')}}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-success" href="{{ route('employes.index') }}"> Clear</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

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
