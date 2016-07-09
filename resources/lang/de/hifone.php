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
    'excellent'        => 'Ausgezeichnet',
    'search'           => 'Suche',
    'logout'           => 'Abmelden',
    'logout_confirm'   => 'Sicher, das du dich abmelden willst?',
    'signup'           => 'Registrierung',
    'noitem'           => 'Keine Daten vorhanden',
    'markdown_support' => 'Bitte nutze MARKDOWN für den Textaufbau',
    'at'               => 'auf',
    'view_count'       => 'Views',
    'follow'           => 'Folgen',
    'favorite'         => 'Favorit',
    'like'             => 'Like',
    'unlike'           => 'Dislike',
    'deleted'          => 'Der Inhalt wurde gelöscht.',
    'awesome'          => 'Herzlichen Glückwunsch, ',
    'whoops'           => 'Ohoh... ',
    'success'          => 'Der Vorgang war erfolgreich!',
    'failure'          => 'Der Vorgang ist fehlgeschlagen!',
    'powered_by'       => 'Copyright &copy; 2015-2016 <a href="http://hifone.com">Hifone</a> ',
    'feed'             => 'Feed',
// 节点
    'nodes'            => [
        'all'               => 'Forennavigation',
        'current'           => 'Aktuelles Forum',
        'same_node_threads' => 'Vergleichbare Threads',
    ],

// 话题
    'threads' => [
        'threads'        => 'Threads',
        'title'          => 'Titel',
        'body'           => 'Text',
        'add'            => 'Neuen Thread erstellen',
        'list'           => 'Threadliste',
        'recent'         => 'Neueste',
        'excellent'      => 'Ausgezeichnet',
        'like'           => 'Beliebt',
        'unanswered'     => 'Unbeantwortet',
        'stick'          => 'Sticky',
        'recommended'    => 'Empfohlen',
        'last_reply_by'  => 'letzte Antwort von',
        'more'           => 'mehr',
        'noitem'         => 'Keine Threads vorhanden',
        'is_excellent'   => 'Dieser Thread hat sehr viele Antworten',

        // Share
        'share2weibo'    => 'Teile mit weibo',
        'share2twitter'  => 'Teile mit Twitter',
        'share2google'   => 'Teile mit Google Plus',
        'share2facebook' => 'Teile mit Facebook',

        // Create or Edit
        'pick_node'      => 'Wähle ein Forum',
        'mark_excellent' => 'Setze Ausgezeichnet',
        'mark_stick'     => 'Setze Sticky',
        'mark_sink'      => 'Setze Sink??',
    ],

// 备注
    'appends' => [
        'appends' => 'Bemerkung',
        'content' => 'Bemerkung Inhalt',
        'notice'  => 'Hinweis, diese Funktion wird es erlauben allen, die an dieser Diskussion teilgenommen haben benachrichtigungen zu senden.',
    ],

// 收藏
    'favorites' => [
        'favorites' => 'Favoriten',
        'noitem'    => 'Es sind noch keine Favoriten vorhanden.',
    ],

// 回复
    'replies' => [
        'replies'        => 'Antworten',
        'add'            => 'Antwort verfassen',
        'body'           => 'Text',
        'recent'         => 'Aktuelle Antworten',
        'total'          => 'Antowrten Gesamt',
        'noitem'         => 'Es gibt noch keine Antowrt',
        'login_required' => 'Um zu Antworten musst du dich anmelden.',
    ],

// 图片
    'photos' => [
        'drag_drop' => 'Um Bilddateien hinzuzufügen nutze Drag & Drop, <a class="btn-upload" href="javascript:void(0);">öffne die Datei</a> oder kopiere es aus der Zwischenablage.',
    ],

// Tags
    'tags' => [
        'tags'      => 'Tags',
        'name'      => 'Tag-Name',
        'hot'       => 'Beliebte Tags',
        'tags_help' => 'Mehrere Tags werden mit Komma (,) getrennt.',
    ],

