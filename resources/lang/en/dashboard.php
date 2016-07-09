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

    'dashboard' => 'Dashboard',
    'overview'  => [
        'title'       => 'Overview',
        'systemstate' => [
            'title'      => 'Systemstate',
            'statistics' => 'Statistics',
            'modules'    => 'Modules',
            'system'     => 'System',
        ],
        'messages'  => [
            'title'          => 'Messages',
            'newest_threads' => 'Newest Threads',
            'newest_replies' => 'Newest Replies',
            'newest_users'   => 'Newest Users',
        ],
    ],

    'attentions' => [
        'attentions' => 'Attentions',
        'add'        => '添加公告',
    ],

    'content' => [
        'content' => 'Content',
    ],
    'pages' => [
        'pages'   => 'Page',
        'slug'    => 'Slug',
        'title'   => 'Title',
        'body'    => 'Content',
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
        'edit'    => [
            'title' => '编辑回贴',
        ],
    ],

    'sections' => [
        'sections'     => 'Sections',
        'name'         => 'Name',
        'order'        => 'Order',
        'add'          => [
            'title'   => 'New Section',
            'message' => 'No section',
            'success' => 'Section is created successfully.',
            'failure' => 'Section creation failed.',
        ],
        'edit' => [
            'title'   => 'Edit Section',
            'success' => 'Section Information is successfully updated.',
            'failure' => 'Section update failure.',
        ],
    ],
    'nodes' => [
        'nodes'        => 'Nodes',
        'name'         => 'Name',
        'parent'       => 'Parent Node',
        'root'         => 'Root Node',
        'status_name'  => 'Status',
        'description'  => 'Description',
        'icon'         => 'Node Icon',
        'slug'         => 'Slug',
        'slug_help'    => '快捷路径',
        'add'          => [
            'title'   => '添加节点',
            'success' => '节点添加成功。',
            'failure' => '节点添加失败！',
        ],
        'edit' => [
            'title'   => 'Edit Node',
            'success' => 'Node information is updated.',
            'failure' => 'Node update failure.',
        ],

        'status'       => [
            0 => 'Normal',
            1 => 'Hidden',
            2 => 'Only visible by members',
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
        'adblocks' => '广告位类型',
        'name'     => '名称',
        'slug'     => '标识',
        'add'      => [
            'title'   => '添加广告位类型',
            'success' => '广告位类型添加成功.',
        ],
        'edit' => [
            'success' => '广告位类型信息更新成功.',
        ],
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

    'locations' => [
        'locations'        => '热门城市',
        'name'             => '城市名',
        'add'              => [
            'title'   => '添加热门城市',
            'success' => '热门城市添加成功.',
            'message' => '当前没有热门城市.',
        ],
        'edit' => [
            'title'   => '编辑热门城市',
            'success' => '热门城市更新成功.',
        ],
        'delete' => [
            'success' => '热门城市已删除。',
            'failure' => 'The location could not be deleted, please try again.',
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
            'title'   => '注册用户',
            'success' => '用户注册成功.',
            'failure' => '用户注册失败',
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
            'general'                      => '网站设置',
            'images-only'                  => 'Only images may be uploaded.',
            'too-big'                      => 'The image you upload is too large. Images should be smaller than :size',
            'site_name'                    => 'Site Name',
            'site_domain'                  => 'Site Domain',
            'site_logo'                    => 'Site logo',
            'site_cdn'                     => 'CDN Address',
            'site_about'                   => 'About Us',
            'captcha_login_disabled'       => 'Disable Captcha for Login',
            'captcha_register_disabled'    => 'Disable Captcha for Registration',
            'logo'                         => 'Logo设置',
            'logo_help'                    => '推荐使用90*40大小的logo.',
        ],
        'localization' => [
            'localization' => '系统语言',
        ],
        'customization' => [
            'customization' => 'Homepage Route',
            'controller'    => 'Controller',
            'method'        => 'Method',
        ],
        'stylesheet' => [
            'stylesheet' => '自定义样式',
            'custom_css' => '自定义样式表',
        ],
        'aboutus' => [
            'aboutus'    => '关于我们',
            'version'    => 'Hifone版本',
            'php'        => '服务器系统及PHP',
            'webserver'  => 'Web服务器',
            'db'         => '数据库',
            'cache'      => '缓存驱动',
            'session'    => 'Session驱动',
            'team'       => '开发团队',
        ],
        'edit' => [
            'success' => 'Settings are updated.',
            'failure' => 'Settings could not be saved.',
        ],
    ],

    // Sidebar footer
    'help'        => '帮助',
    'home'        => '首页',
    'logout'      => '退出',

];
