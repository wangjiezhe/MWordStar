<?php

//  文章的自定义字段
function themeFields($layout) {
    //  文章头图来源
    $imageSource = new Typecho_Widget_Helper_Form_Element_Select('imageSource', array(
        'article' => '使用文章中的第一张图片作为文章头图',
        'url' => '在文章头图输入框手动输入图片URL',
        'hide' => '不显示文章头图'
    ), 'article', _t('文章头图来源'), _t('如果文章头图 URL 为空或文章内容中没有图片将不会显示文章头图。'));
    $layout->addItem($imageSource);

    //  文章头图
    $image = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('文章头图'), _t('如果您在文章头图来源中设置了手动输入图片 URL 的话，请在这里输入图片 URL。'));
    $layout->addItem($image);

    //  自定义文章摘要内容
    $summaryContent = new Typecho_Widget_Helper_Form_Element_Textarea('summaryContent', null, null, _t('自定义摘要内容'), _t('您可以在此处为文章定义摘要内容，此处定义的摘要内容不受字数限制。'));
    $layout->addItem($summaryContent);

    //  显示版权声明
    $articleCopyright = new Typecho_Widget_Helper_Form_Element_Select('articleCopyright', array(
        'show' => '显示',
        'hide' => '不显示'
    ), 'show', _t('显示原创声明'), _t('开启后会在本篇文章底部显示版权声明。'));
    $layout->addItem($articleCopyright);
}

