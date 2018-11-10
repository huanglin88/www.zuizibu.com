@extends('admin.layouts.iframe')

@section('css')
    <link rel="stylesheet" href="/vendor/adminlte/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/jQuery-File-Upload/css/jquery.fileupload.css">
@endsection

@section('js')
    <script src="/vendor/adminlte/plugins/select2/dist/js/select2.full.min.js"></script>
    <script src="/vendor/adminlte/plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/vendor/adminlte/plugins/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
    <script src="/vendor/adminlte/plugins/jQuery-File-Upload/js/jquery.fileupload.js"></script>
@endsection

@section('script')
    <script>
        $('.select2').select2();

        $('#J_title').keyup(function () {
            var $this = $(this);
            $$.ajax({
                url: '/api/convert-slug',
                data: {table: 'articles', 'delimiter': '-', 'text': $this.val()},
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

        $('#J_cover-upload').click(function () {
            $('#J_file').trigger('click');
        });

        $('#J_file').fileupload({
            url: '/api/upload',
            headers: {'X-CSRF-TOKEN': MA.csrfToken},
            formData: {},
            done: function (e, data) {
                $('#J_cover').val(data.result.files[0]);
            }
        });
    </script>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('admin.article.update', $article) }}">
                    <input type="file" class="hidden" id="J_file" name="file">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">编辑资讯</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('article_category_id') ? ' has-error' : '' }}">
                                <label>分类</label>
                                <select class="form-control select2" name="article_category_id">
                                    <option value="">-</option>
                                    @foreach(\App\ArticleCategory::all() as $category)
                                        <option value="{{ $category->id }}"{!! $article->article_category_id==$category->id ? ' selected' : '' !!}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('article_category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('article_category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label>标题</label>
                                <input type="text" class="form-control" id="J_title" name="title"
                                       value="{{ $article->title }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label>SLUG</label>
                                <input type="text" class="form-control" id="J_slug" name="slug"
                                       value="{{ $article->slug }}">
                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
                                <label>封面</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" id="J_cover-upload" type="button"><i
                                                    class="fa fa-cloud-upload"></i> 选择文件</button>
                                    </span>
                                    <input type="text" class="form-control" id="J_cover" name="cover" readonly
                                           value="{{ $article->cover }}">
                                </div>
                                @if ($errors->has('cover'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cover') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
                                <label>排序</label>
                                <input type="text" class="form-control" name="sort" value="{{ $article->sort }}"
                                       placeholder="越大越靠前 ">
                                @if ($errors->has('sort'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sort') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('abstract') ? ' has-error' : '' }}">
                                <label>摘要</label>
                                <textarea  class="form-control"
                                           name="abstract">{{ $article->abstract }}</textarea>
                                @if ($errors->has('abstract'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('abstract') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label>内容</label>
                                <textarea id="J_content" name="content">{{ $article->content }}</textarea>
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