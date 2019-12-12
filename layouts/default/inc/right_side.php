<div id="successForecastsDescript">
    <div class="col-data">
        <ul class="row">
            <li><a class="active" href="#">Сегодня</a></li>
            <li><a href="#">12.05.2019</a></li>
            <li><a href="#">11.05.2019</a></li>
        </ul>
    </div>
    <?php
    foreach($cnt->getDataUser("f_forecasts", "WHERE `status`='1' AND `success`='1'", "all") as $sucess_forecasts) {
        $success_forecasts_id = $sucess_forecasts['id'];
        $sucess_forecasts_league_id = $sucess_forecasts['f_league_id'];
        $sucess_forecasts_score = $sucess_forecasts['score'];
        // get league 
        $sucess_forecasts_league_row = $cnt->getDataUser("f_leagues", "WHERE `id`='$sucess_forecasts_league_id' AND `status`='1'");
        $sucess_forecasts_league_title = $sucess_forecasts_league_row['title_ru'];
        $success_forecast_team = json_decode($sucess_forecasts['f_teams']);
        $success_forecasts_option_show = '';
        // check teams
        $t_1_logo_src = 'no_photo.jpg';
        $t_2_logo_src = 'no_photo.jpg';
        $success_forecasts_show = '';
        if ($success_forecast_team) {
            if (count($success_forecast_team) == 2) {
                $sucess_team_1 = $success_forecast_team[0];
                $sucess_team_2 = $success_forecast_team[1];
                $team_row_1 = $cnt->getDataUser("f_teams", "WHERE `id`='$sucess_team_1' AND `status`='1'");
                $sucess_team_1_title = $team_row_1['title_ru'];
                $team_row_2 = $cnt->getDataUser("f_teams", "WHERE `id`='$sucess_team_2' AND `status`='1'");
                $sucess_team_2_title = $team_row_2['title_ru'];
                // get team logos 
                $team_1_id = $team_row_1['id'];
                $team_2_id = $team_row_2['id'];
                $team_1_logo = $cnt->getDataUser("files", "WHERE `table_name`='f_teams' AND `name_used`='logo' AND `row_id`='$team_1_id'");
                $team_2_logo = $cnt->getDataUser("files", "WHERE `table_name`='f_teams' AND `name_used`='logo' AND `row_id`='$team_2_id'");
                // check team 1 image
                if ($team_1_logo) {
                    $t_1_logo_name = $team_1_logo['name'];
                    $t_1_logo_type = $team_1_logo['type'];
                    $t_1_logo_src = 'f_teams/small/'.$t_1_logo_name.'.'.$t_1_logo_type;
                }else {
                    $t_1_logo_src = 'no_photo.jpg';
                }
                // check team 2 image
                if ($team_2_logo) {
                    $t_2_logo_name = $team_2_logo['name'];
                    $t_2_logo_type = $team_2_logo['type'];
                    $t_2_logo_src = 'f_teams/small/'.$t_2_logo_name.'.'.$t_2_logo_type;
                } else {
                    $t_2_logo_src = 'no_photo.jpg';
                }
                // get data forecats_details
                ?>
                <div class="sucForecBox">
                    <div class="defLig">
                        <h6>
                            <svg id="SOCCER" xmlns="http://www.w3.org/2000/svg" width="11.992" height="11.992" viewBox="0 0 11.992 11.992">
                                <path id="Path_1" data-name="Path 1" d="M.426,9.687a.252.252,0,0,1-.2-.405L1.385,7.764,1,5.8a.252.252,0,0,1,.495-.1L1.9,7.778a.253.253,0,0,1-.047.2L.627,9.588A.251.251,0,0,1,.426,9.687Z" transform="translate(-0.137 -2.78)" fill="#fff" />
                                <path id="Path_2" data-name="Path 2" d="M4.937,14.932l-.037,0L2.825,14.62a.252.252,0,1,1,.074-.5l1.91.284,1-1.616-.673-2.258-2.319-.414a.252.252,0,1,1,.088-.5l2.472.441a.251.251,0,0,1,.2.176l.75,2.515a.251.251,0,0,1-.027.2L5.151,14.812A.251.251,0,0,1,4.937,14.932Z" transform="translate(-1.345 -4.822)" fill="#fff" />
                                <path id="Path_3" data-name="Path 3" d="M8.463,21.476a.252.252,0,0,1-.2-.092L6.784,19.575a.252.252,0,0,1,.389-.32l1.484,1.809a.252.252,0,0,1-.194.412Z" transform="translate(-3.388 -9.558)" fill="#fff" />
                                <path id="Path_4" data-name="Path 4" d="M15.614,20.256a.252.252,0,0,1-.223-.369l.912-1.748a.254.254,0,0,1,.137-.12l2.107-.767a.252.252,0,0,1,.173.474L16.7,18.46l-.867,1.661A.253.253,0,0,1,15.614,20.256Z" transform="translate(-7.672 -8.602)" fill="#fff" />
                                <path id="Path_5" data-name="Path 5" d="M21.871,9.631a.251.251,0,0,1-.2-.1L20.438,7.844a.25.25,0,0,1-.044-.2l.382-2.02a.252.252,0,0,1,.495.094L20.91,7.635l1.165,1.6a.252.252,0,0,1-.2.4Z" transform="translate(-10.166 -2.741)" fill="#fff" />
                                <path id="Path_6" data-name="Path 6" d="M10.032,2.032a.253.253,0,0,1-.111-.026l-1.7-.832A.252.252,0,1,1,8.44.722l1.6.782L11.844.734a.252.252,0,0,1,.2.464l-1.911.815A.27.27,0,0,1,10.032,2.032Z" transform="translate(-4.058 -0.396)" fill="#fff" />
                                <path id="Path_7" data-name="Path 7" d="M11.73,5.367a.252.252,0,0,1-.252-.249L11.456,2.6a.252.252,0,0,1,.25-.254.235.235,0,0,1,.254.249l.022,2.515a.252.252,0,0,1-.25.254Z" transform="translate(-5.734 -1.215)" fill="#fff" />
                                <path id="Path_8" data-name="Path 8" d="M15.923,10.47a.252.252,0,0,1-.055-.5l2.377-.535a.252.252,0,0,1,.111.492l-2.377.535A.264.264,0,0,1,15.923,10.47Z" transform="translate(-7.825 -4.73)" fill="#fff" />
                                <path id="Path_9" data-name="Path 9" d="M15.935,17.639a.253.253,0,0,1-.186-.082l-1.512-1.65a.252.252,0,0,1,.372-.341l1.512,1.65a.252.252,0,0,1-.186.422Z" transform="translate(-7.081 -7.733)" fill="#fff" />
                                <path id="Path_10" data-name="Path 10" d="M11.121,12.035h-2.6a.252.252,0,1,1,0-.5h2.417l.65-2.163L9.779,8.079l-1.86,1.39a.252.252,0,0,1-.3-.4l2.008-1.5a.253.253,0,0,1,.3,0l2.1,1.5a.252.252,0,0,1,.095.278l-.756,2.515A.253.253,0,0,1,11.121,12.035Z" transform="translate(-3.779 -3.778)" fill="#fff" />
                                <path id="Path_11" data-name="Path 11" d="M6.1,12.092a6,6,0,1,1,6-6A6,6,0,0,1,6.1,12.092ZM6.1.6A5.492,5.492,0,1,0,11.588,6.1,5.5,5.5,0,0,0,6.1.6Z" transform="translate(-0.1 -0.1)" fill="#fff" />
                            </svg>
                            <span><?=$sucess_forecasts_league_title?></span>
                        </h6>
                    </div>
                    <div class="row">
                        <div class="col-lig-forec">
                            <img src="/public/img/<?=$t_1_logo_src?>" alt="Start Team">
                            <p><?=$sucess_team_1_title?></p>
                        </div>
                        <div class="col-lig-forec align-self-end">
                            <h4><?=$sucess_forecasts_score?></h4>
                        </div>
                        <div class="col-lig-forec">
                             <img src="/public/img/<?=$t_2_logo_src?>" alt="Start Team">
                             <p><?=$sucess_team_2_title?></p>
                        </div>
                    </div>
                    <table>
                        <tr>
                            <th colspan="2">ДЕТАЛИ ПРОГНОЗА</th>
                        </tr>
                        <?php
                        // get options
                        foreach($cnt->getDataUser("f_forecasts_options", "WHERE `f_forecast_id`='$success_forecasts_id'", "all") as $success_forecast_option) {
                            $success_forecast_option_1_ru = $success_forecast_option['option_1_ru'];
                            $success_forecast_option_2_ru = $success_forecast_option['option_2_ru'];
                            ?>
                            <tr>
                                <td><?=$success_forecast_option_1_ru?></td>
                                <td><?=$success_forecast_option_2_ru?></td>
                            </tr>
                        <?php }?>
                    </table>
                </div>
                <?php
            }
        }
    }
    ?>
</div>