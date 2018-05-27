  <nav class="nav">
      <ul class="nav__list container">
          <?php for ($i = 0; $i < count($categories); $i++) { ?>
              <li class="nav__item">
                  <a href="all-lots.html"> <?php echo($categories[$i]["category"]) ?> </a>
              </li>
          <?php } ?>
      </ul>
  </nav>
  <form class="form container <?php if ($errors) { print('form--invalid');} ?>" action="sign-up.php" method="post" enctype="multipart/form-data">
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?php if ($errors["email"]) { print('form__item--invalid');} ?>">
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" >
        <?php if ($errors["email"]) { print('<span class="form__error">Введите e-mail</span>');} ?>
        <?php if ($errors["oldUser"]) { print('<span class="form__error">Пользователь с таким именем уже зарегестрирован</span>');} ?>
    </div>
    <div class="form__item">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" >
        <?php if ($errors["password"]) { print('<span class="form__error">Введите пароль</span>');} ?>
    </div>
    <div class="form__item">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="userName" placeholder="Введите имя" >
        <?php if ($errors["userName"]) { print('<span class="form__error">Введите имя</span>');} ?>
    </div>
    <div class="form__item">
      <label for="message">Контактные данные*</label>
      <textarea id="message" name="contact" placeholder="Напишите как с вами связаться" ></textarea>
        <?php if ($errors["contact"]) { print('<span class="form__error">Напишите как с вами связаться</span>');} ?>
    </div>
    <div class="form__item form__item--file form__item--last">
      <label>Аватар</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
      <?php if ($errors) { print('<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>');} ?>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
  </form>

