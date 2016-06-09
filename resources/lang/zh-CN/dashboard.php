<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    'dashboard' => '控制台',
    'statuses'  => '系统状态',

    'attentions' => [
        'attentions' => 'Attentions',
        'add'        => '添加公告',
    ],

    'content' => [
        'content' => '内容管理',
    ],
    'pages' => [
        'pages'   => '页面',
        'slug'    => '路径',
        'title'   => '标题',
        'body'    => '内容',
        'add'     => [
            'title'   => '添加页面',
            'success' => '页面添加成功.',
        ],
        'edit'     => [
            'title'   => '编辑页面',
            'success' => '页面更新成功.',
        ],
    ],
    'photos' => [
        'photos' => '图片',
    ],
    'threads'  => [
        'threads' => '话题',
        'add'     => [
            'title'   => '添加话题',
            'success' => '话题添加成功.',
        ],
        'edit' => [
            'title'   => '编辑话题',
            'success' => '话题更新成功.',
        ],
    ],
    'replies' => [
        'replies' => '回帖',
    ],

    'sections' => [
        'sections'     => '分类',
        'name'         => '名称',
        'order'        => '排序',
        'add'          => [
            'title'   => '添加分类',
            'message' => '暂无分类',
            'success' => '分类添加成功。',
            'failure' => '分类添加失败！',
        ],
        'edit' => [
            'title'   => '编辑分类',
            'success' => '分类信息更新成功。',
            'failure' => '分类更新失败！',
        ],
    ],
    'nodes' => [
        'nodes'        => '节点管理',
        'name'         => '名称',
        'parent'       => '所属节点',
        'root'         => '根节点',
        'status_name'  => '状态',
        'description'  => '描述',
        'icon'         => '节点图标',
        'slug'         => 'Slug',
        'slug_help'    => '快捷路径',
        'add'          => [
            'title'   => '添加节点',
            'success' => '节点添加成功。',
            'failure' => '节点添加失败！',
        ],
        'edit' => [
            'title'   => '编辑节点',
            'success' => '节点信息更新成功。',
            'failure' => '节点更新失败！',
        ],

        'status'       => [
            0 => '正常',
            1 => '隐藏',
            2 => '会员可见',
        ],
        // Node parents
        'parents' => [
            'parents'        => '版块|板块',
            'no_nodes'       => '没有版块，马上添加一个吧',
            'add'            => [
                'title'   => '添加版块',
                'success' => 'Node group added.',
                'failure' => 'Something went wrong with the node group, please try again.',
            ],
            'edit' => [
                'title'   => '编辑版块',
                'success' => 'Node group updated.',
                'failure' => 'Something went wrong with the node group, please try again.',
            ],
            'delete' => [
                'success' => '版块已删除。',
                'failure' => 'The node group could not be deleted, please try again.',
            ],
        ],
    ],

    'adblocks' => [
        'adblocks' => '广告区块',
    ],
    'adspaces' => [
        'adspaces' => '广告位',
        'name'     => '名称',
        'position' => '位置标识',
        'route'    => '投放范围',
        'add'      => [
            'title'   => '添加广告位',
            'success' => '广告位添加成功.',
        ],
        'edit' => [
            'success' => '广告位信息更新成功.',
        ],
    ],

    'advertisements' => [
        'advertisements' => '广告管理',
        'name'           => '广告名称',
        'body'           => '广告内容',
        'add'            => [
            'title'   => '添加广告',
            'success' => '广告添加成功.',
        ],
        'edit' => [
            'success' => '广告信息更新成功.',
        ],
    ],

    'tips' => [
        'tips'        => '小贴士',
        'body'        => '内容',
        'status'      => '是否显示',
        'add'         => [
            'title'   => '添加小贴士',
            'success' => '小提示添加成功.',
            'message' => '当前没有小贴士.',
        ],
        'edit' => [
            'title'   => '编辑小贴士',
            'success' => '小贴士更新成功.',
        ],
        'delete' => [
            'success' => '小贴士已删除。',
            'failure' => 'The tip could not be deleted, please try again.',
        ],
    ],

    'users' => [
        'users'       => '用户管理',
        'user'        => ':email, 注册于 :date',
        'username'    => '用户名',
        'email'       => '邮箱地址',
        'password'    => '密码',
        'description' => '用户列表',
        'add'         => [
            'title'   => '添加用户',
            'success' => '用户添加成功.',
        ],
        'edit'     => [
            'title'   => '编辑用户',
            'success' => '用户更新成功.',
        ],
    ],

    'links' => [
        'links'       => '友情链接',
        'title'       => '网站名称',
        'url'         => '网址',
        'cover'       => 'LOGO地址',
        'description' => '描述',
        'status'      => '是否显示',
        'add'         => [
            'title'   => '添加友情链接',
            'success' => '友情链接添加成功.',
            'message' => '当前没有友情链接.',
        ],
        'edit' => [
            'title'   => '编辑友情链接',
            'success' => '友情链接修改成功.',
        ],
        'delete' => [
            'success' => '友情链接已删除。',
            'failure' => 'The link could not be deleted, please try again.',
        ],
    ],

    // Settings
    'settings' => [
        'settings'    => '系统设置',
        'general'     => [
            'general'     => '网站设置',
            'images-only' => 'Only images may be uploaded.',
            'too-big'     => '您上传的文件太大了。上传的图像大小应小于:size',
            'site_name'   => '网站名称',
            'site_domain' => '网址',
            'site_cdn'    => 'CDN地址',
            'site_about'  => '关于我们',
            'logo'        => 'Logo设置',
            'logo_help'   => '推荐使用90*40大小的logo.',
        ],
        'analytics' => [
            'analytics'              => '第三方统计',
            'analytics_code'         => '第三方统计代码',
            'help'                   => '页面底部可以显示第三方统计',
        ],
        'customization' => [
            'customization' => '首页路由',
            'controller'    => 'Controller',
            'method'        => 'Method',
        ],
        'security' => [
            'security'             => '安全设置',
            'allowed_captcha'      => '允许在注册和登录的时候使用验证码',
            'allowed-domains'      => '允许的域',
            'allowed-domains-help' => 'Comma separated. The domain set above is automatically allowed by default.',
        ],
        'stylesheet' => [
            'stylesheet' => '自定义样式',
            'custom_css' => '自定义样式表',
        ],
        'theme' => [
            'theme'                   => '界面设置',
            'background-color'        => 'Background Color',
            'background-fills'        => '区块填充色(组件, 故障, 页尾)',
            'banner-background-color' => '横幅背景色',
            'banner-padding'          => '横幅Padding值',
            'fullwidth-banner'        => '启用全宽横幅？',
            'text-color'              => '文字颜色',
            'dashboard-login'         => '在页尾显示 管理后台 的入口？',
            'reds'                    => '红 (用于错误类提示)',
            'blues'                   => '蓝 (用于信息类提示)',
            'greens'                  => '绿 (用于成功类提示)',
            'yellows'                 => '黄 (用于警告类提示)',
            'oranges'                 => '橙 (用于通知类提示)',
            'metrics'                 => '图表填充色',
            'links'                   => '链接',
            'per_page'                => '分页',
        ],
        'aboutus' => [
            'aboutus'    => '关于我们',
            'version'    => 'Hifone版本',
            'php'        => '服务器系统及 PHP',
            'webserver'  => 'Web服务器',
            'db'         => '数据库',
            'cache'      => '缓存驱动',
            'session'    => 'Session驱动',
            'team'       => '开发团队',
        ],
        'edit' => [
            'success' => '设置已更新.',
            'failure' => 'Settings could not be saved.',
        ],
    ],

    'notifications' => [
        'awesome' => '恭喜，',
        'whoops'  => '很遗憾，',
    ],

    // Sidebar footer
    'help'        => '帮助',
    'home'        => '首页',
    'logout'      => '退出',

];
