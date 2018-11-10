@extends('admin.layouts.iframe')

@section('css')
@endsection

@section('js')

@endsection

@section('script')
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('admin.set.update', $set) }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">设置站点</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('content_1') ? ' has-error' : '' }}">
                                <label>标题</label>
                                <textarea class="form-control"
                                          name="content_1">{{ $set->content_1 }}
                                </textarea>
                            </div>

                            <div class="form-group{{ $errors->has('content_2') ? ' has-error' : '' }}">
                                <label>APP介绍</label>
                                <textarea class="form-control"
                                          name="content_2">{{ $set->content_2 }}
                                </textarea>
                            </div>
                            <div class="form-group{{ $errors->has('content_3') ? ' has-error' : '' }}">
                                <label>优势</label>
                                <textarea class="form-control"
                                          name="content_3">{{ $set->content_3 }}
                                </textarea>
                            </div>
                            <div class="form-group{{ $errors->has('content_4') ? ' has-error' : '' }}">
                                <label>未来</label>
                                <textarea class="form-control"
                                          name="content_4">{{ $set->content_4}}
                                </textarea>
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