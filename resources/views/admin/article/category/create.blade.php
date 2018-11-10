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

        $('#J_logo-upload').click(function () {
            $('#J_logo_file').trigger('click');
        });

        $('#J_logo_file').fileupload({
            url: '/api/upload',
            headers: {'X-CSRF-TOKEN': MA.csrfToken},
            formData: {},
            done: function (e, data) {
                $('#J_logo').val(data.result.files[0]);
            }
        });

        $('#J_invitation_code-upload').click(function () {
            $('#J_invitation_code_file').trigger('click');
        });

        $('#J_invitation_code_file').fileupload({
            url: '/api/upload',
            headers: {'X-CSRF-TOKEN': MA.csrfToken},
            formData: {},
            done: function (e, data) {
                $('#J_invitation_code').val(data.result.files[0]);
            }
        });

        $('#J_code_img-upload').click(function () {
            $('#J_code_img_file').trigger('click');
        });

        $('#J_code_img_file').fileupload({
            url: '/api/upload',
            headers: {'X-CSRF-TOKEN': MA.csrfToken},
            formData: {},
            done: function (e, data) {
                $('#J_code_img').val(data.result.files[0]);
            }
        });

    </script>
@endsection

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form method="POST" action="{{ route('admin.article-category.store') }}">
                    <input type="file" class="hidden" id="J_logo_file" name="file">
                    <input type="file" class="hidden" id="J_invitation_code_file" name="file">
                    <input type="file" class="hidden" id="J_code_img_file" name="file">
                    {{ csrf_field() }}
                    <div class="box">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#category_index" data-toggle="tab">基本信息</a></li>
                                <li class=""><a href="#category_img" data-toggle="tab">图片</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane " id="category_index">
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
                                    <div class="form-group{{ $errors->has('android_download_url') ? ' has-error' : '' }}">
                                        <label>安卓下载地址</label>
                                        <input type="text" class="form-control" name="android_download_url"
                                               value="{{ old('android_download_url') }}">
                                        @if ($errors->has('android_download_url'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('android_download_url') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('ios_download_url') ? ' has-error' : '' }}">
                                        <label>IOS下载地址</label>
                                        <input type="text" class="form-control" name="ios_download_url"
                                               value="{{ old('ios_download_url') }}">
                                        @if ($errors->has('ios_download_url'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('ios_download_url') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                        <label>内容</label>
                                        <textarea id="J_content" class="form-control"
                                                  name="content">{{ old('content') }}</textarea>
                                        @if ($errors->has('content'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane " id="category_img">
                                    <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                                        <label>LOGO图</label>
                                        <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" id="J_logo-upload" type="button"><i
                                                        class="fa fa-cloud-upload"></i> 选择文件</button>
                                        </span>
                                            <input type="text" class="form-control" id="J_logo" name="logo" readonly
                                                   value="{{ old('logo') }}">
                                        </div>
                                        @if ($errors->has('logo'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('logo') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('invitation_code') ? ' has-error' : '' }}">
                                        <label>邀请码图</label>
                                        <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" id="J_invitation_code-upload" type="button"><i
                                                        class="fa fa-cloud-upload"></i> 选择文件</button>
                                        </span>
                                            <input type="text" class="form-control" id="J_invitation_code"
                                                   name="invitation_code" readonly
                                                   value="{{ old('invitation_code') }}">
                                        </div>
                                        @if ($errors->has('invitation_code'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('invitation_code') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('code_img') ? ' has-error' : '' }}">
                                        <label>下载二维码</label>
                                        <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" id="J_code_img-upload" type="button"><i
                                                        class="fa fa-cloud-upload"></i> 选择文件</button>
                                        </span>
                                            <input type="text" class="form-control" id="J_code_img" name="code_img"
                                                   readonly
                                                   value="{{ old('code_img') }}">
                                        </div>
                                        @if ($errors->has('code_img'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('code_img') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-primary">提交</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection