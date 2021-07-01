@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Company</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Logo:</strong>
                <img src="/storage/companies/{{ $company->logo }}" alt="" class="img-thumbnail" style="width: 200px; height: 200px;">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $company->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $company->email }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                {{ $company->phone }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Website:</strong>
                {{ $company->website }}
            </div>
        </div>
    </div>
    <div class="col-lg-12 margin-tb d-flex align-items-center justify-content-around">
        <div class="pull-left">

    <div class="row">
        <form action="{{ url('companies/import/'.$company->id) }}" method="POST" enctype="multipart/form-data" style="border:1px solid black">
            @csrf
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>File :</strong>
                <input type="file" name="import" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </div>
        </form>
        </div>
    </div>


    <div class="pull-right">
    <div class="row">
        <a class="btn btn-primary m-2" href="{{ url('companies/export/'.$company->id.'/xlsx') }}">Export xlsx</a>
        <a class="btn btn-primary m-2" href="{{ url('companies/export/'.$company->id.'/csv') }}">Export csv</a>
    </div>
    </div>
</div>

@endsection
