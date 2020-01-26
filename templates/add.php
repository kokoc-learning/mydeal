
<?php

if (isset($_POST['name']) && isset($_POST['project']) && isset($_POST['date'])){
  $formNameValue = $_POST['name'];
  $formProjectValue = $_POST['project'];
  $formDateValue = $_POST['date'];
  $formFileName = $_POST['file'];
  // $formFileTmpPath = $_FILES['file'];
  print_r(count($_FILES));
  // echo "<br> $formFileTmpPath";
}
  
?>


<div class="content">
    <section class="content__side">
        <h2 class="content__side-heading">Проекты</h2>

        <nav class="main-navigation">
            <ul class="main-navigation__list">
            <?php
                foreach ($projectList as $project) {
                    
                    echo '
                    <li class="main-navigation__list-item';

                    // делаем активным пункт списка проектов
                    if (isset($_GET['projectid']) && $_GET['projectid'] === $project['id']){
                        echo ' main-navigation__list-item--active';
                    }

                    echo '">
                        <a class="main-navigation__list-item-link" href="index.php?projectid='.$project['id'].'">'.$project['name'].'</a>
                        <span class="main-navigation__list-item-count">'.projectsInTaskListCount($taskList, $project['name']).'</span>
                    </li>
                    ';
                }
            ?>
                
            </ul>
        </nav>

        <a class="button button--transparent button--plus content__side-button"
        href="pages/form-project.html" target="project_add">Добавить проект</a>
    </section>

    <main class="content__main">
    <h2 class="content__main-heading">Добавление задачи</h2>

<form class="form"  action="add.php" method="post" autocomplete="off">
  <div class="form__row">
    <label class="form__label" for="name">Название <sup>*</sup></label>

    <input class="form__input" type="text" name="name" id="name" value="" placeholder="Введите название">
  </div>

  <div class="form__row">
    <label class="form__label" for="project">Проект <sup>*</sup></label>

    <select class="form__input form__input--select" name="project" id="project">

      <?php
        foreach ($projectList as $value) {
          echo ' <option value="'.$value['name'].'">'.$value['name'].'</option>';
        }
      ?>
   
    </select>
  </div>

  <div class="form__row">
    <label class="form__label" for="date">Дата выполнения</label>

    <input class="form__input form__input--date" type="text" name="date" id="date" value="" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
  </div>

  <div class="form__row">
    <label class="form__label" for="file">Файл</label>

    <div class="form__input-file">
      <input class="visually-hidden" type="file" name="file" id="file" value="">

      <label class="button button--transparent" for="file">
        <span>Выберите файл</span>
      </label>
    </div>
  </div>

  <div class="form__row form__row--controls">
    <input class="button" type="submit" name="" value="Добавить">
  </div>
</form>
            </main>
</div>