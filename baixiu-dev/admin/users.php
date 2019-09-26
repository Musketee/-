<?php

require_once '../functions.php';

xiu_get_current_user();

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Users &laquo; Admin</title>
    <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/static/assets/css/admin.css">
    <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<script>NProgress.start()</script>

<div class="main">
    <?php include 'inc/navbar.php'; ?>

    <div class="container-fluid">
        <div class="page-title">
            <h1>用户</h1>
        </div>
        <!-- 有错误信息时展示 -->
        <!-- <div class="alert alert-danger">
          <strong>错误！</strong>发生XXX错误
        </div> -->
        <div class="row">
            <div class="col-md-4">
                <form>
                    <h2>添加新用户</h2>
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
                    </div>
                    <div class="form-group">
                        <label for="slug">别名</label>
                        <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
                        <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
                    </div>
                    <div class="form-group">
                        <label for="nickname">昵称</label>
                        <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
                    </div>
                    <div class="form-group">
                        <label for="password">密码</label>
                        <input id="password" class="form-control" name="password" type="text" placeholder="密码">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">添加</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="page-action">
                    <!-- show when multiple checked -->
                    <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" width="40"><input type="checkbox"></th>
                        <th class="text-center" width="80">头像</th>
                        <th>邮箱</th>
                        <th>别名</th>
                        <th>昵称</th>
                        <th>状态</th>
                        <th class="text-center" width="100">操作</th>
                    </tr>
                    </thead>
                    <tbody>
<!--                    <tr>-->
<!--                        <td class="text-center"><input type="checkbox"></td>-->
<!--                        <td class="text-center"><img class="avatar" src="/static/assets/img/default.png"></td>-->
<!--                        <td>i@zce.me</td>-->
<!--                        <td>zce</td>-->
<!--                        <td>汪磊</td>-->
<!--                        <td>激活</td>-->
<!--                        <td class="text-center">-->
<!--                            <a href="post-add.php" class="btn btn-default btn-xs">编辑</a>-->
<!--                            <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>-->
<!--                        </td>-->
<!--                    </tr>-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $current_page = 'users'; ?>
<?php include 'inc/sidebar.php'; ?>

<script src="/static/assets/vendors/jquery/jquery.js"></script>
<script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
<script src="/static/assets/vendors/jsrender/jsrender.js"></script>
<script id="user_tmpl" type="text/x-jsrender">
       {{for users}}
        <tr data-id="{{:id}}">
            <td class="text-center"><input type="checkbox"></td>
            <td class="text-center"><img class="avatar" src="{{:avatar}}"></td>
             <td>{{:email}}</td>
            <td>{{:slug}}</td>
            <td>《{{:nickname}}》</td>
            <td>{{:status}}</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-danger btn-xs btn-delete">删除</a>
            </td>
         </tr>
      {{/for}}
</script>
<script>
    $(function () {
        $.getJSON('/admin/api/user.php', {}, function (res){
            // console.log(res);
            var html = $('#user_tmpl').render({users: res});
            $('tbody').html(html);
        });
        //删除数据
        $('tbody').on('click', '.btn-delete', function () {
            // console.log(11);
            var $tr = $(this).parent().parent();
            var id = $tr.data('id');
            $.get('/admin/api/user-delete.php', {id: id}, function (res) {
                if(!res) return;
                $tr.remove();
            });
        });
        // 添加数据
        $('.btn-primary').click(function () {
            var email = $("#email").val();
            var slug = $('#slug').val();
            var nickname = $("#nickname").val();
            var password = $("#password").val();
            // console.log(email);
            $.ajax({
                url:"/admin/api/user-add.php",
                data:{email:email, slug:slug, nickname:nickname, password:password},
                type: "POST",
                dataType:"TEXT",
                success: function (data) {
                    console.log(data);
                        if(data.trim()=="ok"){
                            alert("添加成功");
                        }else{
                            alert("添加失败");
                        }
                }
            })
        });
    });

</script>
<script>NProgress.done()</script>
</body>
</html>
