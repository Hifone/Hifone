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

// 全局
    'home'             => '首页',
    'excellent'        => '精华',
    'search'           => '搜索',
    'logout'           => '退出',
    'logout_confirm'   => '你确定要退出吗?',
    'signup'           => '注册',
    'noitem'           => '暂时没有数据',
    'markdown_support' => '请使用Markdown撰写内容',
    'at'               => '于',
    'view_count'       => '阅读',
    'follow'           => '关注',
    'favorite'         => '收藏',
    'like'             => '赞',
    'unlike'           => '踩',
    'deleted'          => '信息已被删除.',
    'awesome'          => '恭喜，',
    'whoops'           => '很遗憾，',
    'success'          => '操作成功!',
    'failure'          => '操作失败!',
    'powered_by'       => 'Copyright &copy; 2015-2016 <a href="http://hifone.com">Hifone</a> ',
    'feed'             => 'Feed',
// 节点
    'nodes'            => [
        'all'               => '节点导航',
        'current'           => '当前节点',
        'same_node_threads' => '同节点推荐',
    ],

// 话题
    'threads' => [
        'threads'        => '话题',
        'title'          => '标题',
        'body'           => '内容',
        'add'            => '发表新帖',
        'list'           => '话题列表',
        'recent'         => '最新话题',
        'excellent'      => '优质帖子',
        'like'           => '最多按赞',
        'unanswered'     => '等待回复',
        'stick'          => '置顶',
        'recommended'    => '推荐',
        'last_reply_by'  => '回复',
        'more'           => '更多',
        'noitem'         => '暂无话题',
        'is_excellent'   => '该帖已被设为优质帖子！',

        // Share
        'share2weibo'    => '分享到微博',
        'share2twitter'  => '分享到 Twitter',
        'share2google'   => '分享到 Google Plus',
        'share2facebook' => '分享到 Facebook',

        // Create or Edit
        'pick_node'      => '选择节点',
        'mark_excellent' => '设为推荐主题',
        'mark_stick'     => '置顶此主题',
        'mark_sink'      => '下沉此主题',
    ],

// 备注
    'appends' => [
        'appends' => '备注',
        'content' => '备注内容',
        'notice'  => '附加备注, 使用此功能的话, 会给所有参加过讨论的人发送通知.',
    ],

// 收藏
    'favorites' => [
        'favorites' => '收藏',
        'noitem'    => '暂未收藏任何主题',
    ],

// 回复
    'replies' => [
        'replies'        => '回复',
        'add'            => '发表回复',
        'body'           => '内容',
        'recent'         => '最近回帖',
        'total'          => '回复总数',
        'noitem'         => '暂无回复',
        'login_required' => '需要登录后才能发表评论.',
    ],

// 图片
    'photos' => [
        'drag_drop' => '支持在编辑框拖拽、复制粘贴或<a class="btn-upload" href="javascript:void(0);">浏览本地文件</a>进行图片上传.',
    ],

// Tags
    'tags' => [
        'tags'      => '标签',
        'name'      => '标签名',
        'hot'       => '热门标签',
        'tags_help' => '请填写标签，多个标签之间用 , 分隔',
    ],

// 用户
    'users' => [
        'users'                     => '用户',
        'id'                        => 'ID',
        'username'                  => '用户名',
        'email'                     => '邮箱地址',
        'avatar'                    => '头像',
        'nickname'                  => '昵称',
        'company'                   => '公司',
        'score'                     => '积分',
        'location'                  => '城市',
        'location_help'             => '请用中文填写所在城市',
        'blog'                      => '博客',
        'edit'                      => '修改信息',
        'block'                     => '封锁',
        'unblock'                   => '解封',
        'role'                      => '角色',
        'info'                      => '个人信息',
        'is_banned'                 => '被封锁',
        'total'                     => '会员总数',
        'list'                      => '会员列表',
        'create'                    => '创建账号',
        'followers'                 => '粉丝',
        'signature'                 => '个性签名',
        'bio'                       => '自我介绍',
        'password'                  => '密码',
        'password_confirmation'     => '确认密码',
        'website'                   => '网址',
        'profile'                   => '我的主页',
        'favorites'                 => '我的收藏',
        'credits'                   => '我的积分',
        'locale'                    => '系统语言',

    ],

// 通知
    'notifications' => [
        'my'                          => '我的通知',
        'deleted'                     => '信息已被删除.',
        'noitem'                      => '还未收到通知!',
        'thread_new_reply'            => '回复了你的主题:',
        'thread_mention'              => '在主题中提及你:',
        'thread_favorite'             => '收藏了你的主题',
        'thread_follow'               => '关注了你的主题',
        'thread_like'                 => '赞了你的主题',
        'thread_mark_excellent'       => '推荐了你的主题',
        'thread_move'                 => '移动了你的主题',
        'followed_thread_new_reply'   => '回复了你关注的主题:',
        'followed_thread_new_append'  => '关注的话题有新备注',
        'followed_user_new_thread'    => '发表了新话题',
        'commented_thread_new_append' => '评论过的话题有新备注',
        'user_follow'                 => '关注了你',
        'reply_like'                  => '赞了你的回复',
        'reply_mention'               => '在回复中提及你:',
        'credit_register'             => '注册获得积分',
        'credit_login'                => '每日登录获得积分',
    ],

//Pm
    'pms'   => [
        'pms'       => '站内短信',
        'recipient' => '收件人',
    ],

//积分
    'credits' => [
        'credits' => '积分',
        'mine'    => '我的积分',
        'time'    => '日期',
        'type'    => '类型',
        'reward'  => '数额',
        'balance' => '余额',
    ],

// 小贴士
    'tips' => [
        'tips' => '小贴士',
    ],

// 友情链接
    'links' => [
        'links' => '友情链接',
    ],

// 统计
    'stats' => [
        'title'   => '统计信息',
        'users'   => '社区会员',
        'threads' => '主题数',
        'replies' => '回帖数',
    ],

    'captcha' => [
        'captcha' => '验证码',
        'refresh' => '看不清，点击图片刷新',
        'failure' => '验证码有误，请重新输入',
    ],

// 登录
    'login' => [
        'login'                => '登录',
        'username'             => '用户名',
        'login_placeholder'    => '用户名或邮箱地址',
        'password'             => '密码',
        'auth_prompt'          => '您好, 请先登录!',
        'remember'             => '记住',
        'invalid'              => '用户名或密码有误',
        'success'              => '成功登录!',
        'success_oauth'        => '使用 :provider 账号成功登录.',
        'tips'                 => '',
    ],
];
