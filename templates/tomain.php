



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
        <h2 class="content__main-heading">Задача добавлена</h2>
        <a class="main-header__side-item button open-modal" href="index.php">На главную</a>
    </main>
</div>