//  外观设置
function themeConfig($form) {
    echo <<<EOT
    <p>主题使用帮助 <a href="https://www.misterma.com/archives/819/" target="_blank">点击查看帮助文档</a> ，在使用过程中有什么问题或疑问都可以到 <a href="https://www.misterma.com/msg.html" target="_blank">留言板</a> 留言。</p>
    <button id="export-btn" type="button" class="btn">导出主题配置文件</button>
    <button id="import-btn" type="button" class="btn">导入主题配置文件</button>
    <a href="javascript:;" id="download-file" style="display: none;">下载</a>
    <input type="file" id="file-select" style="display: none;">
    <br/>
    <p><b>导出主题配置文件</b> 可以把主题外观设置导出为 JSON 文件，<b>导入主题配置文件</b> 可以导入 <b>MWordStar</b> 主题的 JSON 配置文件。</p>
EOT;
    echo '<script type="text/javascript">';
    require_once 'assets/js/options-panel.js';
    echo '</script>';

    //  主题配色
    $color = new Typecho_Widget_Helper_Form_Element_Radio('color', array(
        'dark' => 'Dark',
        'primary' => 'Primary',
        'info' => 'Info',
        'success' => 'Success',
        'light' => 'Light'
    ), 'light', _t('主题配色'), _t('主题配色包含了 导航栏、链接、按钮、标签 的颜色。'));
    $form->addInput($color);

    //  主题元素风格设置
    $rounded = new Typecho_Widget_Helper_Form_Element_Radio('rounded', array(
       'fillet' => '圆角',
        'rightAngle' => '直角'
    ), 'fillet', _t('主题元素风格'), _t('这里的元素风格包括了 区块、按钮、输入表单、标签'));
    $form->addInput($rounded);

    //  站点Logo
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 Logo 地址'), _t('Logo 会显示在标签页的标题前面。'));
    $form->addInput($logoUrl);

    //  站点副标题
    $tagline = new Typecho_Widget_Helper_Form_Element_Text('tagline', null, '生命不息，折腾不止', _t('站点副标题'), _t('站点副标题会显示在标签页标题的后面。'));
    $form->addInput($tagline);

    //  ICP信息
    $icp = new Typecho_Widget_Helper_Form_Element_Text('icp', null, null, _t('ICP 备案号'), _t('ICP 备案号会显示在网站的底部。'));
    $form->addInput($icp);

    //  返回顶部按钮
    $toTop = new Typecho_Widget_Helper_Form_Element_Radio('toTop', array(
        'show' => '显示',
        'hide' => '不显示'
    ), 'show', _t('在右下方显示返回顶部按钮'));
    $form->addInput($toTop);

    //  侧边栏
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock',
        array(
            'ShowBlogInfo' => _t('显示博客信息'),
            'ShowRecentPosts' => _t('显示最新文章'),
            'ShowRecentComments' => _t('显示最近回复'),
            'ShowCategory' => _t('显示分类'),
            'ShowTag' => _t('显示标签云'),
            'ShowArchive' => _t('显示归档'),
            'ShowOther' => _t('显示其它杂项'),
            'HideLoginLink' => _t('隐藏登录入口')
        ),
        array('ShowBlogInfo', 'ShowRecentPosts','ShowRecentComments', 'ShowCategory', 'ShowTag', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'), _t('您可以在这里设置需要显示在侧边栏上的内容，这里的设置会影响到移动设备的侧边栏显示。如果设置为不显示将不会出现 HTML。')
    );
    $form->addInput($sidebarBlock->multiMode());

    //  侧边栏（移动端）
    $sidebarBlockM = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlockM',
        array(
            'HideBlogInfo' => _t('在移动设备上隐藏博客信息'),
            'HideRecentPosts' => _t('在移动设备上隐藏最新文章'),
            'HideRecentComments' => _t('在移动设备上隐藏最新回复'),
            'HideCategory' => _t('在移动设备上隐藏分类'),
            'HideTag' => _t('在移动设备上隐藏标签云'),
            'HideArchive' => _t('在移动设备上隐藏文章归档'),
            'HideOther' => _t('在移动设备上隐藏其它功能区域'),
            'HideLinks' => _t('隐藏首页和全站友情链接')
        ), null, _t('侧边栏显示（移动设备）'), _t('在移动设备上，侧边栏会显示在文章的下方。您可以在这里设置需要在移动设备上隐藏的侧边栏内容，这里设置的内容不会影响到 PC版 的显示。这里的移动设备包括平板电脑和手机。这里的隐藏只是看不到内容，HTML代码还是在的。')
    );
    $form->addInput($sidebarBlockM->multiMode());

    //  侧边栏博客信息博主头像地址
    $avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', null, null, _t('博主头像地址'), _t('博主头像会显示在侧边栏的博客信息区域，如果省略会使用默认头像。'));
    $form->addInput($avatarUrl);

    //  侧边栏博客信息区域博主昵称
    $nickname = new Typecho_Widget_Helper_Form_Element_Text('nickname', null, null, _t('博主昵称'), _t('博主昵称会显示在侧边栏博客信息区域，如果省略会显示博客站点名称。'));
    $form->addInput($nickname);

    //  侧边栏博客信息博主昵称链接
    $nicknameUrl = new Typecho_Widget_Helper_Form_Element_Text('nicknameUrl', null, null, _t('博主昵称链接调转地址'), _t('在侧边栏的博客信息区域会显示一个包含博主昵称的链接，在这里可以填写链接的跳转地址，如果省略会使用博客首页地址。'));
    $form->addInput($nicknameUrl);

    //  侧边栏博客信息博主简介
    $Introduction = new Typecho_Widget_Helper_Form_Element_Text('Introduction', null, null, _t('博主简介'), _t('博主简介会显示在侧边栏博客信息区域的博主昵称下方，如果省略会使用设置中的站点描述信息。'));
    $form->addInput($Introduction);

    //  侧边栏博客信息的运行天数
    $birthday = new Typecho_Widget_Helper_Form_Element_Text('birthday', null, null, _t('站点创建时间'), _t('在这里填写站点创建时间后，在侧边栏的博客信息区域就会显示网站运行天数。如果省略 网站运行天数会显示为 0 天。站点创建时间的格式为：yyyy-mm-dd，例如：2019-11-11。'));
    $form->addInput($birthday);

    //  文章头图设置
    $headerImage = new Typecho_Widget_Helper_Form_Element_Checkbox('headerImage', array(
        'home' => _t('在首页显示文章头图'),
        'sidebarBlock' => _t('在侧边栏的最新文章区域显示文章头图'),
        'post' => _t('在文章页显示文章头图')
    ), array('home', 'post'), _t('文章头图设置'));
    $form->addInput($headerImage->multiMode());

    //  文章头图背景颜色
    $headerImageBg = new Typecho_Widget_Helper_Form_Element_Radio('headerImageBg', array(
        'random' => '随机颜色',
        'gray' => '灰色',
        'white' => '白色'
    ), 'gray', _t('文章头图背景颜色'), _t('文章头图背景颜色是在图片加载完成之前或图片无法加载时显示的颜色，如果图片使用了透明背景是可以看到背景颜色的。'));
    $form->addInput($headerImageBg);

    //  显示目录
    $atalog = new Typecho_Widget_Helper_Form_Element_Radio('atalog', array(
        'show' => '显示',
        'hide' => '不显示'
    ), 'hide', _t('在文章开头显示章节目录'), _t('章节目录会根据文章中的标题生成，如果文章中没有用到标题就不会生成目录。'));
    $form->addInput($atalog);

    //  显示最后编辑时间
    $modified = new Typecho_Widget_Helper_Form_Element_Radio('modified', array(
        'show' => '显示',
        'hide' => '不显示'
    ), 'show', _t('在文章下方显示最后修改时间'));
    $form->addInput($modified);

    //  文章摘要字数
    $summary = new Typecho_Widget_Helper_Form_Element_Text('summary', NULL, '120', _t('文章摘要字数'), _t('首页、分类页、标签页、搜索页 的文章摘要字数，默认为：120个字。'));
    $form->addInput($summary);

    //  评论框位置
    $commentInput = new Typecho_Widget_Helper_Form_Element_Radio('commentInput', array(
        'top' => '评论框在评论列表上方',
        'bottom' => '评论框在评论列表下方'
    ), 'bottom', _t('评论框位置'), _t('评论框就是发表评论的区域，评论列表就是已发表的评论区域'));
    $form->addInput($commentInput);

    //  评论日期时间格式
    $commentDateFormat = new Typecho_Widget_Helper_Form_Element_Radio('commentDateFormat', array(
        'format1' => '2020年04月23日 13:09',
        'format2' => '2020-04-23 13:09',
        'format3' => 'April 23rd, 2020 at 01:09 pm',
        'format4' => '时间间隔（3天前）'
    ), 'format1', _t('评论日期时间格式'), _t('时间间隔的单位会根据间隔长短变化，不到一分钟的单位为 秒，一分钟以上、一小时以下的单位为 分钟，一小时以上、一天以下的单位为 小时，一天以上的单位为 天，'));
    $form->addInput($commentDateFormat);

    //  Emoji面板
    $emojiPanel = new Typecho_Widget_Helper_Form_Element_Radio('emojiPanel', array(
        'on' => '开启',
        'off' => '关闭'
    ), 'off', _t('评论区Emoji表情选择面板'), _t('开启后会在评论区的评论内容输入框下方显示一个 Emoji表情按钮，点击后会显示一个 Emoji表情面板。'));
    $form->addInput($emojiPanel);

    //  导航栏
    $navBar = new Typecho_Widget_Helper_Form_Element_Checkbox('navbar', array(
        'showClassification' => _t('显示文章分类')
    ), null, _t('导航栏'));
    $form->addInput($navBar->multiMode());

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

