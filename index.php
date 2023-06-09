<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Чайники</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!-- Добавление  -->
<div class="modal fade" id="teaAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Добавить чайник</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveTea">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Название</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Описание</label>
                    <input type="text" name="description" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Редактирование -->
<div class="modal fade" id="teaEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Редактировать</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateTea">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="id" id="id" >

                <div class="mb-3">
                    <label for="">Название</label>
                    <input type="text" name="name" id="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Описание</label>
                    <input type="text" name="description" id="description" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            </div>
        </form>
        </div>
    </div>
</div>



<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Это страница с чайниками
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#teaAddModal">
                            Добавить чайник
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Описание</th>
                                
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'dbcon.php';

                            $query = "SELECT * FROM teapot";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $tea)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $tea['id'] ?></td>
                                        <td><?= $tea['name'] ?></td>
                                        <td><?= $tea['description'] ?></td>
                                        
                                        <td>
                                            
                                            <button type="button" value="<?=$tea['id'];?>" class="editTeaBtn btn btn-success btn-sm">Изменить</button>
                                            <button type="button" value="<?=$tea['id'];?>" class="deleteTeaBtn btn btn-danger btn-sm">Удалить</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#saveTea', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_tea", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#teaAddModal').modal('hide');
                        $('#saveTea')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editTeaBtn', function () {

            var id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?id=" + id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#id').val(res.data.id);
                        $('#name').val(res.data.name);
                        $('#description').val(res.data.description);
                        

                        $('#teaEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateTea', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_tea", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#teaEditModal').modal('hide');
                        $('#updateTea')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        

        $(document).on('click', '.deleteTeaBtn', function (e) {
            e.preventDefault();

            if(confirm('Вы уверены, что хотите удалить эту запись?'))
            {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_tea': true,
                        'id': id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });

    </script>

</body>
</html>