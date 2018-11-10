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
        var $table = $('#J_categories').DataTable({
            'processing': true,
            'serverSide': true,
            'ajax': {
                url: '/api/article-category',
                headers: {'X-CSRF-TOKEN': MA.csrfToken}
            },
            'columnDefs': [
                {'orderable': false, 'targets': -1}
            ],
            'columns': [
                {data: 'id'},
                {data: 'name'},
                {data: 'slug'},
                {data: 'articles_count'},
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
                    url: '/api/article-category/' + $this.data('id'),
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
    </script>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="{{ route('admin.article-category.create') }}" class="btn btn-primary" data-tab='@json(['name' => 'module_create-category', 'text' => '创建分类'])'><i class="fa fa-plus"></i>
                            新分类</a>
                    </div>
                    <div class="box-body">
                        <table id="J_categories" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>名称</th>
                                <th>SLUG</th>
                                <th>资讯</th>
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