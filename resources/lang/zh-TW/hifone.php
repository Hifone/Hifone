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

// 全域設定
    'home'                => '首頁',
    'excellent'           => '精華區',
    'search'              => '搜尋',
    'dashboard'           => '控制台',
    'logout'              => '登出',
    'logout_confirm'      => '你確定要登出嗎？',
    'signup'              => '註冊',
    'noitem'              => '暫時沒有資料',
    'markdown_support'    => '請使用 Markdown 撰寫內容',
    'at'                  => '於',
    'view_count'          => '閱讀',
    'follow'              => '關注',
    'unfollow'            => '取消關注',
    'favorite'            => '收藏',
    'like'                => '讚',
    'unlike'              => '取消讚',
    'deleted'             => '訊息以被刪除。',
    'awesome'             => '恭喜，',
    'whoops'              => '很遺憾，',
    'success'             => '操作成功！',
    'failure'             => '操作失敗！',
    'powered_by'          => 'Copyright &copy; 2015-2016 <a href="http://hifone.com">Hifone</a> ',
    'feed'                => 'Feed',
    'registered_users'    => '已註冊用户請',
    'ranking'             => '排行榜',
    'member'              => '的會員',
    'yes'                 => 'Yes',
    'error_occurred'      => 'An error occurred',
    'content_empty'       => 'Content is empty',
    'loading'             => 'Loading...',
    'uploading_file'      => 'Uploading file...',
    'action_title'        => 'Confirm your Action',
    'action_text'         => 'Are you sure you want to do this?',

// 節點
    'nodes'            => [
        'all'               => '頁面導覽',
        'current'           => '目前頁面',
        'same_node_threads' => '相同頁面推薦',
    ],

// 话题
    'threads' => [
        'threads'        => '文章',
        'title'          => '標題',
        'body'           => '內容',
        'add'            => '發表新文章',
        'list'           => '文章列表',
        'recent'         => '最新文章',
        'excellent'      => '優良文章',
        'like'           => '最多讚',
        'unanswered'     => '等待回覆',
        'stick'          => '置頂',
        'recommended'    => '推薦',
        'last_reply_by'  => '回覆',
        'more'           => '更多',
        'noitem'         => '暫無文章',
        'is_excellent'   => '該文章已經被設定為優良文章！',
        'login_needed'   => '需要 <a class="btn btn-success" href="/auth/login">登入</a> 后方可回复, 如果你还没有账号请点击这里 <a class="btn btn-primary" href="/auth/register">注册</a>。',
        'thread_count'   => '共有 :threads 個討論主题',

        // Share
        'share2weibo'    => '分享到微博',
        'share2twitter'  => '分享到 Twitter',
        'share2google'   => '分享到 Google Plus',
        'share2facebook' => '分享到 Facebook',

        // Create or Edit
        'pick_node'      => '選擇頁面',
        'mark_excellent' => '設定為推薦主題',
        'mark_stick'     => '置頂此主题',
        'mark_sink'      => '下沉此主题',
        // Posting Tips
        'posting_tips'   => [
            'title'     => '新文章提示',
            'pt1_title' => '文章標題',
            'pt1_desc'  => '請在標題中描述內容摘要。',
            'pt2_title' => '選擇頁面',
            'pt2_desc'  => '請問你的主題選擇一個頁面，切當的分類會讓你發布的文章更有用。',
            'pt3_title' => '內文',
            'pt3_desc'  => 'Hifone 支持 <span style="font-family: Consolas, \'Panic Sans\', mono"><a href="https://help.github.com/articles/github-flavored-markdown" target="_blank">GitHub Flavored Markdown</a></span> 內文標記語法。你可以在頁面下方即時預覽內文的實際顯示結果。',
        ],
        //Community Guidlines
        'community_guidelines' => [
            'title'     => '社區指導原則',
            'cg1_title' => '尊重原創',
            'cg1_desc'  => '請不要在 Hifone 發布任何盜版連結，包括軟體、音樂、電影等。',
            'cg2_title' => '友好互助',
            'cg2_desc'  => '保持對播生人的友善，用知識去幫助别人。',
        ],
        'insert_code'  => '插入代碼',
        'upload_image' => '上傳圖片',
    ],

// 备注
    'appends' => [
        'appends' => '備註',
        'content' => '備註內容',
        'notice'  => '新增備註, 使用此功能的话, 會給所有參加過討論的人發出通知。',
    ],

// 收藏
    'favorites' => [
        'favorites' => '收藏',
        'noitem'    => '尚未收藏任何主题',
    ],

// 回复
    'replies' => [
        'replies'        => '回覆',
        'add'            => '發表回覆',
        'body'           => '内容',
        'recent'         => '最近的回覆',
        'total'          => '回覆總數',
        'noitem'         => '暫無回覆',
        'login_required' => '需要登入後才能發表評論。',
    ],

// 图片
    'photos' => [
        'drag_drop'     => '支援在编辑框拖曳、複製貼上或<a class="btn-upload" href="javascript:void(0);">瀏覽本機檔案</a>進行圖片上傳。',
        'markdown_desc' => '排版說明',
        'upload_error'  => '上傳檔案時發生問題',
    ],

// Tags
    'tags' => [
        'tags'      => '標籤',
        'name'      => '標籤名稱',
        'hot'       => '熱門標籤',
        'tags_help' => '請填寫標籤名稱，多個標籤之間請用「,」分隔',
    ],

