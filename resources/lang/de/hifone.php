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

// Global
    'home'             => 'Home',
    'excellent'        => 'Ausgezeichnet',
    'search'           => 'Suche',
    'dashboard'        => 'Admin',
    'logout'           => 'Abmelden',
    'logout_confirm'   => 'Sicher, das du dich abmelden willst?',
    'signup'           => 'Registrierung',
    'noitem'           => 'Keine Daten vorhanden',
    'markdown_support' => 'Bitte nutze MARKDOWN für den Textaufbau',
    'at'               => 'am',
    'view_count'       => 'Views',
    'follow'           => 'Folgen',
    'unfollow'         => 'Nicht mehr Folgen',
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
    'registered_users' => 'Schon registriert?',
    'ranking'          => 'Platzierung',
    'member'           => 'Mitglied',

// Nodes
    'nodes'            => [
        'all'               => 'Forennavigation',
        'current'           => 'Aktuelles Forum',
        'same_node_threads' => 'Vergleichbare Threads',
    ],

// Threads
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
        'login_needed'   => 'Um Antworten zu verfassen, musst du dich <a class="btn btn-success" href="/auth/login">Anmelden</a>. Wenn du noch keinen Account hast, <a class="btn btn-primary" href="/auth/register">Registriere</a> dich.',
        'thread_count'   => 'Ingesamt :threads Threads',

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
        // Posting Tips
        'posting_tips'   => [
            'title'     => 'Tipps für Threaderstellung',
            'pt1_title' => 'Thread Titel',
            'pt1_desc'  => 'Bitte Beschreibe die wichtigsten Punkte deines Threads im Titel',
            'pt2_title' => 'Wähle ein Forum',
            'pt2_desc'  => 'Bitte wähle das richtige Forum für deinen Thread. Je genauer der Thread in das Forum passt, desto nützlicher werden die Antworten.',
            'pt3_title' => 'Text',
            'pt3_desc'  => 'Hifone unterstützt die <span style="font-family: Consolas, \'Panic Sans\', mono"><a href="https://help.github.com/articles/github-flavored-markdown" target="_blank">GitHub Flavored Markdown</a></span> Text Markup-Syntax. Für eine Echtzeit-Vorschau, klicke auf die Vorschau schaltfläche über deinen Text.',
        ],
        //Community Guidelines
        'community_guidelines' => [
            'title'     => 'Community-Richtlinien',
            'cg1_title' => 'Respektiere die Urheberrechte',
            'cg1_desc'  => 'Bitte postet keine Links zu illegalen Inhalten. Dies beinhaltet Software, Musik, Filme, usw.',
            'cg2_title' => 'Freundlichkeit und Unterstützung',
            'cg2_desc'  => 'Sei immer freundlich und versuche den anderen in der Commity mit Rat und Tat zur Seite zu stehen.',
        ],
        'insert_code'  => 'Code einfügen',
        'upload_image' => 'Bild hochladen',
    ],

// Appends
    'appends' => [
        'appends' => 'Bemerkung',
        'content' => 'Bemerkung Inhalt',
        'notice'  => 'Hinweis, diese Funktion wird es erlauben allen, die an dieser Diskussion teilgenommen haben benachrichtigungen zu senden.',
    ],

// Favorites
    'favorites' => [
        'favorites' => 'Favoriten',
        'noitem'    => 'Es sind noch keine Favoriten vorhanden.',
    ],

// Replies
    'replies' => [
        'replies'        => 'Antworten',
        'add'            => 'Antwort verfassen',
        'body'           => 'Text',
        'recent'         => 'Aktuelle Antworten',
        'total'          => 'Antowrten Gesamt',
        'noitem'         => 'Es gibt noch keine Antowrt',
        'login_required' => 'Um zu Antworten musst du dich anmelden.',
    ],

