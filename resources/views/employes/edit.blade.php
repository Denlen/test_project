@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Employe</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employes.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employes.update',$employe->id) }}" method="POST">
        @csrf

        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" name="first_name" class="form-control" placeholder="First Name " value="{{ $employe->first_name }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ $employe->last_name }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company:</strong>

                    <select class="form-control" name="company_id">
                    @foreach($companies_name as $company_name)
                    @if ($company_name->name === $employe->company->name)
                        <option selected value="{{ $company_name->id }}">{{$company_name->name}}</option>
                    @else
                        <option value="{{ $company_name->id }}">{{$company_name->name}}</option>
                    @endif
                    @endforeach
                    </select>

                    {{-- <input type="text" name="company_id" class="form-control" placeholder="Company" value="{{ $employe->company->name }}"> --}}
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $employe->email }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone:</strong>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $employe->phone }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
