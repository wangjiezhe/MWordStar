<?php
$sidebarM = $this->options->sidebarBlockM;  //  获取侧边栏的移动设备显示设置
if (!is_array($sidebarM)) {
    $sidebarM = array();
}
$hideClass = 'd-md-none d-sm-none d-none d-lg-block d-xl-block';  //  用于在移动设备上隐藏区块的class
$color = color($this->options->color);
$rounded = $this->options->rounded == 'rightAngle'?'rounded-0':'';  //  获取元素风格设置
$components = $this->options->sidebarComponent;  //  读取侧边栏组件
//  如果侧边栏组件为空就使用默认设置
if ($components == null or $components == '') {
    $components = '博客信息,日历,最新文章,最新回复,文章分类,标签云,文章归档,其它功能,友情链接';
}
$components = str_replace(' ', '', $components);  //  去除空格
$components = explode(',', $components);
?>

<div class="col-md-12 col-lg-4 col-sm-12 sidebar">
    <?php foreach ($components as $component): ?>
        <?php if ($component == '博客信息'): ?>
            <section class="border <?php echo in_array('HideBlogInfo', $sidebarM)?$hideClass:''; ?> <?php echo $rounded; ?>">
                <h4>博客信息</h4>
                <div class="personal-information pt-2">
                    <div class="user">
                        <img src="<?php $this->options->avatarUrl?$this->options->avatarUrl():$this->options->themeUrl('assets/img/avatar.png'); ?>" alt="<?php echo $this->options->nickname?$this->options->nickname . '的头像':$this->options->title . '的头像'; ?>" class="rounded-circle avatar">
                        <div class="p-2">
                            <a class="user-name mt-2 <?php echo $color['link']; ?>" target="_blank" href="<?php echo $this->options->nicknameUrl?$this->options->nicknameUrl:$this->options->siteUrl; ?>"><?php echo $this->options->nickname?$this->options->nickname:$this->options->title; ?></a>
                            <p class="introduction mt-1"><?php echo $this->options->Introduction?$this->options->Introduction:$this->options->description; ?></p>
                        </div>
                    </div>
                    <div class="website clearfix border-top">
                        <?php Typecho_Widget::widget('Widget_Stat')->to($quantity); ?>
                        <div class="info float-left border-right">
                            <p class="quantity"><?php $quantity->publishedPostsNum(); ?></p>
                            文章数
                        </div>
                        <div class="info float-left border-right">
                            <p class="quantity"><?php $quantity->publishedCommentsNum(); ?></p>
                            评论数
                        </div>
                        <div class="info float-left">
                            <p class="quantity"><?php echo $this->options->birthday?round((time() - strtotime($this->options->birthday)) / 86400, 0) . '天':'0天'; ?></p>
                            运行天数
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if ($component == '日历'): ?>
            <section class="border calendar">
                <?php $date = getMonth(); ?>
                <h4><?php echo $date[0] . '年' . $date[1] . '月'; ?></h4>
                <div class="tag-list pt-2">
                    <?php $calendar = calendar($date[0] . '-' . $date[1] . '-01', $this->options->siteUrl, $this->options->rewrite, $color['link']); ?>
                    <?php echo $calendar['calendar']; ?>
                    <div class="pt-2 clearfix">
                        <?php if ($calendar['previous']): ?>
                            <a class="p-0 float-left <?php echo $color['link']; ?>" href="<?php echo $calendar['previousUrl']; ?>"><?php echo date('Y年m月', strtotime($calendar['previous'] . '01')); ?></a>
                        <?php endif; ?>
                        <?php if ($calendar['next']): ?>
                            <a class="p-0 float-right <?php echo $color['link']; ?>"  href="<?php echo $calendar['nextUrl']; ?>"><?php echo date('Y年m月', strtotime($calendar['next'] . '01')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if ($component == '最新文章' && !$this->is('page', 'archives')): ?>
            <section class="border latest-articles<?php echo in_array('HideRecentPosts', $sidebarM)?' ' . $hideClass:''; ?> <?php echo $rounded; ?>">
                <h4>最新文章</h4>
                <ul class="list-group" aria-label="最新文章">
                    <?php $latestArticles = $this->widget('Widget_Contents_Post_Recent'); ?>
                    <?php while ($latestArticles->next()): ?>
                        <li class="border-bottom">
                            <a target="<?php $this->options->sidebarLinkOpen(); ?>" class="<?php echo $color['link']; ?>" href="<?php $latestArticles->permalink(); ?>">
                                <?php if ($this->options->headerImage && in_array('sidebarBlock', $this->options->headerImage)): ?>
                                    <?php $img = postImg($latestArticles); ?>
                                    <?php if ($img): ?>
                                        <div class="article-img" style="background-image: url(<?php echo $img; ?>);" aria-label="<?php $latestArticles->title(); ?>的头图"></div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <p><?php $latestArticles->title(); ?></p>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        <?php endif; ?>
        <?php if ($component == '最新回复'): ?>
            <section class="border <?php echo in_array('HideRecentComments', $sidebarM)?$hideClass:''; ?> <?php echo $rounded; ?>">
                <h4>最新回复</h4>
                <ul class="list-unstyled list-group" aria-label="最新回复">
                    <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
                    <?php while($comments->next()): ?>
                        <li class="media border-bottom">
                            <?php $comments->gravatar('40', ''); ?>
                            <div class="media-body ml-2">
                                <a target="<?php $this->options->sidebarLinkOpen(); ?>" class="<?php echo $color['link']; ?>" href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>
                                <div><?php $comments->excerpt(20, '[...]'); ?></div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        <?php endif; ?>
        <?php if ($component == '文章分类'): ?>
            <section class="category border <?php echo in_array('HideCategory', $sidebarM)?$hideClass:''; ?> <?php echo $rounded; ?>">
                <h4>文章分类</h4>
                <ul class="list-group list-group-flush" aria-label="文章分类">
                    <?php $this->widget('Widget_Metas_Category_List')->parse('<li class="d-flex justify-content-between align-items-center border-bottom indentation-{parent}"><a target="' . $this->options->sidebarLinkOpen . '" data-toggle="tooltip" data-placement="top" class="' . $color['link'] . '" href="{permalink}" title="{description}">{name}</a><span class="badge badge-pill ' . $color['listTag'] . '">{count}</span></li>'); ?>
                </ul>
            </section>
        <?php endif; ?>
        <?php if ($component == '标签云'): ?>
            <section class="border <?php echo in_array('HideTag', $sidebarM)?$hideClass:''; ?> <?php echo $rounded; ?>">
                <h4>标签云</h4>
                <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=50')->to($tags); ?>
                <?php if($tags->have()): ?>
                    <div class="tag-list pt-2" aria-label="标签云" role="list">
                        <?php while ($tags->next()): ?>
                            <a role="listitem" target="<?php $this->options->sidebarLinkOpen(); ?>" data-toggle="tooltip" data-placement="top" href="<?php $tags->permalink(); ?>" rel="tag" class="size-<?php $tags->split(5, 10, 20, 30); ?> <?php echo $color['tag']; ?> <?php echo $rounded; ?>" title="<?php $tags->count(); ?> 篇文章"><?php $tags->name(); ?></a>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center pb-2"><?php _e('没有任何标签'); ?></p>
                <?php endif; ?>
            </section>
        <?php endif; ?>
        <?php if ($component == '文章归档'): ?>
            <section class="border <?php echo in_array('HideArchive', $sidebarM)?$hideClass:''; ?> <?php echo $rounded; ?>">
                <h4>文章归档</h4>
                <ul class="list-group list-group-flush" aria-label="文章归档">
                    <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y年m月')->parse('<li class="d-flex justify-content-between align-items-center border-bottom"><a target="' . $this->options->sidebarLinkOpen . '" data-toggle="tooltip" data-placement="top" class="' . $color['link'] . '" href="{permalink}" title="{count}篇文章">{date}</a><span class="badge badge-pill ' . $color['listTag'] . '">{count}</span></li>');
                    ?>
                </ul>
            </section>
        <?php endif; ?>
        <?php if ($component == '其它功能'): ?>
            <section class="border <?php echo in_array('HideOther', $sidebarM)?$hideClass:''; ?> <?php echo $rounded; ?>">
                <h4>其它功能</h4>
                <ul class="list-group" aria-label="其它功能">
                    <?php if ($this->options->loginLink == 'show'): ?>
                        <?php if($this->user->hasLogin()): ?>
                            <li class="last border-bottom"><a class="<?php echo $color['link']; ?>" href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
                            <li><a class="<?php echo $color['link']; ?> border-bottom" href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
                        <?php else: ?>
                            <li class="last"><a class="<?php echo $color['link']; ?>" href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <li class="border-bottom"><a class="<?php echo $color['link']; ?>" target="_blank" href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
                    <li class="border-bottom"><a class="<?php echo $color['link']; ?>" target="_blank" href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a></li>
                </ul>
            </section>
        <?php endif; ?>
        <?php if ($component == '友情链接'): ?>
            <?php if ($this->options->links or $this->options->homeLinks && $this->is('index')): ?>
                <section class="border <?php echo in_array('HideLinks', $sidebarM)?$hideClass:''; ?> <?php echo $rounded; ?>">
                    <h4>友情链接</h4>
                    <ul class="list-group" aria-label="友情链接">
                        <?php if ($this->options->homeLinks && $this->is('index')): ?>
                            <?php $homeLinks = json_decode($this->options->homeLinks); ?>
                            <?php foreach ($homeLinks as $val): ?>
                                <li class="border-bottom"><a data-toggle="tooltip" data-placement="top" class="<?php echo $color['link']; ?>" href="<?php echo $val->url; ?>" title="<?php echo isset($val->title)?$val->title:'暂无简介'; ?>" target="_blank"><?php echo $val->name; ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ($this->options->links): ?>
                            <?php $links = json_decode($this->options->links); ?>
                            <?php foreach ($links as $val): ?>
                                <li class="border-bottom"><a data-toggle="tooltip" data-placement="top" class="<?php echo $color['link']; ?>" href="<?php echo $val->url; ?>" title="<?php echo isset($val->title)?$val->title:'暂无简介'; ?>" target="_blank"><?php echo $val->name; ?></a></li>
                            <?php endforeach;; ?>
                        <?php endif; ?>
                    </ul>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach;  ?>
</div>