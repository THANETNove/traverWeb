@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">สถานที่ท่องเที่ยว</h4>
                        <a class="btn btn-primary btn-round ms-auto" href="{{ url('trave-create') }}">
                            <i class="fa fa-plus"></i>
                            เพิ่ม สถานที่ท่องเที่ยว
                        </a>
                    </div>
                </div>
                <div class="card-body">


                    <div class="table-responsive">
                        <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="col-sm-12 col-md-12">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search"
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
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th style="width: 120.688px;" class="sorting" tabindex="0"
                                                    aria-controls="add-row" rowspan="1" colspan="1"
                                                    aria-label="Action: activate to sort column ascending">Action</th>
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

                                                        @if ($da->image)
                                                            @foreach (json_decode($da->image) as $imageUrl)
                                                                <img src="{{ URL::asset($imageUrl) }}" alt="Product Image"
                                                                    style="width: 50px; height: auto;"
                                                                    class="image-clickable">
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a type="button" data-bs-toggle="tooltip"
                                                                href="{{ url('trave-edit', $da->id) }}"
                                                                class="btn btn-link btn-primary btn-lg"
                                                                data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="add-row_info" role="status" aria-live="polite">
                                        Showing
                                        {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
                                        {!! $data->links() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="" class="modal-image img-fluid">
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // เลือกภาพที่มีคลาส image-clickable และเพิ่ม event listener
            document.querySelectorAll('.image-clickable').forEach(function(img) {
                img.addEventListener('click', function() {
                    var imageUrl = this.getAttribute('src');
                    var modalImage = document.querySelector('.modal-image');

                    // ตั้งค่า src ของภาพใน modal
                    modalImage.setAttribute('src', imageUrl);

                    // เรียกใช้ Modal ด้วย ID ของ Modal
                    $('#imageModal').modal('show');
                });
            });
        });
    </script>
@endsection
