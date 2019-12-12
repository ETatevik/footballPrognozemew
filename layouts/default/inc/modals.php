<!--start  modals -->
<!-- Login  modal -->
<div class="modal" id="login-modal">
    <div class="modal-body">
        <button type="button" class="btn close-modal">
            <svg id="Group_293" data-name="Group 293" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                <path id="Path_8983" data-name="Path 8983" d="M11,0A11,11,0,1,0,22,11,11.012,11.012,0,0,0,11,0Zm0,20.114A9.114,9.114,0,1,1,20.114,11,9.125,9.125,0,0,1,11,20.114Z" fill="#f30d31" />
                <path id="Path_8984" data-name="Path 8984" d="M60.188,51.508a.962.962,0,0,0-1.36,0l-2.982,2.983-2.982-2.983a.962.962,0,0,0-1.36,1.36l2.982,2.983L51.5,58.834a.962.962,0,1,0,1.36,1.36l2.982-2.983,2.982,2.983a.962.962,0,1,0,1.36-1.36l-2.982-2.983,2.982-2.983A.962.962,0,0,0,60.188,51.508Z" transform="translate(-44.846 -44.85)" fill="#f30d31" />
            </svg>
        </button>
        <div class="modal-container">
            <h3>Вход</h3>
            <form action="user.html" autocomplete="off">
                <div class="form-col">
                    <label for="loginMD">
                        <span>Логин</span>
                        <input type="text" id="loginMD">
                    </label>
                    <div class="invalid">* Error</div>
                    <!--input class error-->
                </div>
                <div class="form-col">
                    <label for="passMD">
                        <span>Пароль</span>
                        <input type="password" id="passMD">
                    </label>
                    <div class="invalid">* Error</div>
                    <!--input class error-->
                </div>
                <div class="form-col btn-submit"><button type="submit" class="btn">Войти</button></div>
                <div class="form-col btn-link"><button type="button" class="btn forgotPassword">ЗАБЫЛИЫ ПАРОЛЬ?</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Registration  modal-->
<div class="modal" id="registration-modal">
    <div class="modal-body">
        <button type="button" class="btn close-modal">
            <svg id="Group_293" data-name="Group 293" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                <path id="Path_8983" data-name="Path 8983" d="M11,0A11,11,0,1,0,22,11,11.012,11.012,0,0,0,11,0Zm0,20.114A9.114,9.114,0,1,1,20.114,11,9.125,9.125,0,0,1,11,20.114Z" fill="#f30d31" />
                <path id="Path_8984" data-name="Path 8984" d="M60.188,51.508a.962.962,0,0,0-1.36,0l-2.982,2.983-2.982-2.983a.962.962,0,0,0-1.36,1.36l2.982,2.983L51.5,58.834a.962.962,0,1,0,1.36,1.36l2.982-2.983,2.982,2.983a.962.962,0,1,0,1.36-1.36l-2.982-2.983,2.982-2.983A.962.962,0,0,0,60.188,51.508Z" transform="translate(-44.846 -44.85)" fill="#f30d31" />
            </svg>
        </button>
        <div class="modal-container">
            <h3>Регистрация</h3>
            <form action="index.html" autocomplete="off">
                <div class="form-col">
                    <label for="nameMD">
                        <span>Имя</span>
                        <input type="text" id="nameMD">
                    </label>
                    <div class="invalid">* Error</div>
                    <!--input class error-->
                </div>
                <div class="form-col">
                    <label for="regEmailMD">
                        <span>Эл. Почта</span>
                        <input type="email" id="regEmailMD">
                    </label>
                    <div class="invalid">* Error</div>
                    <!--input class error-->
                </div>
                <div class="form-col">
                    <div class="select-form">
                        <div class="show-select">
                            <span class="choose-radio">Выбрать тариф</span>
                        </div>
                        <div class="select-body">
                            <label for="tarif-start">
                                <input name="chooseTarif" type="radio" value="2000" id="tarif-start">
                                <span class="select-text">
                                    Начинающий –
                                    <b>7 дней</b>
                                    <span class="red-price">2000 ₽</span>
                                </span>
                            </label>
                            <label for="tarif-optim">
                                <input name="chooseTarif" type="radio" value="3500" id="tarif-optim">
                                <span class="select-text">
                                    Оптимальный –
                                    <b>14 дней</b>
                                    <span class="red-price">3500 ₽</span>
                                </span>
                            </label>
                            <label for="tarif-prew">
                                <input name="chooseTarif" type="radio" value="7000" id="tarif-prew">
                                <span class="select-text">
                                    Продвинутый –
                                    <b>30 дней</b>
                                    <span class="red-price">7000 ₽</span>
                                </span>
                            </label>
                            <label for="tarif-activeUser">
                                <input name="chooseTarif" type="radio" value="9000" id="tarif-activeUser">
                                <span class="select-text">
                                    Активный участник –
                                    <b>180 дней</b>
                                    <span class="red-price">9000 ₽</span>
                                </span>
                            </label>
                        </div>
                        <div class="invalid">* Error</div>
                        <!--input class error-->
                    </div>
                </div>
                <div class="form-col">
                    <label for="regPassMD">
                        <span>Пароль</span>
                        <input type="password" id="regPassMD">
                    </label>
                    <div class="invalid">* Error</div>
                    <!--input class error-->
                </div>
                <div class="form-col">
                    <label for="regPassConfMD">
                        <span>Повторите пароль</span>
                        <input type="password" id="regPassConfMD" name="pass">
                    </label>
                    <div class="invalid">* Error</div>
                    <!--input class error-->
                </div>
                <div class="form-col">
                    <label for="personalDataMD" class="checkPesData">
                        <input type="checkbox" id="personalDataMD">
                        <span class="checkmark"></span>
                        Даю согласие <a href="#">на обработку персональных данных</a>
                    </label>
                    <div class="invalid">* Error</div>
                    <!--input class error-->
                </div>
                <div class="form-col btn-submit">
                    <button type="submit" class="btn">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Password recovery modal -->
