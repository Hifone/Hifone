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
    'home'             => 'Home',
    'excellent'        => 'Excellent',
    'search'           => 'Search',
    'logout'           => 'Sign out',
    'logout_confirm'   => 'Are you sure want to sign out?',
    'signup'           => 'Sign up',
    'noitem'           => 'No items',
    'markdown_support' => 'Styling with Markdown is supported',
    'at'               => 'at',
    'view_count'       => 'Views',
    'follow'           => 'Follow',
    'favorite'         => 'Favorite',
    'like'             => 'Like',
    'unlike'           => 'Unlike',
    'deleted'          => 'The item has been deleted.',
    'awesome'          => 'Awesome.',
    'whoops'           => 'Whoops',
    'success'          => 'Operation ran successfully!',
    'failure'          => 'Operation ran failure!',
    'powered_by'       => 'Copyright &copy; 2015-2016 <a href="http://hifone.com">Hifone</a> ',
    'feed'             => 'Feed',
    'registered_users' => 'For registered Users:',
    'ranking'          => 'Ranking',
    'member'           => 'Member',
// 节点
    'nodes'            => [
        'all'               => 'Nodes',
        'current'           => 'Current node',
        'same_node_threads' => 'Related Threads',
    ],

// 话题
    'threads' => [
        'threads'        => 'Threads',
        'title'          => 'Title',
        'body'           => 'Content',
        'add'            => 'Add a new thread',
        'list'           => 'Threads',
        'recent'         => 'Recent',
        'excellent'      => 'Excellent',
        'like'           => 'Popular',
        'unanswered'     => 'Unanswered',
        'stick'          => 'Stick',
        'recommended'    => 'Recommended',
        'last_reply_by'  => 'by',
        'more'           => 'more',
        'noitem'         => 'There are no threads.',
        'is_excellent'   => 'The thread has been marked excellent！',
        'login_needed'   => 'For Commenting you need to <a class="btn btn-success" href="/auth/login">Login</a>. If you dont have a Account you need to <a class="btn btn-primary" href="/auth/register">Register</a>.',
        'thread_count'   => 'There are :threads Threads',

        // Share
        'share2weibo'    => 'Share to weibo',
        'share2twitter'  => 'Share to Twitter',
        'share2google'   => 'Share to Google Plus',
        'share2facebook' => 'Share to Facebook',

        // Create or Edit
        'pick_node'      => 'Select node',
        'mark_excellent' => 'Mark excelent',
        'mark_stick'     => 'Mark stick',
        'mark_sink'      => 'Mark sink',
        // Posting Tips
        'posting_tips'   => [
            'title' => 'Posting Tips',
            'pt1_title' => 'Thread Title',
            'pt1_desc' => 'Please describe the contents of the main points in the title',
            'pt2_title' => 'Select the Node',
            'pt2_desc' => 'Please select the right Node for your Thread. The right choice makes the Thread more useful.',
            'pt3_title' => 'Text',
            'pt3_desc' => 'Hifone supports the <span style="font-family: Consolas, \'Panic Sans\', mono"><a href="https://help.github.com/articles/github-flavored-markdown" target="_blank">GitHub Flavored Markdown</a></span> Text markup syntax. You can preview the text of the actual real-time rendering in the bottom of the page.',
        ],
        //Community Guidelines
        'community_guidelines' => [
            'title' => 'Community Guidelines',
            'cg1_title' => 'Respect the origin',
            'cg1_desc' => 'Please do not post links to pirated stuff on Hifone. including software, music, movies and so on.',
            'cg2_title' => 'Friendship and Mutual Assistance',
            'cg2_desc' => 'Be friendly and help others.',
        ],
        'insert_code' => 'Insert code',
        'upload_image' => 'Upload image',
    ],

// 备注
    'appends' => [
        'appends' => 'Append',
        'content' => 'Content',
        'notice'  => '附加备注, 使用此功能的话, 会给所有参加过讨论的人发送通知.',
    ],

// 收藏
    'favorites' => [
        'favorites' => 'Favorites',
        'noitem'    => 'There are no favorites.',
    ],

// 回复
    'replies' => [
        'replies'        => 'Replies',
        'add'            => 'Add a reply',
        'body'           => 'Content',
        'recent'         => 'Recent',
        'total'          => 'Total',
        'noitem'         => 'There are no replies.',
        'login_required' => 'Sign in required.',
    ],

// 图片
    'photos' => [
        'drag_drop' => 'Image files by dragging & dropping,<a class="btn-upload" href="javascript:void(0);">selecting them</a>, or pasting from the clipboard.',
        'markdown_desc' => 'Markdown Description',
    ],

