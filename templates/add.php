<nav class="nav">
    <ul class="nav__list container">
        <?php for ($i = 0; $i < count($categories); $i++) { ?>
            <li class="nav__item">
                <a href="all-lots.html"> <?php echo($categories[$i]["category"]) ?> </a>
            </li>
        <?php } ?>
    </ul>
</nav>
  <form class="form form--add-lot container form--invalid" action="add.php" method="post" enctype="multipart/form-data">
      <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">

      <div class="form__item <?php if ($errors["name"]) { print('form__item--invalid');} ?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="name" placeholder="Введите наименование лота" value = "<?php if (isset($item['name'])) {print($item['name']);} ?>">
          <?php if ($errors["name"]) { print('<span class="form__error">Введите наименование лота</span>');} ?>

      </div>

      <div class="form__item">
        <label for="category">Категория</label>
        <select id="category" name="category" >
          <option>Выберите категорию</option>
            <?php for ($i = 0; $i < count($categories); $i++) { ?>
                <option>
                     <?php echo($categories[$i]["category"]) ?>
                </option>
            <?php } ?>
        </select>
          <?php if ($errors["category"]) {
              print('<span class="form__error">Выберите категорию</span>'); }
          ?>
      </div>
    </div>
    <div class="form__item form__item--wide">
      <label for="message">Описание</label>
      <textarea id="message" name="description" placeholder="Напишите описание лота">
          <?php if (isset($item['description'])) {print($item['description']);} ?>
      </textarea>
        <?php if ($errors["description"]) { print('<span class="form__error">Напишите описание лота</span>');} ?>
    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="itemImg" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
        <?php if ($errors["file"]) { print('<span class="form__error">' . $errors["file"] . '</span>');} ?>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate"  type="number" name="startPrice" placeholder="0" value = "<?php if (isset($item['startPrice'])) {print($item['startPrice']);} ?>">
          <?php if ($errors["startPrice"] == 1) { print('<span class="form__error">Введите начальную цену</span>');} ?>
          <?php if ($errors["startPrice"] == 2) { print('<span class="form__error">Введите число</span>');} ?>

      </div>
      <div class="form__item form__item--small">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="betStep" placeholder="0" value = "<?php if (isset($item['betStep'])) {print($item['betStep']);} ?>">
          <?php if ($errors["betStep"] == 1) { print('<span class="form__error">Введите шаг ставки</span>');} ?>
          <?php if ($errors["betStep"] == 2) { print('<span class="form__error">Введите число</span>');} ?>

      </div>
      <div class="form__item">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="dateOfEnd" value = "<?php if (isset($item['dateOfEnd'])) {print($item['dateOfEnd']);} ?>">
          <?php if ($errors["dateOfEnd"]) { print('<span class="form__error">Введите дату завершения торгов</span>');} ?>

      </div>
    </div>
      <?php if (isset($errors)) { print('<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>');} ?>

    <button type="submit" class="button">Добавить лот</button>
  </form>