<div class="modal" id="passwordRecovery-modal">
    <div class="modal-body">
        <button type="button" class="btn close-modal">
            <svg id="Group_293" data-name="Group 293" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                <path id="Path_8983" data-name="Path 8983" d="M11,0A11,11,0,1,0,22,11,11.012,11.012,0,0,0,11,0Zm0,20.114A9.114,9.114,0,1,1,20.114,11,9.125,9.125,0,0,1,11,20.114Z" fill="#f30d31" />
                <path id="Path_8984" data-name="Path 8984" d="M60.188,51.508a.962.962,0,0,0-1.36,0l-2.982,2.983-2.982-2.983a.962.962,0,0,0-1.36,1.36l2.982,2.983L51.5,58.834a.962.962,0,1,0,1.36,1.36l2.982-2.983,2.982,2.983a.962.962,0,1,0,1.36-1.36l-2.982-2.983,2.982-2.983A.962.962,0,0,0,60.188,51.508Z" transform="translate(-44.846 -44.85)" fill="#f30d31" />
            </svg>
        </button>
        <div class="modal-container">
            <h3>Введите E-mail для восстановления пароля</h3>
            <form action="./#newPassword-modal" autocomplete="off">
                <div class="form-col">
                    <label for="mailMD">
                        <span>Введите E-mail</span>
                        <input type="email" id="mailMD">
                    </label>
                    <div class="invalid">* Error</div>
                    <!--input class error-->
                </div>
                <div class="form-col btn-submit">
                    <button type="submit" class="btn">Восстановить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- New password modal -->