// Tags
    'tags' => [
        'tags'      => 'Tags',
        'name'      => 'Tag name',
        'hot'       => 'Hot tags',
        'tags_help' => 'Comma separated',
    ],

// 用户
    'users' => [
        'users'                     => 'Users',
        'id'                        => 'ID',
        'username'                  => 'Username',
        'email'                     => 'Email',
        'avatar'                    => 'Avatar',
        'nickname'                  => 'Nickname',
        'company'                   => 'Company',
        'score'                     => 'Score',
        'location'                  => 'City',
        'location_help'             => 'Please fill in the city name exactly.',
        'blog'                      => 'Blog',
        'edit'                      => 'Settings',
        'block'                     => 'Block',
        'unblock'                   => 'Unblock',
        'role'                      => 'Role',
        'info'                      => 'Information',
        'is_banned'                 => 'been banned',
        'total'                     => 'Total',
        'list'                      => 'List',
        'create'                    => 'Create',
        'followers'                 => 'followers',
        'signature'                 => 'Signature',
        'bio'                       => 'Bio',
        'password'                  => 'Password',
        'password_confirmation'     => 'Confirm Password',
        'website'                   => 'Website',
        'profile'                   => 'Your Profile',
        'favorites'                 => 'Your Favorites',
        'credits'                   => 'Your Credits',
        'locale'                    => 'Language',
        'edit_profile'              => 'Edit Profile',
        'edit_avatar'               => 'Edit Avatar',
        'upload_avatar'             => 'Upload new Avatar',
        'upload_avatar_help'        => 'Allowed Avatar file formats: .png & .jpg. Uploaded Filesize max. 2M',
        'password_settings'         => 'Password settings',
        'password_current'          => 'Current password',
        'password_new'              => 'Enter a new password',
        'password_new_confirmation' => 'Confirm the new password',
        'password_update'           => 'Update password',
        'select_language'           => 'Select language',
        'register_date'             => 'Reg.-date:',
    ],

// 通知
    'notifications' => [
        'my'                          => 'My notifications',
        'deleted'                     => 'The item has been moved or deleted.',
        'noitem'                      => 'There are no notifications!',
        'thread_new_reply'            => 'commented on thread:',
        'thread_mention'              => 'mentioned you on:',
        'thread_favorite'             => 'added favorite thread:',
        'thread_follow'               => 'followed your thread:',
        'thread_like'                 => 'liked your thread',
        'thread_mark_excellent'       => 'recommended your thread',
        'thread_move'                 => 'moved your thread',
        'followed_thread_new_reply'   => 'commented on your followed thread:',
        'followed_thread_new_append'  => 'added a new append on thread',
        'followed_user_new_thread'    => 'added a new thread',
        'commented_thread_new_append' => 'added a new append',
        'user_follow'                 => 'followed you',
        'reply_like'                  => 'liked your reply',
        'reply_mention'               => 'mentioned you on:',
        'credit_register'             => 'added credits via register',
        'credit_login'                => 'added credits via daily login',
    ],
// Pms
    'pms'   => [
        'pms'       => 'Pm',
        'recipient' => 'Recipient',
    ],
// Credits
    'credits' => [
        'credits' => 'Credits',
        'mine'    => 'My credits',
        'time'    => 'Time',
        'type'    => 'Type',
        'reward'  => 'Reward',
        'balance' => 'Balance',
    ],

// 小贴士
    'tips' => [
        'tips' => 'Random Tip',
    ],

// 友情链接
    'links' => [
        'links' => 'Useful Links',
    ],

// 统计
    'stats' => [
        'title'   => 'Community Stats',
        'users'   => 'Users',
        'threads' => 'Threads',
        'replies' => 'Replies',
    ],

    'captcha' => [
        'captcha' => 'CAPTCHA',
        'refresh' => 'Refresh',
        'failure' => 'Incorrect captcha',
    ],

// Login
    'login' => [
        'login'                => 'Sign in',
        'username'             => 'Username',
        'login_placeholder'    => 'Username or email address',
        'password'             => 'Password',
        'auth_prompt'          => 'Sign in please.',
        'remember'             => 'Remember me',
        'invalid'              => 'Incorrect username or password.',
        'success'              => 'Signed in successfully.',
        'success_oauth'        => 'Signed in with :provider successfully.',
        'tips'                 => '',
    ],

    // Footer
    'footer' => [
        'about' => 'About',
        'contact' => 'Contact',
        'faq' => 'FAQ',
    ],
];
