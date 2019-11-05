<?php

//  文章的自定义字段
function themeFields($layout) {
    //  文章头图
    $image = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('文章头图'), _t('文章头图会显示在文章的顶部。'));
    $layout->addItem($image);

    //  显示版权声明
    $articleCopyright = new Typecho_Widget_Helper_Form_Element_Select('articleCopyright', array(
        'show' => '显示',
        'hide' => '不显示'
    ), 'show', _t('显示原创声明'), _t('开启后会在本篇文章底部显示版权声明。'));
    $layout->addItem($articleCopyright);
}

//  外观设置
function themeConfig($form) {
    //  站点Logo
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 Logo 地址'), _t('Logo 会显示在标签页的标题前面。'));
    $form->addInput($logoUrl);

    //  站点副标题
    $tagline = new Typecho_Widget_Helper_Form_Element_Text('tagline', null, '生命不息，折腾不止', _t('站点副标题'), _t('站点副标题会显示在标签页标题的后面。'));
    $form->addInput($tagline);

    //  ICP信息
    $icp = new Typecho_Widget_Helper_Form_Element_Text('icp', null, null, _t('ICP 备案号'), _t('ICP 备案号会显示在网站的底部。'));
    $form->addInput($icp);

    //  侧边栏
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock',
        array(
            'ShowRecentPosts' => _t('显示最新文章'),
            'ShowRecentComments' => _t('显示最近回复'),
            'ShowCategory' => _t('显示分类'),
            'ShowTag' => _t('显示标签云'),
            'ShowArchive' => _t('显示归档'),
            'ShowOther' => _t('显示其它杂项'),
            'HideLoginLink' => _t('隐藏登录入口')
        ),
        array('ShowRecentPosts','ShowRecentComments', 'ShowCategory', 'ShowTag', 'ShowArchive', 'ShowOther'), _t('侧边栏显示')
    );
    $form->addInput($sidebarBlock->multiMode());

    //  文章头图设置
    $headerImage = new Typecho_Widget_Helper_Form_Element_Checkbox('headerImage', array(
        'home' => _t('在首页显示文章头图'),
        'sidebarBlock' => _t('在侧边栏的最新文章区域显示文章头图'),
        'post' => _t('在文章页显示文章头图')
    ), array('home', 'sidebarBlock', 'post'), _t('文章头图设置'));
    $form->addInput($headerImage->multiMode());

    //  Emoji面板
    $emojiPanel = new Typecho_Widget_Helper_Form_Element_Radio('emojiPanel', array(
        'on' => '开启',
        'off' => '关闭'
    ), 'off', _t('评论区Emoji表情选择面板'));
    $form->addInput($emojiPanel);

    //  导航栏
    $navBar = new Typecho_Widget_Helper_Form_Element_Checkbox('navbar', array(
        'showClassification' => _t('显示文章分类'),
        'blurry' => _t('导航栏毛玻璃效果')
    ), array('blurry'), _t('导航栏'));
    $form->addInput($navBar->multiMode());

    //  导航栏颜色
    $navColor = new Typecho_Widget_Helper_Form_Element_Radio('navColor', array(
        'light' => '亮色',
        'dark' => '暗色'
    ), 'light', _t('导航栏颜色'));
    $form->addInput($navColor);

    //  巨幕
    $Jumbotron = new Typecho_Widget_Helper_Form_Element_Checkbox('Jumbotron', array(
        'showJumbotron' => _t('显示巨幕')
    ), null, _t('巨幕'));
    $form->addInput($Jumbotron->multiMode());

    //  巨幕背景图片
    $JumbotronBG = new Typecho_Widget_Helper_Form_Element_Text('JumbotronBG', null, null, _t('巨幕背景图片'), _t('如果为空会显示默认图片。'));
    $form->addInput($JumbotronBG);

    //  社交信息
    $socialInfo = new Typecho_Widget_Helper_Form_Element_Textarea('socialInfo', null, null, _t('社交信息'), _t('需要 JSON 格式，社交信息会显示在巨幕的站点副标题下方。需要开启巨幕显示才能显示社交信息。如需查看详细说明可以访问：https://www.misterma.com/archives/819/。'));
    $form->addInput($socialInfo);

    //  文章摘要字数
    $summary = new Typecho_Widget_Helper_Form_Element_Text('summary', NULL, '120', _t('文章摘要字数'), _t('文章摘要字数，默认为：120 个字'));
    $form->addInput($summary);

    //  首页友链
    $homeLinks = new Typecho_Widget_Helper_Form_Element_Textarea('homeLinks', NULL, NULL, _t('首页友情链接'), _t('首页友情链接只会显示在首页的侧边栏，需要 JSON 格式数据。如需查看详细说明可以访问：https://www.misterma.com/archives/819/。'));
    $form->addInput($homeLinks);

    //  全站友链
    $links = new Typecho_Widget_Helper_Form_Element_Textarea('links', NULL, NULL, _t('全站友情链接'), _t('全站友情链接会在每个页面的侧边栏显示，需要 JSON 格式数据。如需查看详细说明可以访问：https://www.misterma.com/archives/819/。'));
    $form->addInput($links);

    //  独立页友链
    $pageLinks = new Typecho_Widget_Helper_Form_Element_Textarea('pageLinks', null, null, _t('独立页友情链接'), _t('独立页友情链接只会在友情链接的页面显示，需要 JSON 格式 数据。如果要使用独立页友情链接需要创建一个独立页面，把 自定义模板设置为 友情链接。如需查看详细说明可以访问：https://www.misterma.com/archives/819/。'));
    $form->addInput($pageLinks);

    //  自定义CSS
    $cssCode = new Typecho_Widget_Helper_Form_Element_Textarea('cssCode', NULL, NULL, _t('自定义 CSS'), _t('通过自定义 CSS 您可以很方便的设置页面样式，自定义 CSS 不会影响网站源代码。'));
    $form->addInput($cssCode);

    //  自定义 head 输出的 HTML
    $headHTML = new Typecho_Widget_Helper_Form_Element_Textarea('headHTML', null, null, _t('自定义 head 区域输出的 HTML'), _t('head 区域的 HTML 会在 head 内输出，可以用来定义一些网站统计的 JS 之类的。'));
    $form->addInput($headHTML);

    //  自定义 body 底部的 HTML
    $bodyHTML = new Typecho_Widget_Helper_Form_Element_Textarea('bodyHTML', null, null, _t('自定义 body 底部输出的 HTML'), _t('body 底部的 HTML 会在 footer 之后 body 尾部之前输出。'));
    $form->addInput($bodyHTML);
}