//  日期格式化
function dateFormat($date, $options = 'format1') {
    if ($options == 'format1') {
        return date('Y年m月d日 H:i', $date);
    }
    if ($options == 'format2') {
        return date('Y-m-d H:i', $date);
    }
    if ($options == 'format3') {
        return date('F jS, Y \a\t h:i a', $date);
    }
    if ($options == 'format4') {
        $time = time() - $date;
        if ($time < 60) {
            return $time . '秒前';
        }else if ($time > 60 && $time < 3600) {
            return round($time / 60, 0) . '分钟前';
        }else if ($time > 3600 && $time < 86400) {
            return round($time / 3600, 0) . '小时前';
        }else {
            return round($time / 86400, 0) . '天前';
        }
    }
}

//  获取父评论的姓名
function reply($parent) {
    if ($parent == 0) {
        return '';
    }

    $db = Typecho_Db::get();
    $commentInfo = $db->fetchRow($db->select('author,status,mail')->from('table.comments')->where('coid = ?', $parent));
    $link = '<a class="parent" href="#comment-' . $parent . '">@' . $commentInfo['author'] .  '</a>';
    return $link;
}

//  获取点赞数量
function agreeNum($cid) {
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('agree', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `agree` INT(10) NOT NULL DEFAULT 0;');
    }

    $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
    $AgreeRecording = Typecho_Cookie::get('typechoAgreeRecording');
    if (empty($AgreeRecording)) {
        Typecho_Cookie::set('typechoAgreeRecording', json_encode(array(0)));
    }

    return array(
        'agree' => $agree['agree'],
        'recording' => in_array($cid, json_decode(Typecho_Cookie::get('typechoAgreeRecording')))?true:false
    );
}

