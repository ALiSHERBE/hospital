<div class="row">
    <div class="col left-aside"></div>
    <div class="col">
        <div class="py-4 text-center">
            <h2>Ваша заявка принята!</h2>
            <p class="lead">Пожалуйста подождите, пока регистратура обработает вашу заявку</p>
            <p class="lead">Через несколько минут попробуйте ввести данные в форму рассположенную ниже</p>
        </div>
        <form action="apply.php" method="post">
            <div class="mb-3">
                <label for="passport" class="form-label">Серия и номер паспорта</label>
                <input type="number" class="form-control" id="passport" name="passport" placeholder="1122334455" value="" required="">
            </div>
            <hr class="my-4">
            <button name="btn_apply" class="w-100 btn btn-primary btn-lg" type="submit">Подтвердить</button>
        </form>
    </div>
    <div class="col right-aside"></div>
</div>