<div class="modal" id="newPassword-modal">
    <div class="modal-body">
        <button type="button" class="btn close-modal">
            <svg id="Group_293" data-name="Group 293" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                <path id="Path_8983" data-name="Path 8983" d="M11,0A11,11,0,1,0,22,11,11.012,11.012,0,0,0,11,0Zm0,20.114A9.114,9.114,0,1,1,20.114,11,9.125,9.125,0,0,1,11,20.114Z" fill="#f30d31" />
                <path id="Path_8984" data-name="Path 8984" d="M60.188,51.508a.962.962,0,0,0-1.36,0l-2.982,2.983-2.982-2.983a.962.962,0,0,0-1.36,1.36l2.982,2.983L51.5,58.834a.962.962,0,1,0,1.36,1.36l2.982-2.983,2.982,2.983a.962.962,0,1,0,1.36-1.36l-2.982-2.983,2.982-2.983A.962.962,0,0,0,60.188,51.508Z" transform="translate(-44.846 -44.85)" fill="#f30d31" />
            </svg>
        </button>
        <div class="modal-container">
            <h3>Введите новый пароль</h3>
            <form action="index.html" autocomplete="off">
                <div class="form-col">
                    <label for="passNewMD">
                        <span>Новый пароль</span>
                        <input type="password" id="passNewMD">
                        <!--if change id, please change that in modal.js too!-->
                    </label>
                    <div class="invalid">* Error</div>
                    <!--input class error-->
                </div>
                <div class="form-col">
                    <label for="confirmPassMD">
                        <span>Повторите пароль</span>
                        <input type="password" id="confirmPassMD">
                        <!--if change id, please change that in modal.js too!-->
                    </label>
                    <div class="invalid">* Error</div>
                    <!--input class error-->
                </div>
                <div class="form-col btn-submit"><button type="submit" class="btn">Восстановить</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Check your email modal -->
<div class="modal" id="checkMail-modal">
    <div class="modal-body">
        <button type="button" class="btn close-modal">
            <svg id="Group_293" data-name="Group 293" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                <path id="Path_8983" data-name="Path 8983" d="M11,0A11,11,0,1,0,22,11,11.012,11.012,0,0,0,11,0Zm0,20.114A9.114,9.114,0,1,1,20.114,11,9.125,9.125,0,0,1,11,20.114Z" fill="#f30d31" />
                <path id="Path_8984" data-name="Path 8984" d="M60.188,51.508a.962.962,0,0,0-1.36,0l-2.982,2.983-2.982-2.983a.962.962,0,0,0-1.36,1.36l2.982,2.983L51.5,58.834a.962.962,0,1,0,1.36,1.36l2.982-2.983,2.982,2.983a.962.962,0,1,0,1.36-1.36l-2.982-2.983,2.982-2.983A.962.962,0,0,0,60.188,51.508Z" transform="translate(-44.846 -44.85)" fill="#f30d31" />
            </svg>
        </button>
        <div class="modal-container">
            <h3>Проверьте ваш E-mail</h3>
            <div class="box-modal">
                <svg id="Group_142" data-name="Group 142" xmlns="http://www.w3.org/2000/svg" width="107" height="107" viewBox="0 0 13.304 13.304">
                    <ellipse id="Ellipse_3" data-name="Ellipse 3" cx="6.652" cy="6.652" rx="6.652" ry="6.652" fill="#2ab700" />
                    <path id="Path_132" data-name="Path 132" d="M2.361,64.552a.519.519,0,0,1-.368-.152L.153,62.56a.52.52,0,1,1,.736-.736L2.361,63.3l3.312-3.312a.52.52,0,0,1,.736.736L2.729,64.4A.519.519,0,0,1,2.361,64.552Z" transform="translate(3.501 -55.63)" fill="#fff" />
                </svg>
            </div>
            <div class="btn-close"><button type="button" class="btn">Закрыть</button></div>
        </div>
    </div>
</div>

