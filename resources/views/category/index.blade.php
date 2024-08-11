@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">หมวดหมู่</h4>
                        <a href="{{ url('category-create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Add Row</a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="col-sm-12 col-md-12">
                                <form class="d-flex" role="search" method="POST" action="{{ route('category-store') }}"
                                    enctype="multipart/form-data">
                                    @csrf>
                                    <input class="form-control me-2" type="search" name="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="add-row" class="display table table-striped table-hover dataTable"
                                        role="grid" aria-describedby="add-row_info">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>หมวดหมู่</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($data as $da)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $i++ }}</td>
                                                    <td>{{ $da->name }}</td>
                                                    <td>
                                                        <div class="form-button-action">

                                                            <a type="button" href="{{ url('category-destroy', $da->id) }}"
                                                                data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger" data-original-title="Remove"
                                                                onclick="return confirm('Are you sure you want to delete this category?');">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
