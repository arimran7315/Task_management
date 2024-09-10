@extends('masterlayout.layout')
@section('content')
    <div class="mt-4 mb-5"
        style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>Pending Approvals</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($managers->isEmpty())
                        <tr>
                            <td colspan="3" class="text-danger text-center">
                                No Result
                            </td>
                        </tr>
                        @else
                            @foreach ($managers as $manager)
                                <tr>
                                    <td>
                                        {{ $manager->name }}
                                    </td>
                                    <td>
                                        {{ $manager->email }}
                                    </td>
                                    <td>
                                        @if ($manager->status == 0)
                                            <h6><a href="{{ route('upate.approvel', $manager->id) }}"><span
                                                        class="badge text-bg-danger">Not Approved</span></a></h6>
                                        @else
                                            <h6><span class="badge text-bg-success">Approved</span></h6>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