//  统计文章阅读量
function getPostView($archive) {
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        return 0;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if (empty($views)) {
            $views = array();
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            //  如果cookie不存在才会加1
            $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views);  //  记录查看cookie
        }
    }
    return $row['views'];
}

//  输出社交信息
function socialInfo($info) {
    $icon = array(
        'facebook' => array(
            'icon' => 'icon-facebook',
            'name' => 'Facebook'
        ),
        'twitter' => array(
            'icon' => 'icon-twitter',
            'name' => 'Twitter'
        ),
        'weibo' => array(
            'icon' => 'icon-sina-weibo',
            'name' => '微博'
        ),
        'instagram' => array(
            'icon' => 'icon-instagram',
            'name' => 'Instagram'
        ),
        'github' => array(
            'icon' => 'icon-github',
            'name' => 'Github'
        ),
        'telegram' => array(
            'icon' => 'icon-telegram',
            'name' => 'Telegram'
        ),
        'linkedin' => array(
            'icon' => 'icon-linkedin2',
            'name' => 'LinkedIn'
        ),
        'steam' => array(
            'icon' => 'icon-steam',
            'name' => 'Steam'
        )
    );

    $info = json_decode($info);
    foreach ($info as $val) {
        echo '<a class="' . $icon[$val->name]['icon'] . '" href="' . $val->url . '" title="' . $icon[$val->name]['name'] . '" aria-label="' . $icon[$val->name]['name'] . '" target="_blank"></a>';
    }
}