<!-- Password successfull change -->
<div class="modal" id="passwordSuccessChange-modal">
    <div class="modal-body">
        <button type="button" class="btn close-modal">
            <svg id="Group_293" data-name="Group 293" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                <path id="Path_8983" data-name="Path 8983" d="M11,0A11,11,0,1,0,22,11,11.012,11.012,0,0,0,11,0Zm0,20.114A9.114,9.114,0,1,1,20.114,11,9.125,9.125,0,0,1,11,20.114Z" fill="#f30d31" />
                <path id="Path_8984" data-name="Path 8984" d="M60.188,51.508a.962.962,0,0,0-1.36,0l-2.982,2.983-2.982-2.983a.962.962,0,0,0-1.36,1.36l2.982,2.983L51.5,58.834a.962.962,0,1,0,1.36,1.36l2.982-2.983,2.982,2.983a.962.962,0,1,0,1.36-1.36l-2.982-2.983,2.982-2.983A.962.962,0,0,0,60.188,51.508Z" transform="translate(-44.846 -44.85)" fill="#f30d31" />
            </svg>
        </button>
        <div class="modal-container">
            <h3>Ваш пароль удачно изменен</h3>
            <div class="box-modal">
                <svg id="Group_142" data-name="Group 142" xmlns="http://www.w3.org/2000/svg" width="107" height="107" viewBox="0 0 13.304 13.304">
                    <ellipse id="Ellipse_3" data-name="Ellipse 3" cx="6.652" cy="6.652" rx="6.652" ry="6.652" fill="#2ab700" />
                    <path id="Path_132" data-name="Path 132" d="M2.361,64.552a.519.519,0,0,1-.368-.152L.153,62.56a.52.52,0,1,1,.736-.736L2.361,63.3l3.312-3.312a.52.52,0,0,1,.736.736L2.729,64.4A.519.519,0,0,1,2.361,64.552Z" transform="translate(3.501 -55.63)" fill="#fff" />
                </svg>
            </div>
            <div class="btn-close"><button type="button" class="btn">Закрыть</button></div>
        </div>
    </div>
</div>

<!-- available by subscription modal -->
<div class="modal" id="subscription-modal">
    <div class="modal-body">
        <button type="button" class="btn close-modal">
            <svg id="Group_293" data-name="Group 293" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                <path id="Path_8983" data-name="Path 8983" d="M11,0A11,11,0,1,0,22,11,11.012,11.012,0,0,0,11,0Zm0,20.114A9.114,9.114,0,1,1,20.114,11,9.125,9.125,0,0,1,11,20.114Z" fill="#f30d31" />
                <path id="Path_8984" data-name="Path 8984" d="M60.188,51.508a.962.962,0,0,0-1.36,0l-2.982,2.983-2.982-2.983a.962.962,0,0,0-1.36,1.36l2.982,2.983L51.5,58.834a.962.962,0,1,0,1.36,1.36l2.982-2.983,2.982,2.983a.962.962,0,1,0,1.36-1.36l-2.982-2.983,2.982-2.983A.962.962,0,0,0,60.188,51.508Z" transform="translate(-44.846 -44.85)" fill="#f30d31" />
            </svg>
        </button>
        <div class="modal-container">
            <h3>Прогноз доступен по подписке</h3>
            <div class="box-modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="117.195" height="84" viewBox="0 0 117.195 84">
                    <path id="Path_8980" data-name="Path 8980" d="M87.742,110.1v-9.447c0-21.247,32.331-21.247,32.331,0V110.1c3.158,0,5.881,1.61,5.881,5.1v1.711c0,27.426-44.094,27.426-44.094,0V115.2C81.861,111.716,84.584,110.1,87.742,110.1ZM23.94,53.48h78.136a15.227,15.227,0,0,1,15.184,15.184V86.691c-8.342-7.544-23.433-6.368-29.667,3.521H13.539v26.305a10.432,10.432,0,0,0,10.4,10.4H80.926A21.081,21.081,0,0,0,83.9,131.7H23.944A15.227,15.227,0,0,1,8.76,116.517V68.664A15.224,15.224,0,0,1,23.944,53.48Zm-10.4,17.255h98.938V68.664a10.429,10.429,0,0,0-10.4-10.4H23.94a10.429,10.429,0,0,0-10.4,10.4v2.071Zm98.938,36.4V99.815c.022.275.033.553.033.839v6.479Zm-5.688,10.839a3.968,3.968,0,0,1-1.725,6.486v2.672a1.154,1.154,0,0,1-2.308,0v-2.679a3.951,3.951,0,1,1,4.037-6.483ZM92.332,110.1H115.48v-9.447c0-15.31-23.147-15.31-23.147,0Z" transform="translate(-8.76 -53.48)" fill="gray" fill-rule="evenodd" />
                </svg>
            </div>
            <div class="signNotActive signUpActive"><button id="signUpSub" type="button" class="btn">РЕГИСТРАЦИЯ</button></div>
            <div class="signNotActive"><button id="signInSub" type="button" class="btn">ВХОД</button></div>
        </div>
    </div>
</div>