// 用户
    'users' => [
        'users'                     => '使用者',
        'id'                        => 'ID',
        'username'                  => '使用者名稱',
        'email'                     => 'email',
        'avatar'                    => '大頭照',
        'avatar_upload_success'     => '大頭照更新成功',
        'nickname'                  => '暱稱',
        'company'                   => '公司',
        'score'                     => '積分',
        'location'                  => '城市',
        'location_help'             => '請用中文填寫所在城市',
        'blog'                      => '部落格',
        'block'                     => '封鎖',
        'unblock'                   => '解除封鎖',
        'role'                      => '角色',
        'info'                      => '個人訊息',
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
        'edit_profile'              => '编辑个人资料',
        'edit_avatar'               => '头像设置',
        'upload_avatar'             => '上传新头像',
        'upload_avatar_help'        => '头像支持jpg和png格式，上传的文件大小不超过 2M',
        'password_settings'         => '密码设置',
        'password_current'          => '请输入您当前的密码',
        'password_new'              => '请输入新密码',
        'password_new_confirmation' => '请再次输入新密码',
        'password_update'           => 'Update password',
        'select_language'           => 'Select Language',
        'register_date'             => '注册:',
        'add'                       => [
            'title'   => '使用者註冊',
            'success' => '使用者註冊成功',
            'failure' => '使用者註冊失敗',
        ],
        'edit'     => [
            'title'   => '個人設定',
            'success' => '使用者更新成功',
        ],
    ],

// 通知
    'notifications' => [
        'my'                          => '我的通知',
        'deleted'                     => '訊息已被删除.',
        'noitem'                      => '尚未收到訊息',
        'thread_new_reply'            => '回覆了你的文章:',
        'thread_mention'              => '在文章中提到你:',
        'thread_favorite'             => '收藏了你的文章',
        'thread_follow'               => '關注了你的文章',
        'thread_like'                 => '對你的文章按讚',
        'thread_mark_excellent'       => '推薦了你的文章',
        'thread_move'                 => '移動了你的文章',
        'followed_thread_new_reply'   => '回覆了你關注的文章:',
        'followed_thread_new_append'  => '關注的文章有新回覆',
        'followed_user_new_thread'    => '發表了新文章',
        'commented_thread_new_append' => '評論過的文章有新回覆',
        'user_follow'                 => '關注了你',
        'reply_like'                  => '對你的回覆按讚',
        'reply_mention'               => '在回覆中提到你:',
        'credit_register'             => '註冊獲得積分',
        'credit_login'                => '每日登入獲得積分',
    ],

//Pm
    'pms'   => [
        'pms'             => '站內訊息',
        'create'          => '建立新的訊息',
        'list'            => '訊息列表',
        'home'            => '私人訊息 - 概況',
        'readed'          => '已讀',
        'unreaded'        => '未讀',
        'send'            => '送出訊息',
        'pick_user'       => '選擇收件者',
        'recipient'       => '收件者',
        'recipient_error' => '錯誤的收件者',
        'new_pm'          => '建立站內訊息',
        'view_inbox'      => '查看我的收件箱',
        'nav_create'      => '發送訊息',
        'nav_inbox'       => '收件夾',
        'nav_outbox'      => '發信備份',
        'same_user_error' => '寄件者和收件者不能是同一個人',
    ],

//积分
    'credits' => [
        'credits'         => '積分',
        'mine'            => '我的積分',
        'time'            => '日期',
        'type'            => '類型',
        'reward'          => '總數',
        'balance'         => '餘額',
        'balance_current' => '目前餘額：',
    ],

// 小贴士
    'tips' => [
        'tips' => '小貼士',
    ],

// 友情链接
    'links' => [
        'links' => '友情連結',
    ],

// 统计
    'stats' => [
        'title'   => '統計資料',
        'users'   => '會員總數',
        'threads' => '文章總數',
        'replies' => '回覆數量',
    ],

    'captcha' => [
        'captcha' => '圖形驗證碼',
        'refresh' => '看不清楚，點擊圖片換一個驗證碼',
        'failure' => '驗證碼錯誤，請重新輸入',
    ],

// 登录
    'login' => [
        'login'                => '登入',
        'username'             => '使用者名稱',
        'login_placeholder'    => '使用者名稱或是 email',
        'password'             => '密碼',
        'auth_prompt'          => '您好，請先登入！',
        'remember'             => '記住',
        'invalid'              => '使用者名稱或是密碼錯誤',
        'success'              => '登入成功！',
        'success_oauth'        => '使用 :provider 帳號登入成功。',
        'tips'                 => '',
        'account_available'    => '已註冊或使用社交帳號登入，請點擊 <a href="/auth/login">這裡</a> 進行登入。',
        'login_with_oauth'     => '使用其他平台的帳號登入',
        //OAuth Strings
        'oauth' => [
            'unbound'         => '解除綁定 :provider 帳號',
            'unbound_success' => '成功解除綁定',
            'bound'           => '绑定 :provider 帳號',
            //OAuth Messages for Login
            'login' => [
                'note' => 'After successful login, your :provider Account for :name is connected with your Hifone Account.',
            ],
            //OAuth Landing Page
            'landing' => [
                'title'    => '第三方登入',
                'welcome'  => '，你好。還差最後一步就能完成註冊。請選擇：',
                'choice_1' => '1. 已有 Hifone 帳號',
                'button_1' => '直接登入',
                'choice_2' => '2. 還沒有 Hifone 帳號',
                'button_2' => '自動註冊',
                'note'     => '以上兩種方式都會自動将 :provider帳號: :name 與你的 Hifone 帳號進行綁定。',
            ],
            'errors' => [
                'InvalidState' => '認證失敗。',
            ],
        ],
    ],

    // Footer
    'footer' => [
        'about'   => '關於我們',
        'contact' => '與我們聯繫',
        'faq'     => '常見問題',
    ],
];
