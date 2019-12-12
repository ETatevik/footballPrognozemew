<div class="mobile-hide-block">
                <button class="btn btn-open-fix" type="button">
                    <span class="circle"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12.259 11.967">
                        <path id="Path_8977" data-name="Path 8977" d="M52.159,29.334,46.591,23.72a1.238,1.238,0,0,0-1.751,1.751l2.6,2.649H41.135a1.235,1.235,0,1,0,0,2.47h6.287l-2.6,2.6a1.238,1.238,0,0,0,1.751,1.751l5.568-5.591v-.022Z" transform="translate(52.159 35.318) rotate(180)" fill="#323840" />
                    </svg>
                </button>
            </div>
            <div class="container-row">
                <h3>Главные новости дня</h3>
                <div id="news-block">
                    <?php
                    // get news
                    foreach($cnt->getDataUser("f_news", "WHERE `status`='1' ORDER BY `date`", "all") as $news) {
                        // get data news
                        $news_id = $news['id'];
                        $news_title = $news['title_ru'];
                        $news_date = date('d.m.Y H:i', strtotime($news['date']));
                        // get news image
                        $news_image = $cnt->getDataUser("files", "WHERE `table_name`='f_news' AND `name_used`='image' AND `row_id` = '$news_id'");
                        // check image
                        if ($news_image) {
                            $n_image_name = $news_image['name'];
                            $n_image_type = $news_image['type'];
                            $n_image_src = 'f_news/small/'.$n_image_name.'.'.$n_image_type;
                        }else {
                            $n_image_src = 'no_photo.jpg';
                        }
                        ?>
                        <div class="box">
                            <a href="/pages/newsID?id=<?=$news_id?>" class="news-card">
                                <span class="news-img"><img src="/public/img/<?=$n_image_src?>" alt="newsP1.png"></span>
                                <span class="news-card-body">
                                    <span class="news-header"><?=$news_title?></span>
                                    <span class="news-date"><?=$news_date?></span>
                                </span>
                            </a>
                        </div>
                    <?php }?>
                </div>
            </div>