// Photos
    'photos' => [
        'drag_drop'     => 'Um Bilddateien hinzuzufügen nutze Drag & Drop, <a class="btn-upload" href="javascript:void(0);">öffne die Datei</a> oder kopiere es aus der Zwischenablage.',
        'markdown_desc' => 'Markown Hilfe',
    ],

// Tags
    'tags' => [
        'tags'      => 'Tags',
        'name'      => 'Tag-Name',
        'hot'       => 'Beliebte Tags',
        'tags_help' => 'Mehrere Tags werden mit Komma (,) getrennt.',
    ],

// Users
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
        'location_help'             => 'Bitte gebe die exakte Stadt an.',
        'blog'                      => 'Blog',
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
        'edit_profile'              => 'Profil bearbeiten',
        'edit_avatar'               => 'Avatar bearbeiten',
        'upload_avatar'             => 'Neuen Avatar hochladen',
        'upload_avatar_help'        => 'Avatar nur als JPG oder PNG hochladen. Maximale Dateigröße: 2Mb',
        'password_settings'         => 'Passwort Einstellungen',
        'password_current'          => 'Aktuelles Passwort angeben',
        'password_new'              => 'Gib das neue Passwort ein',
        'password_new_confirmation' => 'Gib das neue Passwort erneut ein',
        'password_update'           => 'Passwort ändern',
        'select_language'           => 'Sprache auswählen',
        'register_date'             => 'Reg.-Datum:',
        'add'                       => [
            'title'   => 'Create',
            'success' => 'User is created successfully.',
            'failure' => 'The user could not be created, please try again.',
        ],
        'edit'     => [
            'title'   => 'Profil bearbeiten',
            'success' => 'User information is updated.',
        ],
    ],

// Notifications
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

// Pm
    'pms'   => [
        'pms'        => 'PN',
        'recipient'  => 'Empfänger',
        'new_pm'     => 'Neue PN',
        'view_inbox' => 'Mein Posteingang',
        'nav_create' => 'PN senden',
        'nav_inbox'  => 'Posteingang',
        'nav_outbox' => 'Postausgang',
    ],

// Credits
    'credits' => [
        'credits'         => 'Credits',
        'mine'            => 'Meine Credits',
        'time'            => 'Zeit',
        'type'            => 'Typ',
        'reward'          => 'Betrag',
        'balance'         => 'Kontostand',
        'balance_current' => 'Aktueller Kontostand:',
    ],

// Tips
    'tips' => [
        'tips' => 'Zufälliger Tipp',
    ],

// Links
    'links' => [
        'links' => 'Links',
    ],

// Stats
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

// Login
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
        'account_available'    => 'Wenn du schon einen Account registriert hast, oder dich mit Google Auth anmelden willst klicke <a href="/auth/login">Login</a>.',
        'login_with_oauth'     => 'Anmelden mit alternativ Anbieter',
        //OAuth Strings
        'oauth' => [
            'unbound' => 'Verbindung zu :provider trennen',
            'bound'   => 'Verbinden zu :provider',
            //OAuth Messages for Login
            'login' => [
                'note' => 'Nach einem erfolgreichem Login, wird der :provider Account für :name mti dem Login verbunden.',
            ],
            //OAuth Landing Page
            'landing' => [
                'title'    => 'Fremdanbieter Login',
                'welcome'  => ', um deine Registrierung abschließen zu können, wähle aus folgenden Möglichkeiten:',
                'choice_1' => '1. Vorhandener Account',
                'button_1' => 'Login',
                'choice_2' => '2. Neuer Account',
                'button_2' => 'Auto Registrierung',
                'note'     => 'Diese 2 Möglichkeiten erstellen aus deinem :provider Account :name automatisch einen Account in Hifone.',
            ],
            'errors' => [
                'invalidstate' => 'Authentifizierung fehlgeschlagen.',
            ],
        ],
    ],

    // Footer
    'footer' => [
        'about'   => 'Über',
        'contact' => 'Kontakt',
        'faq'     => 'FAQ',
    ],
];
