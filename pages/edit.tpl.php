<div class="row">
    <div class="col-2 left-aside"></div>
    <div class="col">
        <div class="py-4 text-center">
            <h2>Редактируем, <?php echo $person['fio']?></h2>
        </div>
        <form action="visit.php" method="post">
            <div class="mb-3">
                <label for="related_hospital" class="form-label">Поликлиника</label>
                <input type="text" class="form-control" id="related_hospital" name="related_hospital" placeholder="Центральная поликлиника" value="" required="">
            </div>
            <div class="mb-3">
                <label for="inn" class="form-label">ИНН</label>
                <input type="text" class="form-control" id="inn" name="inn" placeholder="№ ИНН" value="" required="">
            </div>
            <div class="mb-3">
                <select name="alive" class="form-select">
                    <option value="1">Жив</option>
                    <option value="0">Мертв</option>
                </select>
            </div>
            <div class="mb-3">
                <select name="healthy" class="form-select">
                    <option value="0">Не здоров</option>
                    <option value="1">Здоров</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="datetimepicker" class="form-label">Время посещения</label>
                <input type="text" class="form-control" id="datetimepicker" name="datetime" value="" required="" autocomplete="off" placeholder="<?php echo date('Y-m-d H:i')?>">
            </div>
            <input type="hidden" class="form-control" name="person_id" value="<?php echo $person_id?>">
            <input type="hidden" class="form-control" name="doctor_id" value="<?php echo $doctor_id?>">
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
        $('#datetimepicker').datetimepicker({
            format:'Y-m-d H:i',
            lang:'ru',
        });
    });
</script>
