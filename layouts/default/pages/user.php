<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PC Football Store</title>
        <?php include_once('layouts/default/inc/head.php');?>
    </head>
    <body>
        <?php include_once('layouts/default/inc/nav.php');?>

        <!-- start page content -->
        <article class="indexContentBody row">
            <?php 
            // get news
            $news = $cnt->getDataUser("f_news", "WHERE `status`='1'", "all");
            // check news
            if($news) {
                ?>
                <section id="headerNews">
                    <?php include('left_side.php')?>
                </section>
            <?php }?>
            <section id="pageContent">
                <div class="container">
                    <!-- nav-node-list -->
                    <div id="nav-node-list">
                        <ul class="row">
                            <li>
                                <a href="/">Главная</a>
                            </li>
                            <li>
                                <span>Личный кабинет</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Personal Area box --> 
                    <div id="personalAreaBox">
                        <div id="userArea-header">
                            <div class="row">
                                <div class="col-pers">
                                    <h1>Личный кабинет</h1>
                                </div>
                                <div class="personalAre-navbar">
                                    <div class="mobile-persNavbar">
                                        <span class="choose-active"></span>
                                        <div class="menu-tree-mb">
                                            <button type="button" class="btn">
                                                <span class="tree-btn-is"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <ul class="row personalAre-navbar-body">
                                        <li><a class="active" href="user.html">Актуальные прогнозы</a></li>
                                        <li><a href="#">Архив прогнозов</a></li>
                                        <li><a href="userSubscription.html">Подписка</a></li>
                                        <li><a href="userSetting.html">Настройки аккаунта</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- alert block start -->
                    <div class="alert alert-warring show">
                        <div class="row">
                            <div class="col-alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31.82" height="31.82" viewBox="0 0 11.376 11.376">
                                    <path id="data_image_svg_xml_" data-name="data_image_svg+xml;…" d="M12.188,17.876A5.688,5.688,0,1,0,6.5,12.188,5.684,5.684,0,0,0,12.188,17.876Zm.706-9.611a1.085,1.085,0,1,1-1.085,1.085A1.1,1.1,0,0,1,12.894,8.265ZM11.273,11.9c-.157-.157-.366-.131-.588.013a.262.262,0,0,1-.34-.052.248.248,0,0,1,.052-.34,2.375,2.375,0,0,1,1.674-.471A1.2,1.2,0,0,1,13.221,12.2a1.509,1.509,0,0,1-.118.575l-.955,1.9a.471.471,0,0,0,0,.575c.157.157.366.131.588-.013a.262.262,0,0,1,.34.052.248.248,0,0,1-.052.34,2.375,2.375,0,0,1-1.674.471A1.2,1.2,0,0,1,10.2,14.947a1.509,1.509,0,0,1,.118-.575l.955-1.9A.49.49,0,0,0,11.273,11.9Z" transform="translate(-6.5 -6.5)" fill="#fff"/>
                                </svg>
                            </div>
                            <div class="col-alert">
                                <p>Требуется подтвердить адрес электронной почты</p>
                            </div>
                            <div class="col-alert">
                                <button class="btn alert-close" type="button">
                                    <span>ЗАКРЫТЬ</span>
                                    <span class="close-icon">
                                        <svg id="Group_293" data-name="Group 293" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                                            <path id="Path_8983" data-name="Path 8983" d="M11,0A11,11,0,1,0,22,11,11.012,11.012,0,0,0,11,0Zm0,20.114A9.114,9.114,0,1,1,20.114,11,9.125,9.125,0,0,1,11,20.114Z" fill="#ffffff"/>
                                            <path id="Path_8984" data-name="Path 8984" d="M60.188,51.508a.962.962,0,0,0-1.36,0l-2.982,2.983-2.982-2.983a.962.962,0,0,0-1.36,1.36l2.982,2.983L51.5,58.834a.962.962,0,1,0,1.36,1.36l2.982-2.983,2.982,2.983a.962.962,0,1,0,1.36-1.36l-2.982-2.983,2.982-2.983A.962.962,0,0,0,60.188,51.508Z" transform="translate(-44.846 -44.85)" fill="#ffffff"/>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-success show">
                        <div class="row">
                            <div class="col-alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="27.99" height="21" viewBox="0 0 27.99 21">
                                    <path id="Path_8975" data-name="Path 8975" d="M51.987,984.357a1.747,1.747,0,0,0-1.02.528c-5.834,5.846-10.2,10.671-15.768,16.314l-6.336-5.353a1.751,1.751,0,0,0-2.258,2.677l7.574,6.409a1.748,1.748,0,0,0,2.367-.109c6.251-6.264,10.718-11.287,16.9-17.479a1.748,1.748,0,0,0-1.457-2.986Z" transform="translate(-25.984 -984.34)" fill="#fff"/>
                                </svg>
                            </div>
                            <div class="col-alert">
                                <p>Ваша подписка успешно активировано</p>
                            </div>
                            <div class="col-alert">
                                <button class="btn alert-close" type="button">
                                    <span>ЗАКРЫТЬ</span>
                                    <span class="close-icon">
                                        <svg id="Group_293" data-name="Group 293" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                                            <path id="Path_8983" data-name="Path 8983" d="M11,0A11,11,0,1,0,22,11,11.012,11.012,0,0,0,11,0Zm0,20.114A9.114,9.114,0,1,1,20.114,11,9.125,9.125,0,0,1,11,20.114Z" fill="#ffffff"/>
                                            <path id="Path_8984" data-name="Path 8984" d="M60.188,51.508a.962.962,0,0,0-1.36,0l-2.982,2.983-2.982-2.983a.962.962,0,0,0-1.36,1.36l2.982,2.983L51.5,58.834a.962.962,0,1,0,1.36,1.36l2.982-2.983,2.982,2.983a.962.962,0,1,0,1.36-1.36l-2.982-2.983,2.982-2.983A.962.962,0,0,0,60.188,51.508Z" transform="translate(-44.846 -44.85)" fill="#ffffff"/>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-danger">
                        <div class="row">
                            <div class="col-alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28.235" height="28.235" viewBox="0 0 28.235 28.235">
                                    <path id="Path_8981" data-name="Path 8981" d="M24.1,4.13a14.124,14.124,0,1,0,0,19.975A14.14,14.14,0,0,0,24.1,4.13ZM19.687,19.687a1.086,1.086,0,0,1-1.536,0l-4.034-4.034L9.892,19.879a1.086,1.086,0,0,1-1.536-1.536l4.225-4.225L8.548,10.084a1.086,1.086,0,0,1,1.536-1.536l4.033,4.034L17.959,8.74a1.086,1.086,0,1,1,1.536,1.536l-3.841,3.841,4.034,4.034A1.086,1.086,0,0,1,19.687,19.687Z" transform="translate(0 0)" fill="#fff"/>
                                </svg>
                            </div>
                            <div class="col-alert">
                                <p>Доступ закрыт (требуется продлить тариф)</p>
                            </div>
                            <div class="col-alert">
                                <button class="btn alert-go" type="button">
                                    <span>продлить</span>
                                    <span class="close-icon">
                                        <svg id="Group_293" data-name="Group 293" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                                            <path id="Path_8983" data-name="Path 8983" d="M11,0A11,11,0,1,0,22,11,11.012,11.012,0,0,0,11,0Zm0,20.114A9.114,9.114,0,1,1,20.114,11,9.125,9.125,0,0,1,11,20.114Z" fill="#ffffff"/>
                                            <path id="Path_8984" data-name="Path 8984" d="M60.188,51.508a.962.962,0,0,0-1.36,0l-2.982,2.983-2.982-2.983a.962.962,0,0,0-1.36,1.36l2.982,2.983L51.5,58.834a.962.962,0,1,0,1.36,1.36l2.982-2.983,2.982,2.983a.962.962,0,1,0,1.36-1.36l-2.982-2.983,2.982-2.983A.962.962,0,0,0,60.188,51.508Z" transform="translate(-44.846 -44.85)" fill="#ffffff"/>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- alert block end -->


                    <!-- start liga content  -->
                    <div id="ligaFootball">
                        <div class="modal-danger-close">
                            <div class="row">
                                <div class="col">
                                    <h2>Прогнозы доступны по подписке</h2>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="117.195" height="84" viewBox="0 0 117.195 84">
                                        <path id="Path_8980" data-name="Path 8980" d="M87.742,110.1v-9.447c0-21.247,32.331-21.247,32.331,0V110.1c3.158,0,5.881,1.61,5.881,5.1v1.711c0,27.426-44.094,27.426-44.094,0V115.2C81.861,111.716,84.584,110.1,87.742,110.1ZM23.94,53.48h78.136a15.227,15.227,0,0,1,15.184,15.184V86.691c-8.342-7.544-23.433-6.368-29.667,3.521H13.539v26.305a10.432,10.432,0,0,0,10.4,10.4H80.926A21.081,21.081,0,0,0,83.9,131.7H23.944A15.227,15.227,0,0,1,8.76,116.517V68.664A15.224,15.224,0,0,1,23.944,53.48Zm-10.4,17.255h98.938V68.664a10.429,10.429,0,0,0-10.4-10.4H23.94a10.429,10.429,0,0,0-10.4,10.4v2.071Zm98.938,36.4V99.815c.022.275.033.553.033.839v6.479Zm-5.688,10.839a3.968,3.968,0,0,1-1.725,6.486v2.672a1.154,1.154,0,0,1-2.308,0v-2.679a3.951,3.951,0,1,1,4.037-6.483ZM92.332,110.1H115.48v-9.447c0-15.31-23.147-15.31-23.147,0Z" transform="translate(-8.76 -53.48)" fill="gray" fill-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <nav class="navbar-liga ">
                            <ul class="row">
                                <li>
                                    <a class="active" href="#">
                                        <span>Лига чемпионов УЕФА</span>
                                        <div class="aw-bt">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11.967" height="12.259" viewBox="0 0 11.967 12.259">
                                                <path id="Path_8977" data-name="Path 8977" d="M52.159,29.334,46.591,23.72a1.238,1.238,0,0,0-1.751,1.751l2.6,2.649H41.135a1.235,1.235,0,1,0,0,2.47h6.287l-2.6,2.6a1.238,1.238,0,0,0,1.751,1.751l5.568-5.591v-.022Z" transform="translate(35.318 -39.9) rotate(90)" fill="#fff"/>
                                            </svg>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Лига Европы УЕФА</span>
                                        <div class="aw-bt">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11.967" height="12.259" viewBox="0 0 11.967 12.259">
                                                <path id="Path_8977" data-name="Path 8977" d="M52.159,29.334,46.591,23.72a1.238,1.238,0,0,0-1.751,1.751l2.6,2.649H41.135a1.235,1.235,0,1,0,0,2.47h6.287l-2.6,2.6a1.238,1.238,0,0,0,1.751,1.751l5.568-5.591v-.022Z" transform="translate(35.318 -39.9) rotate(90)" fill="#fff"/>
                                            </svg>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Премьер-лига</span>
                                        <div class="aw-bt">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11.967" height="12.259" viewBox="0 0 11.967 12.259">
                                                <path id="Path_8977" data-name="Path 8977" d="M52.159,29.334,46.591,23.72a1.238,1.238,0,0,0-1.751,1.751l2.6,2.649H41.135a1.235,1.235,0,1,0,0,2.47h6.287l-2.6,2.6a1.238,1.238,0,0,0,1.751,1.751l5.568-5.591v-.022Z" transform="translate(35.318 -39.9) rotate(90)" fill="#fff"/>
                                            </svg>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        <div class="discription-navbarLiga">
                            <div class="row">
                                <div class="col-data">
                                    <ul class="row">
                                        <li><a class="active" href="#">Сегодня</a></li>
                                        <li><a href="#">14.05.2019</a></li>
                                        <li><a href="#">15.05.2019</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tabelForecastsLiga ">
                            <table>
                                <tr>
                                    <th><span>Дата</span></th>
                                    <th><span>Игра</span></th>
                                    <th><span>Вероятность</span></th>
                                    <th><span>Детали</span></th>
                                </tr>
                                <tr>
                                    <td>24.05.2019</td>
                                    <td class="teamVS">
                                        <ul class="row">
                                            <li class="teamStart"><img src="img/tabelForecastsLiga/st1.png" alt="start" ></li>
                                            <li><span class="teamLiga">ЭЙБАР</span>   vs   <span class="teamLiga">БАРСЕЛОНА</span></li>
                                            <li class="teamEnd"><img src="img/tabelForecastsLiga/en1.png" alt="end" ></li>
                                        </ul>
                                    </td>
                                    <td>Высокая</td>
                                    <td><a href="/pages/forecastsID?id='.$forecast['id'].'">Подробнее</a></td>
                                </tr>
                                <tr>
                                    <td>24.05.2019</td>
                                    <td class="teamVS">
                                        <ul class="row">
                                            <li class="teamStart"><img src="img/tabelForecastsLiga/st1.png" alt="start" ></li>
                                            <li><span class="teamLiga">ЭЙБАР</span>   vs   <span class="teamLiga">БАРСЕЛОНА</span></li>
                                            <li class="teamEnd"><img src="img/tabelForecastsLiga/en1.png" alt="end" ></li>
                                        </ul>
                                    </td>
                                    <td>Высокая</td>
                                    <td><a href="/pages/forecastsID?id='.$forecast['id'].'">Подробнее</a></td>
                                </tr>
                                <tr>
                                    <td>24.05.2019</td>
                                    <td class="teamVS">
                                        <ul class="row">
                                            <li class="teamStart"><img src="img/tabelForecastsLiga/st1.png" alt="start" ></li>
                                            <li><span class="teamLiga">ЭЙБАР</span>   vs   <span class="teamLiga">БАРСЕЛОНА</span></li>
                                            <li class="teamEnd"><img src="img/tabelForecastsLiga/en1.png" alt="end" ></li>
                                        </ul>
                                    </td>
                                    <td>Высокая</td>
                                    <td><a href="/pages/forecastsID?id='.$forecast['id'].'">Подробнее</a></td>
                                </tr>
                                <tr>
                                    <td>24.05.2019</td>
                                    <td class="teamVS">
                                        <ul class="row">
                                            <li class="teamStart"><img src="img/tabelForecastsLiga/st1.png" alt="start" ></li>
                                            <li><span class="teamLiga">ЭЙБАР</span>   vs   <span class="teamLiga">БАРСЕЛОНА</span></li>
                                            <li class="teamEnd"><img src="img/tabelForecastsLiga/en1.png" alt="end" ></li>
                                        </ul>
                                    </td>
                                    <td>Высокая</td>
                                    <td><a href="/pages/forecastsID?id='.$forecast['id'].'">Подробнее</a></td>
                                </tr>
                                <tr>
                                    <td>24.05.2019</td>
                                    <td class="teamVS">
                                        <ul class="row">
                                            <li class="teamStart"><img src="img/tabelForecastsLiga/st1.png" alt="start" ></li>
                                            <li><span class="teamLiga">ЭЙБАР</span>   vs   <span class="teamLiga">БАРСЕЛОНА</span></li>
                                            <li class="teamEnd"><img src="img/tabelForecastsLiga/en1.png" alt="end" ></li>
                                        </ul>
                                    </td>
                                    <td>Высокая</td>
                                    <td><a href="/pages/forecastsID?id='.$forecast['id'].'">Подробнее</a></td>
                                </tr>
                                <tr>
                                    <td>24.05.2019</td>
                                    <td class="teamVS">
                                        <ul class="row">
                                            <li class="teamStart"><img src="img/tabelForecastsLiga/st1.png" alt="start" ></li>
                                            <li><span class="teamLiga">ЭЙБАР</span>   vs   <span class="teamLiga">БАРСЕЛОНА</span></li>
                                            <li class="teamEnd"><img src="img/tabelForecastsLiga/en1.png" alt="end" ></li>
                                        </ul>
                                    </td>
                                    <td>Высокая</td>
                                    <td><a href="/pages/forecastsID?id='.$forecast['id'].'">Подробнее</a></td>
                                </tr>
                                <tr>
                                    <td>24.05.2019</td>
                                    <td class="teamVS">
                                        <ul class="row">
                                            <li class="teamStart"><img src="img/tabelForecastsLiga/st1.png" alt="start" ></li>
                                            <li><span class="teamLiga">ЭЙБАР</span>   vs   <span class="teamLiga">БАРСЕЛОНА</span></li>
                                            <li class="teamEnd"><img src="img/tabelForecastsLiga/en1.png" alt="end" ></li>
                                        </ul>
                                    </td>
                                    <td>Высокая</td>
                                    <td><a href="/pages/forecastsID?id='.$forecast['id'].'">Подробнее</a></td>
                                </tr>
                                <tr>
                                    <td>24.05.2019</td>
                                    <td class="teamVS">
                                        <ul class="row">
                                            <li class="teamStart"><img src="img/tabelForecastsLiga/st1.png" alt="start" ></li>
                                            <li><span class="teamLiga">ЭЙБАР</span>   vs   <span class="teamLiga">БАРСЕЛОНА</span></li>
                                            <li class="teamEnd"><img src="img/tabelForecastsLiga/en1.png" alt="end" ></li>
                                        </ul>
                                    </td>
                                    <td>Высокая</td>
                                    <td><a href="/pages/forecastsID?id='.$forecast['id'].'">Подробнее</a></td>
                                </tr>
                                <tr>
                                    <td>24.05.2019</td>
                                    <td class="teamVS">
                                        <ul class="row">
                                            <li class="teamStart"><img src="img/tabelForecastsLiga/st1.png" alt="start" ></li>
                                            <li><span class="teamLiga">ЭЙБАР</span>   vs   <span class="teamLiga">БАРСЕЛОНА</span></li>
                                            <li class="teamEnd"><img src="img/tabelForecastsLiga/en1.png" alt="end" ></li>
                                        </ul>
                                    </td>
                                    <td>Высокая</td>
                                    <td><a href="/pages/forecastsID?id='.$forecast['id'].'">Подробнее</a></td>
                                </tr>
                                <tr>
                                    <td>24.05.2019</td>
                                    <td class="teamVS">
                                        <ul class="row">
                                            <li class="teamStart"><img src="img/tabelForecastsLiga/st1.png" alt="start" ></li>
                                            <li><span class="teamLiga">ЭЙБАР</span>   vs   <span class="teamLiga">БАРСЕЛОНА</span></li>
                                            <li class="teamEnd"><img src="img/tabelForecastsLiga/en1.png" alt="end" ></li>
                                        </ul>
                                    </td>
                                    <td>Высокая</td>
                                    <td><a href="/pages/forecastsID?id='.$forecast['id'].'">Подробнее</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- end liga content -->

                    <!-- start content footer -->
                    <footer>
                        <div class="container">
                            <div class="row">
                                <div class="col-foot order-mb-2">
                                    <ul class="row">
                                        <li>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path id="Path_8970" data-name="Path 8970" d="M6.857,4A2.866,2.866,0,0,0,4,6.857V25.143A2.866,2.866,0,0,0,6.857,28H25.143A2.866,2.866,0,0,0,28,25.143V6.857A2.866,2.866,0,0,0,25.143,4Zm0,1.143H25.143a1.706,1.706,0,0,1,1.714,1.714V25.143a1.706,1.706,0,0,1-1.714,1.714H6.857a1.706,1.706,0,0,1-1.714-1.714V6.857A1.706,1.706,0,0,1,6.857,5.143Zm8.227,5.71a3.593,3.593,0,0,0-1.625.269h0a1.444,1.444,0,0,0-.532.438.723.723,0,0,0-.17.365.61.61,0,0,0,.076.435.668.668,0,0,0,.448.291.984.984,0,0,1,.323.128v0a2.021,2.021,0,0,1,.1.4,2.934,2.934,0,0,1,.022.343q0,.023,0,.046s.033.5.011,1.008a4.357,4.357,0,0,1-.062.548,8.315,8.315,0,0,1-.936-1.382c-.48-.833-.863-1.579-.863-1.579a.93.93,0,0,0-.368-.471,1.374,1.374,0,0,0-.6-.257.571.571,0,0,0-.112-.011H8.552a1.7,1.7,0,0,0-.3.015.876.876,0,0,0-.641.319h0a.829.829,0,0,0-.172.685,1.123,1.123,0,0,0,.083.276l0,.007a30.4,30.4,0,0,0,3.924,6.154A5.152,5.152,0,0,0,15.8,20.57h.955a1.284,1.284,0,0,0,.709-.152.94.94,0,0,0,.408-.729,1.481,1.481,0,0,1,.084-.551.208.208,0,0,1,.1-.118l.027.019a3.119,3.119,0,0,1,.423.41,7.35,7.35,0,0,0,1.25,1.26,2.423,2.423,0,0,0,.993.412,1.623,1.623,0,0,0,.391.013l2.134.009h.038a1.576,1.576,0,0,0,.75-.224,1.052,1.052,0,0,0,.49-.647,1.278,1.278,0,0,0-.2-.943h0a1.181,1.181,0,0,0-.089-.154,4.717,4.717,0,0,0-.277-.4,11.659,11.659,0,0,0-1.32-1.411h0a7.064,7.064,0,0,1-.653-.654c-.093-.122-.062-.058-.056-.089a19.952,19.952,0,0,1,1.231-1.732,14.9,14.9,0,0,0,1.075-1.577,1.574,1.574,0,0,0,.28-1.213v0a.865.865,0,0,0-.335-.468,1.04,1.04,0,0,0-.4-.158,3.208,3.208,0,0,0-.654-.039c-.414,0-2.252.015-2.4.015a1.5,1.5,0,0,0-.6.16,1,1,0,0,0-.423.458l-.017.033s-.379.841-.867,1.671a5.582,5.582,0,0,1-1.08,1.43.211.211,0,0,1-.009-.052c-.02-.235,0-.56,0-.877,0-.854.072-1.452.033-1.98a1.518,1.518,0,0,0-.242-.787,1.281,1.281,0,0,0-.749-.482,3.105,3.105,0,0,0-1.075-.156h0C15.493,10.857,15.285,10.853,15.084,10.853ZM15.7,12a1.837,1.837,0,0,1,.818.125c.108.026.082.026.079.022a.69.69,0,0,1,.041.22c.024.329-.037.983-.037,1.9,0,.249-.03.6,0,.973a1.386,1.386,0,0,0,.565,1.131.834.834,0,0,0,.661.093,1.548,1.548,0,0,0,.595-.318,6.457,6.457,0,0,0,1.394-1.8c.519-.883.9-1.724.91-1.752l.008-.006h.009c.213,0,2.017-.015,2.4-.015.09,0,.123.005.194.008-.019.065,0,.023-.083.176a14.476,14.476,0,0,1-.99,1.445c-.8,1.064-1.29,1.48-1.435,2.186a1.32,1.32,0,0,0,.263,1.009,6.6,6.6,0,0,0,.787.8,10.576,10.576,0,0,1,1.192,1.269,3.626,3.626,0,0,1,.211.3c.041.067.031.06.084.147.035.058.022.023.028.04L23.24,20l-2.1-.009a.571.571,0,0,0-.113.011s.005.006-.107-.011a1.249,1.249,0,0,1-.521-.224,8.463,8.463,0,0,1-1.047-1.081,3.7,3.7,0,0,0-.616-.581,1.112,1.112,0,0,0-.97-.2,1.435,1.435,0,0,0-.854.765,2.124,2.124,0,0,0-.138.761.1.1,0,0,1-.021,0H15.8a3.75,3.75,0,0,1-3.5-1.312,27.979,27.979,0,0,1-3.557-5.542h1.982c.035.013.109.041.114.045l0,0c-.072-.053,0,.021,0,.021q.01.026.023.05s.393.767.89,1.628a8.709,8.709,0,0,0,1.185,1.72,1.461,1.461,0,0,0,.576.393.975.975,0,0,0,.731-.06,1.075,1.075,0,0,0,.532-.846,4.99,4.99,0,0,0,.106-.9,10.677,10.677,0,0,0-.012-1.1,3.856,3.856,0,0,0-.03-.483,1.827,1.827,0,0,0-.317-.939h0l-.006,0A6.255,6.255,0,0,1,15.7,12Zm5.041.56-.008.018h0Z" transform="translate(-4 -4)" fill="gray"/>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24.008" viewBox="0 0 24 24.008">
                                                    <path id="Path_8969" data-name="Path 8969" d="M6.857,4A2.866,2.866,0,0,0,4,6.857V25.143A2.866,2.866,0,0,0,6.857,28h9.618a.571.571,0,0,0,.186,0H19.9a.571.571,0,0,0,.186,0h5.052A2.866,2.866,0,0,0,28,25.143V6.857A2.866,2.866,0,0,0,25.143,4Zm0,1.143H25.143a1.706,1.706,0,0,1,1.714,1.714V25.143a1.706,1.706,0,0,1-1.714,1.714H20.571v-8h2.183l.8-4H20.571V13.714c0-.319.03-.343.137-.413a2.228,2.228,0,0,1,1.006-.158h1.714V9.925L23.1,9.77A7.883,7.883,0,0,0,20,9.143,3.76,3.76,0,0,0,16.982,10.5,5.081,5.081,0,0,0,16,13.714v1.143H14.286v4H16v8H6.857a1.706,1.706,0,0,1-1.714-1.714V6.857A1.706,1.706,0,0,1,6.857,5.143ZM20,10.286a6.013,6.013,0,0,1,2.286.4V12h-.571a2.879,2.879,0,0,0-1.628.343,1.615,1.615,0,0,0-.657,1.372V16H22.16l-.343,1.714H19.429v9.143H17.143V17.714H15.429V16h1.714V13.714a3.988,3.988,0,0,1,.732-2.5A2.521,2.521,0,0,1,20,10.286Z" transform="translate(-4 -4)" fill="gray"/>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path id="Path_8968" data-name="Path 8968" d="M10.091,3A7.1,7.1,0,0,0,3,10.091v9.818A7.1,7.1,0,0,0,10.091,27h9.818A7.1,7.1,0,0,0,27,19.909V10.091A7.1,7.1,0,0,0,19.909,3Zm0,1.091h9.818a5.992,5.992,0,0,1,6,6v9.818a5.992,5.992,0,0,1-6,6H10.091a5.992,5.992,0,0,1-6-6V10.091A5.992,5.992,0,0,1,10.091,4.091ZM21.545,7.364a1.091,1.091,0,1,0,1.091,1.091A1.091,1.091,0,0,0,21.545,7.364ZM15,9a6,6,0,1,0,6,6A6.008,6.008,0,0,0,15,9Zm0,1.091A4.909,4.909,0,1,1,10.091,15,4.9,4.9,0,0,1,15,10.091Z" transform="translate(-3 -3)" fill="gray"/>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-foot order-mb-1">
                                    <p class="row methPrice">
                                        <span>К оплате приниматься</span> 
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="128.22" height="41.649" viewBox="0 0 128.22 41.649">
                                                <g id="Group_183" data-name="Group 183" transform="translate(0.001 0)">
                                                    <path id="Path_8971" data-name="Path 8971" d="M171.477,32.944l-7.843,18.693H158.5L154.649,36.7a2.121,2.121,0,0,0-1.134-1.625,19.441,19.441,0,0,0-4.785-1.58l.124-.546h8.238a2.255,2.255,0,0,1,2.218,1.924l2.02,10.8,5.051-12.724h5.129Zm20.08,12.577c0-4.932-6.8-5.225-6.754-7.4,0-.689.643-1.378,2.071-1.58a9.216,9.216,0,0,1,4.775.831l.827-3.935a12.613,12.613,0,0,0-4.537-.84c-4.785,0-8.137,2.562-8.187,6.167-.051,2.714,2.415,4.192,4.243,5.078s2.516,1.529,2.516,2.3c0,1.235-1.529,1.837-2.911,1.837a9.923,9.923,0,0,1-4.982-1.185l-.886,4.091a13.738,13.738,0,0,0,5.377.987c5.078.051,8.384-2.466,8.435-6.364m12.627,6.116h4.486l-3.894-18.693H200.63a2.2,2.2,0,0,0-2.071,1.378l-7.3,17.311h5.074l.987-2.81h6.213Zm-5.423-6.594,2.562-7,1.479,7h-4.045ZM178.379,32.944l-3.995,18.693h-4.83l3.995-18.693Z" transform="translate(-80.438 -21.236)" fill="#1a1f71"/>
                                                    <path id="_Compound_Path_" data-name=" Compound Path " d="M12.911,90.7V87.948a1.6,1.6,0,0,0-1.7-1.745,1.809,1.809,0,0,0-1.561.781A1.607,1.607,0,0,0,8.181,86.2a1.561,1.561,0,0,0-1.332.643v-.551H6V90.7h.872V88.177a1.029,1.029,0,0,1,1.1-1.148c.643,0,1.01.413,1.01,1.148V90.7h.872V88.177a1.029,1.029,0,0,1,1.1-1.148c.643,0,1.01.413,1.01,1.148V90.7h.964Zm14.326-4.362H25.63V85.009h-.872v1.332h-.918v.781h.918v2.066c0,1.01.367,1.607,1.469,1.607a2.567,2.567,0,0,0,1.194-.321l-.275-.781a1.511,1.511,0,0,1-.827.23.643.643,0,0,1-.689-.735V87.052h1.607v-.735ZM35.41,86.2a1.378,1.378,0,0,0-1.194.643v-.551h-.872V90.7h.872v-2.48c0-.735.367-1.194.964-1.194a2.687,2.687,0,0,1,.6.092l.276-.826a3.1,3.1,0,0,0-.643-.092Zm-12.352.459a3.15,3.15,0,0,0-1.791-.459c-1.1,0-1.791.505-1.791,1.378,0,.735.505,1.148,1.469,1.286l.459.046c.505.092.827.276.827.505,0,.321-.367.551-1.056.551a2.42,2.42,0,0,1-1.469-.459l-.459.689a3.324,3.324,0,0,0,1.906.528c1.286,0,1.974-.6,1.974-1.423s-.551-1.148-1.515-1.286l-.459-.046c-.413-.046-.781-.184-.781-.459s.367-.551.872-.551a3.311,3.311,0,0,1,1.378.367ZM36.42,88.5a2.167,2.167,0,0,0,2.3,2.3,2.3,2.3,0,0,0,1.561-.505l-.459-.689a1.837,1.837,0,0,1-1.148.413,1.474,1.474,0,0,1,0-2.939,1.837,1.837,0,0,1,1.148.413l.459-.689a2.3,2.3,0,0,0-1.561-.505,2.057,2.057,0,0,0-2.3,2.2Zm-6.2-2.3a2.112,2.112,0,0,0-2.158,2.3,2.158,2.158,0,0,0,2.016,2.3h.257a2.81,2.81,0,0,0,1.791-.6l-.459-.643a2.195,2.195,0,0,1-1.286.459,1.29,1.29,0,0,1-1.332-1.148h3.26V88.5A2.1,2.1,0,0,0,30.221,86.2Zm0,.827a1.1,1.1,0,0,1,1.148,1.047s0,.037,0,.055H28.982a1.18,1.18,0,0,1,1.24-1.1ZM18.329,88.5v-2.2h-.849v.551a1.69,1.69,0,0,0-1.423-.643,2.3,2.3,0,0,0,0,4.592,1.69,1.69,0,0,0,1.423-.643V90.7h.872V88.5Zm-3.582,0a1.378,1.378,0,1,1,1.378,1.469A1.35,1.35,0,0,1,14.747,88.5ZM48.68,86.2a1.378,1.378,0,0,0-1.194.643v-.551h-.872V90.7h.872v-2.48c0-.735.367-1.194.964-1.194a2.687,2.687,0,0,1,.6.092l.276-.826a3.1,3.1,0,0,0-.62-.092Zm7.071,3.857a.276.276,0,0,1,.184.046.422.422,0,0,1,.23.23,1.043,1.043,0,0,1,.046.184.275.275,0,0,1-.046.184c-.046.046-.046.092-.092.138a.243.243,0,0,1-.138.092,1.041,1.041,0,0,1-.184.046.276.276,0,0,1-.184-.046c-.046-.046-.092-.046-.138-.092a.243.243,0,0,1-.092-.138,1.043,1.043,0,0,1-.046-.184.276.276,0,0,1,.046-.184c.046-.046.046-.092.092-.138a.243.243,0,0,1,.138-.092c.046,0,.138-.046.184-.046Zm0,.781a.17.17,0,0,0,.138-.046.1.1,0,0,0,.092-.092l.092-.092c0-.046.046-.092.046-.138a.17.17,0,0,0-.046-.138.1.1,0,0,0-.092-.092l-.092-.092c-.046,0-.092-.046-.138-.046a.17.17,0,0,0-.138.046.1.1,0,0,0-.092.092l-.092.092c0,.046-.046.092-.046.138a.17.17,0,0,0,.046.138.1.1,0,0,0,.092.092l.092.092A.17.17,0,0,0,55.751,90.841Zm.046-.505a.17.17,0,0,1,.138.046.115.115,0,0,1,0,.184.161.161,0,0,1-.092.046l.138.138h-.138l-.138-.138h-.046v.115h-.069v-.413h.23Zm-.092.046v.092h.138v-.092ZM45.282,88.5v-2.2H44.41v.551a1.69,1.69,0,0,0-1.423-.643,2.3,2.3,0,0,0,0,4.592,1.69,1.69,0,0,0,1.423-.643V90.7h.872V88.5Zm-3.536,0a1.378,1.378,0,1,1,1.378,1.469A1.339,1.339,0,0,1,41.747,88.5Zm12.444,0V84.55h-.872v2.3a1.69,1.69,0,0,0-1.423-.643,2.3,2.3,0,1,0,0,4.592,1.69,1.69,0,0,0,1.423-.643V90.7h.9V88.5Zm-3.582,0a1.378,1.378,0,1,1,1.378,1.469A1.35,1.35,0,0,1,50.609,88.5Z" transform="translate(-3.246 -49.332)"/>
                                                    <g id="_Group_" data-name=" Group " transform="translate(-0.001 -0.001)">
                                                      <rect id="Rectangle_30" data-name="Rectangle 30" width="15.933" height="25.989" transform="translate(18.804 3.536)" fill="#ff5f00"/>
                                                      <path id="_Path_" data-name=" Path " d="M20.456,24.38a16.576,16.576,0,0,1,6.291-12.995,16.53,16.53,0,1,0,0,25.989A16.576,16.576,0,0,1,20.456,24.38Z" transform="translate(0.001 -7.849)" fill="#eb001b"/>
                                                      <path id="Path_8972" data-name="Path 8972" d="M112.671,65.393v-.551h.23V64.75h-.551v.092h.23v.551Zm1.1,0V64.75h-.184l-.184.459-.184-.459h-.184v.643h.138v-.528l.184.413h.138l.184-.413v.505h.092Z" transform="translate(-60.762 -38.623)" fill="#f79e1b"/>
                                                      <path id="Path_8973" data-name="Path 8973" d="M85.074,24.4A16.53,16.53,0,0,1,58.35,37.4a16.567,16.567,0,0,0,0-25.989A16.53,16.53,0,0,1,85.074,24.4Z" transform="translate(-31.557 -7.871)" fill="#f79e1b"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-foot">
                                    <p>&copy; «DFC777», 2019</p>
                                </div>
                                <div class="col-foot">
                                    <p><a href="/pages/terms">Политика конфиденциальности</a></p>
                                </div>
                            </div>
                        </div>
                    </footer> 
                    <!-- end content footer -->

                </div>
            </section>
            <section id="successForecasts">
                <div class="mobile-hide-block">
                    <button class="btn btn-open-fix" type="button">
                        <span class="circle"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12.259 11.967">
                            <path id="Path_8977" data-name="Path 8977" d="M52.159,29.334,46.591,23.72a1.238,1.238,0,0,0-1.751,1.751l2.6,2.649H41.135a1.235,1.235,0,1,0,0,2.47h6.287l-2.6,2.6a1.238,1.238,0,0,0,1.751,1.751l5.568-5.591v-.022Z" transform="translate(52.159 35.318) rotate(180)" fill="#f30d31"/>
                        </svg>
                    </button>
                </div>
                <div class="container-row">
                    <div class="green-box-for-decore"></div>
                    <?php include_once('layouts/default/inc/right_side.php');?>
                </div>
            </section>
        </article>
        <!-- end page content -->

        <?php include_once('layouts/default/inc/scripts.php');?>
    </body>
</html>