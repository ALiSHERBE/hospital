<div class="row">
    <div class="col-2 left-aside"></div>
    <div class="col">
        <div class="py-4 text-center">
            <h2>Редактируем, <?php echo $person['fio']?></h2>
        </div>
        <form action="visits.php" method="post">
            <div class="mb-3">
                <label for="prescription" class="form-label">Рецепт</label>
                <textarea class="form-control" id="prescription" name="prescription" placeholder="" required=""><?php echo $visit['prescription']?></textarea>
            </div>
            <div class="mb-3">
                <label for="advice" class="form-label">Рекомендации</label>
                <textarea class="form-control" id="advice" name="advice" placeholder="" required=""><?php echo $visit['advice']?></textarea>
            </div>
            <div class="mb-3">
                <label for="diagnos" class="form-label">Диагноз</label>
                <textarea class="form-control" id="diagnos" name="diagnos" placeholder="" required=""><?php echo $visit['diagnos']?></textarea>
            </div>
            <div class="mb-3">
                <label for="complains" class="form-label">Жалобы</label>
                <textarea class="form-control" id="complains" name="complains" placeholder="" required=""><?php echo $visit['complains']?></textarea>
            </div>

            <div class="mb-3">
                <label for="next_visit" class="form-label">Время след. посещения</label>
                <input type="text" class="form-control" id="next_visit" name="next_visit" value="<?php echo $visit['next_visit']?>" required="" placeholder="<?php echo date('Y-m-d H:i')?>">
            </div>
            <div class="mb-3">
                <select name="healthy" class="form-select">
                    <option value="0" <?php if ($patient['healthy'] == 0):?>selected<?php endif?>>Не здоров</option>
                    <option value="1" <?php if ($patient['healthy'] == 1):?>selected<?php endif?>>Здоров</option>
                </select>
            </div>
            <input type="hidden" class="form-control" name="person_id" value="<?php echo $person_id?>">
            <input type="hidden" class="form-control" name="doctor_id" value="<?php echo $doctor_id?>">
            <input type="hidden" class="form-control" name="id_visits" value="<?php echo $id_visits?>">
            <hr class="my-4">
            <button name="visit" class="w-100 btn btn-primary btn-lg" type="submit">Подтвердить</button>
        </form>
    </div>
    <div class="col-2 right-aside"></div>
</div>
<link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.min.css"/>
<script src="/js/jquery-3.6.0.min.js"></script>
<script src="/js/jquery.datetimepicker.full.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#next_visit').datetimepicker({
            format:'Y-m-d H:i',
            lang:'ru',
        });
    });
</script>
