<div class="row">
    <div class="col-2 left-aside"></div>
    <div class="col">
        <div class="py-4 text-center">
            <h2>Добро пожаловать, <?php echo $doctor['fio']?></h2>
        </div>
        <table class="table caption-top">
            <caption class="">Список пациентов которым необходимо назначить время посещения</caption>
            <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ф.И.О</th>
                <th scope="col">Паспорт</th>
                <th scope="col">Адрес</th>
                <th scope="col">Пол</th>
                <th scope="col">Ред.</th>
            </tr>
            </thead>
            <tbody>
            <?php if (count($patients) > 0):?>
	            <?foreach($patients as $key => $patient):?>
                    <tr>
                        <td scope="row"><?php echo $patient['person_id']?></td>
                        <td><?php echo $patient['fio']?></td>
                        <td><?php echo $patient['passport']?></td>
                        <td><?php echo $patient['address']?></td>
                        <td><?php echo $gender[$patient['gender']]?></td>
                        <td>
                            <div>
                                <a class="p-2 d-block text-center" href="/edit.php?person_id=<?php echo $patient['person_id']?>&doctor_id=<?php echo $doctor_id?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
	            <?endforeach;?>
            <?php else:?>
                <tr>
                    <td colspan="5">Список пуст</td>
                </tr>
            <?php endif?>
            </tbody>
        </table>
        <table class="table caption-top">
            <caption class="">Список пациентов с назначенным временем посещения</caption>
            <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ф.И.О</th>
                <th scope="col">Назначенное время</th>
                <th scope="col">След. время</th>
                <th scope="col">Ред.</th>
            </tr>
            </thead>
            <tbody>
            <?php if (count($visits) > 0):?>
	            <?foreach($visits as $key => $visit):?>
                    <tr>
                        <td scope="row"><?php echo $visit['id_visits']?></td>
                        <td><?php echo $visit['fio']?></td>
                        <td><?php echo $visit['date_of_visit']?></td>
                        <td><?php echo $visit['next_visit']?></td>
                        <td>
                            <div>
                                <a class="p-2 d-block text-center"
                                   href="/diagnos.php?person_id=<?php echo $visit['person_id']?>&doctor_id=<?php echo $doctor_id?>&id_visits=<?php echo $visit['id_visits']?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
	            <?endforeach;?>
            <?php else:?>
                <tr>
                    <td colspan="5">Список пуст</td>
                </tr>
            <?php endif?>
            </tbody>
        </table>
    </div>
    <div class="col-2 right-aside"></div>
</div>

<script>

</script>
