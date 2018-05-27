<nav class="nav">
    <ul class="nav__list container">
        <?php for ($i = 0; $i < count($categories); $i++) { ?>
            <li class="nav__item">
                <a href="all-lots.html"> <?php echo($categories[$i]["category"]) ?> </a>
            </li>
        <?php } ?>
    </ul>
</nav>
  <form class="form container <?php if ($errors) { print('form--invalid');} ?>" action="login.php" method="post"> <!--  -->
    <h2>Вход</h2>
    <div class="form__item<?php if ($errors['email']) { print('form--invalid');} ?>"> <!--  -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" >
        <?php if ($errors['email']) { print('<span class="form__error">Введите e-mail</span>');} ?>
    </div>
    <div class="form__item form__item--last <?php if ($errors['password']) { print('form--invalid');} ?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" >
        <?php if ($errors['password']) { print('<span class="form__error">Введите пароль</span>');} ?>
    </div>
    <button type="submit" class="button">Войти</button>
  </form>

