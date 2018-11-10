@extends('admin.layouts.iframe')

@section('css')
    <link rel="stylesheet" href="/vendor/adminlte/plugins/select2/dist/css/select2.min.css">  
@endsection

@section('js')
    <script src="/vendor/adminlte/plugins/select2/dist/js/select2.full.min.js"></script>
@endsection

@section('script')  
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('admin.link.update', $link) }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">编辑友情链接</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label>名称</label>
                                <input type="text" class="form-control"  name="name"
                                       value="{{ $link->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                <label>URL地址</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-internet-explorer fa-fw"></i></span>
                                    <input type="url" class="form-control" name="url"
                                           value="{{ $link->url }}" placeholder="URL地址">
                                </div>
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
                                <label>排序</label>
                                <input type="text" class="form-control" name="sort" value="{{ $link->sort }}"
                                       placeholder="越大越靠前 ">
                                @if ($errors->has('sort'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sort') }}</strong>
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