//  点赞
function agree($cid) {
    $db = Typecho_Db::get();
    $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));

    $agreeRecording = Typecho_Cookie::get('typechoAgreeRecording');
    if (empty($agreeRecording)) {
        //  如果 cookie 不存在就创建 cookie
        Typecho_Cookie::set('typechoAgreeRecording', json_encode(array($cid)));
    }else {
        $agreeRecording = json_decode($agreeRecording);
        if (in_array($cid, $agreeRecording)) {
            return $agree['agree'];  //  如果当前文章的 cid 在 cookie 中就不再往下执行
        }
        array_push($agreeRecording, $cid);  //  添加点赞文章的 cid
        Typecho_Cookie::set('typechoAgreeRecording', json_encode($agreeRecording));
    }

    $db->query($db->update('table.contents')->rows(array('agree' => (int)$agree['agree'] + 1))->where('cid = ?', $cid));
    $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
    return $agree['agree'];
}

//  生成文章头图背景颜色
function headerImageBgColor($color) {
    if ($color == null or $color == '') {
        return '#CCCCCC';
    }

    $bgColor = array(
        'random' => 'rgb(' . mt_rand(0, 255) . ',' . mt_rand(0, 255) . ',' . mt_rand(0, 255) . ')',
        'gray' => '#CCCCCC',
        'white' => '#FFFFFF'
    );
    return $bgColor[$color];
}

//  根据设置获取文章头图
function postImg($a) {
    if (!$a->fields->imageSource) {
        $img = getPostImg($a);
        return $img == 'none'?false:$img;
    }
    switch ($a->fields->imageSource) {
        case 'url':
            return $a->fields->thumb?$a->fields->thumb:false;
            break;
        case 'article':
            $img = getPostImg($a);
            return $img == 'none'?false:$img;
            break;
        default:
            return false;
            break;
    }
}

//  获取文章的第一张图片
function getPostImg($archive) {

    $img = array();
    preg_match_all("/<img.*?src=\"(.*?)\".*?\/?>/i", $archive->content, $img);
    if (count($img) > 0 && count($img[0]) > 0) {
        $img_url = $img[1][0];
        return $img_url;
    } else {
        return 'none';
    }
}

//  获取颜色配置
function color($cfg) {
    $color = array(
        'dark' => array(
            'bar' => 'navbar-dark bg-dark',
            'btn' => 'btn-secondary',
            'link' => 'text-secondary',
            'listTag' => 'badge-secondary',
            'tag' => 'tag-dark',
            'name' => 'dark',
            'btnOutline' => 'btn-outline-secondary'
        ),
        'primary' => array(
            'bar' => 'navbar-dark bg-primary',
            'btn' => 'btn-primary',
            'link' => 'text-primary',
            'listTag' => 'badge-primary',
            'tag' => 'tag-primary',
            'name' => 'primary',
            'btnOutline' => 'btn-outline-primary'
        ),
        'info' => array(
            'bar' => 'navbar-dark bg-info',
            'btn' => 'btn-info',
            'link' => 'text-info',
            'listTag' => 'badge-info',
            'tag' => 'tag-info',
            'name' => 'info',
            'btnOutline' => 'btn-outline-info'
        ),
        'success' => array(
            'bar' => 'navbar-dark bg-success',
            'btn' => 'btn-success',
            'link' => 'text-success',
            'listTag' => 'badge-success',
            'tag' => 'tag-success',
            'name' => 'success',
            'btnOutline' => 'btn-outline-success'
        ),
        'light' => array(
            'bar' => 'navbar-light bg-light',
            'btn' => 'btn-secondary',
            'link' => 'text-secondary',
            'listTag' => 'badge-secondary',
            'tag' => 'tag-dark',
            'name' => 'light',
            'btnOutline' => 'btn-outline-secondary'
        )
    );

    if ($cfg == null) {
        return $color['light'];
    }
    return $color[$cfg];
}