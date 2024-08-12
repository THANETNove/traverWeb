@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="page-inner">

                <div class="card">
                    <h4 style="margin: 16px">หมวดหมู่</h4>
                    <form method="POST" action="{{ route('trave-update', $dataTrave->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="email2">ชื่อสถานที่ท่องเที่ยว</label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                            name="name" placeholder="ชื่อสถานที่ท่องเที่ยว"
                                            value="{{ $dataTrave->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="image">รูปภาพ <span class="-click"> * (เรียกตามตัวอันษร
                                                น้อยไปมาก)</span></label>
                                        <input type="file" class="form-control @error('image.*') is-invalid @enderror"
                                            id="image" onchange="previewImages(event)" name="image[]" multiple
                                            accept="image/*">
                                        @error('image.*')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">ตัวย่างภาพ</label>
                                        <div id="imagePreview"></div>
                                        <div id="imagePreview2">
                                            @if ($dataTrave->image)
                                                @foreach (json_decode($dataTrave->image) as $imageUrl)
                                                    <img src="{{ URL::asset($imageUrl) }}" alt="Product Image"
                                                        style="width: 100px; height: auto;  margin: 10px;"
                                                        class="image-clickable">
                                                @endforeach
                                            @endif
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label for="email2">ประวัติสถานที่ท่องเที่ยว</label>
                                        <textarea name="history_tourist" id="editor1" class="@error('history_tourist') is-invalid @enderror"
                                            placeholder="Enter Description">
                                            {{ $dataTrave->history_tourist }}
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
                                            name="video" placeholder="video" value="{{ $dataTrave->video }}">
                                        @error('video')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="email2">GPS</label>
                                        <input type="url" class="form-control  @error('gps') is-invalid @enderror"
                                            name="gps" placeholder="gps" value="{{ $dataTrave->gps }}">
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
                                            value="{{ $dataTrave->opening_closing_time }}">
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
                                                    {{ $dataTrave->category == $da->id ? 'selected' : '' }}>
                                                    {{ $da->name }}
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
            document.getElementById('imagePreview2').style.display = 'none';
            var preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            var files = event.target.files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(event) {
                    var img = document.createElement('img');
                    img.setAttribute('src', event.target.result);
                    img.setAttribute('style', 'max-width:100px; max-height:auto; margin: 10px;');
                    preview.appendChild(img);
                }


                reader.readAsDataURL(file);
            }
            var imageEditElement = document.getElementById('image-edit');
            if (imageEditElement) {
                imageEditElement.style.display = 'none';
            }
        }

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
