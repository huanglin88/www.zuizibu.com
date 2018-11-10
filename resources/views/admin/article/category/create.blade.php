@extends('admin.layouts.iframe')

@section('css')
    <link rel="stylesheet" href="/vendor/adminlte/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/jQuery-File-Upload/css/jquery.fileupload.css">
@endsection

@section('js')
    <script src="/vendor/adminlte/plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/vendor/adminlte/plugins/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
    <script src="/vendor/adminlte/plugins/jQuery-File-Upload/js/jquery.fileupload.js"></script>
@endsection

@section('script')
    <script>
        $('#J_name').keyup(function () {
            var $this = $(this);
            $$.ajax({
                url: '/api/convert-slug',
                data: {table: 'article_categories', 'text': $this.val()},
                success: function (data) {
                    $('#J_slug').val(data.slug);
                }
            });
        });

        $('#J_content').summernote({
            height: 300,
            callbacks: {
                onImageUpload: function (files) {
                    var formData = new FormData();
                    $.each(files, function (key, file) {
                        formData.append(key, file);
                    });
                    $$.ajax({
                        url: '/api/upload',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $.each(data.files, function (key, file) {
                                $('#J_content').summernote('insertImage', file, function ($image) {
                                    $image.css('width', '100%');
                                });
                            });
                        }
                    });
                }
            }
        });
    </script>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('admin.article-category.store') }}">
                    {{ csrf_field() }}
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">创建分类</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label>名称</label>
                                <input type="text" class="form-control" id="J_name" name="name"
                                       value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label>SLUG</label>
                                <input type="text" class="form-control" id="J_slug" name="slug"
                                       value="{{ old('slug') }}">
                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label>内容</label>
                                <textarea id="J_content" name="content">{{ old('content') }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection