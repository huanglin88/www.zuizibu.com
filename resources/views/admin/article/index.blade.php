@extends('admin.layouts.iframe')

@section('css')
    <link rel="stylesheet" href="/vendor/adminlte/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('js')
    <script src="/vendor/adminlte/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/adminlte/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
@endsection

@section('script')
    <script>
        var $table = $('#J_articles').DataTable({
            'processing': true,
            'serverSide': true,
            'searching': false,
            'ajax': {
                url: '/api/article',
                headers: {'X-CSRF-TOKEN': MA.csrfToken},
                data: function (d) {
                    $.each($('.j-form :input').serializeArray(), function () {
                        d[this.name] = this.value;
                    });
                }
            },
            'columnDefs': [
                {'orderable': false, 'targets': -1}
            ],
            'columns': [
                {data: 'id'},
                {data: 'category.name'},
                {data: 'title'},
                {data: 'views'},
                {data: 'created_at'},
                {data: 'actions', orderable: false, searchable: false}
            ],
            "oLanguage": {
                "sLengthMenu": "每页显示 _MENU_ 条记录",
                "sZeroRecords": "抱歉， 没有找到",
                "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
                "sInfoEmpty": "没有数据",
                "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
                "sSearch": "搜索:",
                "oPaginate": {
                    "sFirst": "首页",
                    "sPrevious": "前一页",
                    "sNext": "后一页",
                    "sLast": "尾页"
                },
                "sZeroRecords": "没有检索到数据"
            }
        });

        $table.on('click', '.J_delete', function () {
            var $this = $(this);
            if (confirm('您确定删除此行？')) {
                $$.ajax({
                    url: '/api/article/' + $this.data('id'),
                    type: 'DELETE',
                    success: function () {
                        $$.noty({
                            type: 'info',
                            text: '已成功删除此行数据'
                        });
                        $table.draw();
                    }
                });
            } else {
                $$.noty({
                    type: 'warning',
                    text: '未删除任何数据，请放心'
                });
            }
        });

        $('.j-search').click(function () {
            $table.draw();
        });
    </script>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="{{ route('admin.article.create') }}" class="btn btn-primary" data-tab='@json(['name' => 'module_create-article', 'text' => '创建资讯'])'><i class="fa fa-plus"></i>
                            新资讯</a>
                    </div>
                    <div class="box-body">
                        <form class="form-inline j-form col-xs-12" style="padding: 20px 0px;">
                            <div class="row" style="padding-bottom: 10px;">
                                <div class="form-group col-sm-4">
                                    <label>关键字</label>
                                    <input type="text" class="form-control" name="key" placeholder="ID/名称">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>分类</label>
                                    <select class="form-control select2" id="category_id" name="category_id">
                                        <option value="">请选择分类</option>
                                        @foreach(\App\ArticleCategory::get() as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-2 pull-right">
                                    <button type="button" class="btn btn-primary btn-flat j-search">搜索</button>
                                    <button type="button" class="btn btn-default btn-flat j-clear">清空</button>
                                </div>
                            </div>
                        </form>

                        <table id="J_articles" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>分类</th>
                                <th>标题</th>
                                <th>查看</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection