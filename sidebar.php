<?php if (!dynamic_sidebar('sidebar')): ?>
<?php endif; ?>
<div class="widget widget--popular-posts">
    <div class="widget__title  widget--sidebar__title  flush--bottom">
        <h2 class="hN">Popular posts</h2>
    </div>
    <ul class="nav popular-posts__time">
        <li><a href="#today" class="current">Today</a></li>
        <li><a href="#week">Week</a></li>
        <li><a href="#month">Month</a></li>
        <li><a href="#all">All</a></li>
    </ul>
    <div class="list-wrap">
        <div id="today" class="list-wrap-item">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <article class="article  article--list  media">
                    <a href="#" class="article--list__link">
                        <div class="media__img  push-half--right">
                            <img src="http://placehold.it/72x54" alt="72x54">
                        </div>
                        <div class="media__body">
                            <div class="article__title  article--list__title">
                                <h5 class="hN">Article title has something to say</h5>
                            </div>
                        </div>
                        <div class="badge  badge--article  badge--article--list"><?php echo $i; ?></div>
                    </a>
                </article>
            <?php endfor; ?>
        </div>
        <div id="week" class="list-wrap-item  hide">
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <article class="article  article--list  media">
                    <a href="#" class="article--list__link">
                        <div class="media__img  push-half--right">
                            <img src="http://placehold.it/72x54" alt="72x54">
                        </div>
                        <div class="media__body">
                            <div class="article__title  article--list__title">
                                <h5 class="hN">Article title has something to say</h5>
                            </div>
                        </div>
                        <div class="badge  badge--article  badge--article--list"><?php echo $i; ?></div>
                    </a>
                </article>
            <?php endfor; ?>
        </div>
        <div id="month" class="list-wrap-item  hide">
            <?php for ($i = 1; $i <= 2; $i++): ?>
                <article class="article  article--list  media">
                    <a href="#" class="article--list__link">
                        <div class="media__img  push-half--right">
                            <img src="http://placehold.it/72x54" alt="72x54">
                        </div>
                        <div class="media__body">
                            <div class="article__title  article--list__title">
                                <h5 class="hN">Article title has something to say</h5>
                            </div>
                        </div>
                        <div class="badge  badge--article  badge--article--list"><?php echo $i; ?></div>
                    </a>
                </article>
            <?php endfor; ?>
        </div>
        <div id="all" class="list-wrap-item  hide">
            <?php for ($i = 1; $i <= 2; $i++): ?>
                <article class="article  article--list  media">
                    <a href="#" class="article--list__link">
                        <div class="media__img  push-half--right">
                            <img src="http://placehold.it/72x54" alt="72x54">
                        </div>
                        <div class="media__body">
                            <div class="article__title  article--list__title">
                                <h5 class="hN">Article title has something to say</h5>
                            </div>
                        </div>
                        <div class="badge  badge--article  badge--article--list"><?php echo $i; ?></div>
                    </a>
                </article>
            <?php endfor; ?>
        </div>
    </div>
</div>