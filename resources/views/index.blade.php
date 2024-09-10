@extends('masterlayout.layout')
@section('content')
    <div class="container-fluid">
        <div class="mt-4 mb-5"
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </div>
        @can('isAdmin')
            
        <div class="row my-2">
            <div class="col">
                <a href="{{ route('addTask') }}" class="btn btn-primary">
                    Add new
                </a>
            </div>
        </div>
        @endcan
       
        <input type="hidden" value="{{ Auth::user()->role }}" id="role">
        <div class="card border-0 shadow">
            <div class="card-header">
                <div class="card-title">
                    <h4>
                        Tasks List
                    </h4>
                </div>
            </div>
            <div class="card-subtitle p-4">
                <div class="row justify-content-end">
                    <div class="col-2">
                        <input type="search" class="form-control" placeholder="search" id="search">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid" id="taskContainer">

                </div>
            </div>
        </div>

    </div>
@endsection
<script>
   
</script>
