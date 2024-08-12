@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="page-inner">

                <div class="card">
                    <h4 style="margin: 16px">หมวดหมู่</h4>
                    <form method="POST" action="{{ route('trave-store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="email2">ชื่อสถานที่ท่องเที่ยว</label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                            name="name" placeholder="ชื่อสถานที่ท่องเที่ยว" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="image">รูปภาพ <span class="-click"> * (เรียกตามตัวอันษร
                                                น้อยไปมาก)</span></label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            id="image" onchange="previewImages(event)" name="image[]" multiple
                                            accept="image/*">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div>
                                    <div class="form-group">
                                        <label for="image">ตัวย่างภาพ</label>
                                        <div id="imagePreview"></div>


                                    </div>
                                    <div class="form-group">
                                        <label for="email2">ประวัติสถานที่ท่องเที่ยว</label>
                                        <textarea name="history_tourist" id="editor1" name="history_tourist " placeholder="Enter Description">
                                            {{ old('history_tourist') }}
                                        </textarea>
                                        @error('history_tourist')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="email2">video</label>
                                        <input type="url" class="form-control  @error('video') is-invalid @enderror"
                                            name="video" placeholder="หมวดหมู่" value="{{ old('video') }}">
                                        @error('video')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="email2">GPS</label>
                                        <input type="url" class="form-control  @error('gps') is-invalid @enderror"
                                            name="gps" placeholder="หมวดหมู่" value="{{ old('gps') }}">
                                        @error('gps')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="email2">เวลาเปิดปิด</label>
                                        <input type="text"
                                            class="form-control  @error('opening_closing_time') is-invalid @enderror"
                                            name="opening_closing_time" placeholder="เวลาเปิดปิด"
                                            value="{{ old('opening_closing_time') }}">
                                        @error('opening_closing_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="category">หมวดหมู่สถานที่ท่องเที่ยว</label>
                                        <select class="form-select @error('category') is-invalid @enderror"
                                            aria-label="Default select example" name="category">
                                            <option value="" selected disabled>เลือกหมวดหมู่</option>
                                            <!-- Optional: Add a default placeholder option -->
                                            @foreach ($data as $da)
                                                <option value="{{ $da->id }}"
                                                    {{ old('category') == $da->id ? 'selected' : '' }}>{{ $da->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
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

    <script>
        CKEDITOR.replace('editor1');
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.instances.editor1.on('change', countCharacters);
        });

        function previewImages(event) {
            var preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            var files = event.target.files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(event) {
                    var img = document.createElement('img');
                    img.setAttribute('src', event.target.result);
                    img.setAttribute('style', 'max-width:100px; max-height:100px; margin: 10px;');
                    preview.appendChild(img);
                }


                reader.readAsDataURL(file);
            }
            var imageEditElement = document.getElementById('image-edit');
            if (imageEditElement) {
                imageEditElement.style.display = 'none';
            }
        }
    </script>
@endsection
