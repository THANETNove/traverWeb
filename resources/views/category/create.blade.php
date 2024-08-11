@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="page-inner">

                <div class="card">

                    <form method="POST" action="{{ route('category-store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="email2">หมวดหมู่</label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                            name="name" placeholder="หมวดหมู่">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