// 用户
    'users' => [
        'users'                     => 'Benutzer',
        'id'                        => 'ID',
        'username'                  => 'Benutzername',
        'email'                     => 'E-Mail',
        'avatar'                    => 'Avatar',
        'nickname'                  => 'Nickname',
        'company'                   => 'Firma',
        'score'                     => 'Punkte',
        'location'                  => 'Ort',
        'location_help'             => 'Bitte gebe den Ort richtig an.',
        'blog'                      => 'Blog',
        'edit'                      => 'Profil bearbeiten',
        'block'                     => 'Blockieren',
        'unblock'                   => 'Blockieren rückgängig',
        'role'                      => 'Rolle',
        'info'                      => 'Persönliche Informationen',
        'is_banned'                 => 'verweilt in Banncity',
        'total'                     => 'Registrierte Benutzer',
        'list'                      => 'Benutzerliste',
        'create'                    => 'Erstelle dir ein Konto',
        'followers'                 => 'Follower',
        'signature'                 => 'Signatur',
        'bio'                       => 'Biografie',
        'password'                  => 'Passwort',
        'password_confirmation'     => 'Passwort Prüfung',
        'website'                   => 'Website',
        'profile'                   => 'Mein Profil',
        'favorites'                 => 'Favoriten',
        'credits'                   => 'Credits',
        'locale'                    => 'Sprache',

    ],

// 通知
    'notifications' => [
        'my'                          => 'Benachrichtigungen',
        'deleted'                     => 'Die Benachrichtigung wurde gelöscht.',
        'noitem'                      => 'Es gibt keine Benachrichtigungen!',
        'thread_new_reply'            => 'hat auf dein Thema geantwortet:',
        'thread_mention'              => 'hat dich in einem Thread erwähnt:',
        'thread_favorite'             => 'fügte einen Thread Favorit hinzu:',
        'thread_follow'               => 'Folgt deinem Thread',
        'thread_like'                 => 'hat deinen Thread geliked',
        'thread_mark_excellent'       => 'empfiehlt deinen Thread',
        'thread_move'                 => 'hat deinen Thread verschoben',
        'followed_thread_new_reply'   => 'kommentierte deinem gefolgtem Thread:',
        'followed_thread_new_append'  => 'hat eine neue Bemerkung zu deinem Thread hinzugefügt:',
        'followed_user_new_thread'    => 'hat einen neuen Thread erstellt',
        'commented_thread_new_append' => 'hat eine bemerkung hinzugefügt',
        'user_follow'                 => 'Folgt ihnen nun',
        'reply_like'                  => 'hat eine deiner Antworten geliked:',
        'reply_mention'               => 'hat dich in einer Antwort erwähnt:',
        'credit_register'             => 'hat Credits für die Registrierung erhalten',
        'credit_login'                => 'hat Credits für den täglichen login erhalten',
    ],

//Pm
    'pms'   => [
        'pms'       => 'PN',
        'recipient' => 'Empfänger',
    ],

//积分
    'credits' => [
        'credits' => 'Credits',
        'mine'    => 'Meine Punkte',
        'time'    => 'Zeit',
        'type'    => 'Typ',
        'reward'  => 'Betrag',
        'balance' => 'Kontostand',
    ],

// 小贴士
    'tips' => [
        'tips' => 'Zufälliger Tipp',
    ],

// 友情链接
    'links' => [
        'links' => 'Links',
    ],

// 统计
    'stats' => [
        'title'   => 'Statistiken',
        'users'   => 'Benutzer',
        'threads' => 'Threads',
        'replies' => 'Antworten',
    ],

    'captcha' => [
        'captcha' => 'Captcha',
        'refresh' => 'Captcha neu laden',
        'failure' => 'Captcha wurde falsch eingegeben',
    ],

// 登录
    'login' => [
        'login'                => 'Anmelden',
        'username'             => 'Benutzername',
        'login_placeholder'    => 'Benutzername oder E-Mail Adresse',
        'password'             => 'Passwort',
        'auth_prompt'          => 'Hallo, bitte melde dich an',
        'remember'             => 'Anmeldung merken',
        'invalid'              => 'Benutzername oder Passwort falsch.',
        'success'              => 'Anmeldung erfolgreich!',
        'success_oauth'        => 'Du hast dich mit :provider angemeldet.',
        'tips'                 => '',
    ],
];
