@extends('admin.layouts.admin')
@section('title','تحرير  مقال')
@section('content')
<section class="" id="app">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <li href="" class="breadcrumb-item" aria-current="page">
                تحرير  مقال
            </li>
        </ol>
    </nav>

    <div class="section_content content_view">
        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row row-gap-24">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <label for="" class="small-label">العنوان   <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ $article->title }}">
                </div>

              

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <label for="" class="small-label">المحتوي   <span class="text-danger">*</span></label>
                    <textarea name="content" class="ckeditor form-control" rows="4">{!!  $article->content !!}</textarea>
                </div>
               
            
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>صورة</label>
                        <input class="form-control img" onchange="showImagePreview(this)" name="image" type="file" accept="image/*">
                    </div>
                    <div class="img-holder">
                        <img src="{{ display_file($article->image) }}" alt="" class="img-thumbnail img-preview"
                            width="100px">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <button type="submit" class="btn btn-primary px-5">حفظ التغييرات</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>
    <script src="{{ asset('admin-asset/js/fileinput/themes/bs5/theme.min.js') }}"></script>

@endpush
@endsection
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });

    function showImagePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.img-preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
