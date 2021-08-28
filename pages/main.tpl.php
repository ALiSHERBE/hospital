<div class="row">
    <div class="col left-aside"></div>
    <div class="col">
        <div class="py-4 text-center">
            <h2>Добрый день, введите, пожалуйста, серию и номер своего паспорта</h2>
            <p class="lead">Заполнение формы обязательно для дальнейшего доступа в систему</p>
        </div>
        <form action="apply.php" method="post">
            <div class="mb-3">
                <label for="passport" class="form-label">Серия и номер паспорта</label>
                <input type="number" class="form-control" id="passport" name="passport" placeholder="1122334455" value="" required="">
            </div>
            <hr class="my-4">
            <button name="btn_apply" class="w-100 btn btn-primary btn-lg" type="submit">Подтвердить</button>
        </form>

        <div>
            <p>
                <a class="w-100 btn btn-outline-success btn-lg" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Войти как доктор
                </a>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <form action="/doctor.php" method="post">
                        <div class="mb-3">
                            <label for="id" class="form-label">Ваш id</label>
                            <input type="number" class="form-control" id="id" name="doctor_id" placeholder="1" value="" required="">
                        </div>
                        <hr class="my-4">
                        <button name="btn_apply" class="w-100 btn btn-primary btn-lg" type="submit">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col right-aside"></div>
</div>

<script>

</script>
