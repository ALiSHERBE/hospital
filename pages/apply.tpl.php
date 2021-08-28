<?php if (!$show_form):?>
    <header class="pb-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
            <span class="fs-4">Главная</span>
        </a>
    </header>

    <div class="row">
        <div class="col-2 left-aside"></div>
        <div class="col">
            <div class="py-4 text-center">
                <h2>Добро пожаловать, <?php echo $person['fio']?></h2>
            </div>
            <!-- <p>person_id: <?php echo $person['person_id']?></p>
            <p>patient_id: <?php echo $person['patient_id']?></p>
            <p>medkart_id: <?php echo $person['medkart_id'];?></p> -->
            <p><strong>Имя вашего лечащего врача:</strong> <?php echo $person['doctor_fio'];?></p>
            <p><strong>Назначенное время посещения врача</strong>: <?php echo $person['date_of_visit'];?></p>
            <p><strong>Текущая дата:</strong> <?php echo $current_date?></p>
            <?php if ($person['prescription']):?>
                <p><strong>Рецепт:</strong> <?php echo $person['prescription']?></p>
            <?php endif?>
            <?php if ($person['advice']):?>
                <p><strong>Рекомендации:</strong> <?php echo $person['advice']?></p>
            <?php endif?>
	        <?php if ($person['diagnos']):?>
                <p><strong>Диагноз:</strong> <?php echo $person['diagnos']?></p>
	        <?php endif?>
            <?php if ($person['complains']):?>
                <p><strong>Жалобы:</strong> <?php echo $person['complains']?></p>
	        <?php endif?>
	        <?php if ($person['next_visit'] != '0000-00-00'):?>
                <p><strong>След. посещение:</strong> <?php echo $person['next_visit']?></p>
	        <?php endif?>
        </div>
        <div class="col-2 right-aside"></div>
    </div>
<?php else:?>
    <div class="row">
        <div class="col left-aside"></div>
        <div class="col">
            <div class="py-4 text-center">
                <?php if (isset($person['fio'])):?>
                    <h2>Запись на новый прием - <?php echo $person['fio']?></h2>
                <?php else:?>
                    <h2>Данные не найдены</h2>
                    <p class="lead">Заполните форму для дальнейшего доступа в систему</p>
                <?php endif?>
            </div>
            <form action="register_new_people.php" method="post">
                <div class="mb-3">
                    <label for="fio" class="form-label">Ф.И.О</label>
                    <input type="text" class="form-control" id="fio" name="fio" placeholder="Ф.И.О" value="<?php echo $person['fio']?>" required="">
                </div>
                <div class="mb-3">
                    <label for="passport" class="form-label">Серия и номер паспорта</label>
                    <input type="number" class="form-control" id="passport" name="passport" placeholder="1122334455" value="<?php echo isset($passport) ? $passport : $person['passport'] ?>" required="">
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Ваш возраст</label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="26" value="<?php echo $person['age']?>" required="">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Ваш адрес</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Тухачевского 27" value="<?php echo $person['address']?>" required="">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Ваш email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $person['email']?>" required="">
                </div>
                <div class="mb-3">
                    <select name="gender" class="form-select">
                        <option <?php if ($person['gender']):?><?php else:?>selected<?php endif?>>Выберите Ваш пол</option>
                        <option value="1" <?php if ($person['gender'] == 1):?>selected<?php endif?>>Мужской пол</option>
                        <option value="0" <?php if ($person['gender'] == '0'):?>selected<?php endif?>>Женский пол</option>
                    </select>
                </div>
	            <?php if (!$person['person_id']):?>
                    <div class="mb-3">
                        <select name="insurance" class="form-select">
                            <option selected>Выберите медицинскую страховку</option>
				            <?foreach($insurances as $key => $value):?>
                                <option value="<?php echo $value['insurance_id']?>"><?= $value['name'].' - цена: '.$value['yearcost'] ?></option>
				            <?endforeach;?>
                        </select>
                    </div>
	            <?php endif?>

                <div class="mb-3">
                    <div class="mb-3">
                        <label for="complaint" class="form-label">Ваши жалобы</label>
                        <textarea class="form-control" id="complaint" rows="3" name="complaint"></textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <select name="professions" class="form-select" id="select-id">
                        <option selected>Выберите специальность доктора</option>
			            <?foreach($professions as $key => $value):?>
                            <option value="<?php echo $value['profession_id']?>"><?= $value['name']?></option>
			            <?endforeach;?>
                    </select>
                </div>

                <div class="mb-3">
                    <select name="doctor" class="form-select hidden" id="doctors">
                        <option selected>Выберите доктора</option>
                    </select>
                </div>

                <?php if ($person['person_id']):?>
                    <input type="hidden" name="person_id" value="<?php echo $person['person_id']?>">
                <?php endif?>

                <hr class="my-4">
                <button name="btn_diagnos" class="w-100 btn btn-primary btn-lg" type="submit">Зарегистрироваться</button>
            </form>
        </div>
        <div class="col right-aside"></div>
    </div>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script>
        $('#select-id').on('change', function(e){
            console.log(this.value);
            $.post("/get_doctor.php", { id: this.value }, function(data) {
                data = JSON.parse(data);
                let doctor = $('#doctors');
                doctor.show();
                if (data.length > 0){
                    doctor.empty().append(data.map(function(obj){
                        return '<option value="'+obj.doctor_id+'">'+ obj.fio +'</option>'
                    }));
                } else {
                    doctor.find('option').remove();
                }
            });
        });
    </script>
    <style>
        .hidden{
            display: none;
        }
    </style>
<?php endif?>
