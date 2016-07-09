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
        'title'       => 'Übersicht',
        'systemstate' => [
            'title'      => 'Systemstatus',
            'statistics' => 'Statistiken',
            'modules'    => 'Module',
            'system'     => 'System',
        ],
        'messages'  => [
            'title'          => 'Nachrichten',
            'newest_threads' => 'Aktuelle Threads',
            'newest_replies' => 'Neueste Antworten',
            'newest_users'   => 'Neueste Benutzer',
        ],
    ],

    'attentions' => [
        'attentions' => 'Attentions',
        'add'        => 'Attention hinzufügen',
    ],

    'content' => [
        'content' => 'Inhalt',
    ],
    'pages' => [
        'pages'   => 'Seiten',
        'slug'    => 'Slug',
        'title'   => 'Titel',
        'body'    => 'Seitentext',
        'add'     => [
            'title'   => 'Seite hinzufügen',
            'success' => 'Die Seite wurde erfolgreich hinzugefügt.',
        ],
        'edit'     => [
            'title'   => 'Seite bearbeiten',
            'success' => 'Die Seite wurde erfolgreich bearbeitet.',
        ],
    ],
    'photos' => [
        'photos' => 'Fotos',
    ],
    'threads'  => [
        'threads' => 'Threads',
        'add'     => [
            'title'   => 'Thread erstellen',
            'success' => 'Der Thread wurde erfolgreich erstellt.',
        ],
        'edit' => [
            'title'   => 'Thread bearbeiten',
            'success' => 'Der Thread wurde erfolgreich bearbeitet.',
        ],
    ],
    'replies' => [
        'replies' => 'Antworten',
        'edit'    => [
            'title' => 'Antwort bearbeiten',
        ],
    ],

    'sections' => [
        'sections'     => 'Kategorien',
        'name'         => 'Name',
        'order'        => 'Sortierung',
        'add'          => [
            'title'   => 'Kategorie hinzufügen',
            'message' => 'Es wurde keine Kategorie angelegt',
            'success' => 'Die Ketegorie wurde erfolgreich erstellt',
            'failure' => 'Die Kategorie konnte nicht angelegt werden',
        ],
        'edit' => [
            'title'   => 'Kategorie bearbeiten',
            'success' => 'Die Kategorie wurde erfolgreich geändert',
            'failure' => 'Die Kategorie konnte nicht bearbeitet werden.',
        ],
    ],
    'nodes' => [
        'nodes'        => 'Forum',
        'name'         => 'Name',
        'parent'       => 'Eltern-Forum',
        'root'         => 'root??',
        'status_name'  => 'Zustand',
        'description'  => 'Beschreibung',
        'icon'         => 'Icon',
        'slug'         => 'Slug',
        'slug_help'    => 'Schnellpfad',
        'add'          => [
            'title'   => 'Forum hinzufügen',
            'success' => 'Das Forum wurde erfolgreich angelegt',
            'failure' => 'Das Forum konnte nicht erstellt werden.',
        ],
        'edit' => [
            'title'   => 'Forum bearbeiten',
            'success' => 'Das Forum wurde erfolgreich gespeichert',
            'failure' => 'Das Forum konnte nicht bearbeitet werden.',
        ],

        'status'       => [
            0 => 'Normal',
            1 => 'Versteckt',
            2 => 'Nur für Mitglieder sichtbar',
        ],
        // Node parents
        'parents' => [
            'parents'        => 'Forum|Platte??',
            'no_nodes'       => 'Es sind keine Foren vorhanden',
            'add'            => [
                'title'   => 'Eltern-Forum erstellen',
                'success' => 'Forum Gruppe hinzugefügt.',
                'failure' => 'Es konnte keine Forengruppe erstellt werden.',
            ],
            'edit' => [
                'title'   => 'Elter-Forum bearbeiten',
                'success' => 'Forum Gruppe wurde bearbeitet.',
                'failure' => 'Die Foren-Gruppe konnte nicht bearbeitet werden.',
            ],
            'delete' => [
                'success' => 'Elter-Forum löschen',
                'failure' => 'Die Forengruppe konnte nicht gelöscht werden.',
            ],
        ],
    ],

    'adblocks' => [
        'adblocks' => 'Werbeblocks',
        'name'     => 'Name',
        'slug'     => 'Slug',
        'add'      => [
            'title'   => 'Werbeblock hinzufügen',
            'success' => 'Der Werbeblock konnte erfolgreich hinzugefügt werden.',
        ],
        'edit' => [
            'success' => 'Der Werbeblock wurde gespeichert.',
        ],
    ],
    'adspaces' => [
        'adspaces' => 'Werbeplätze',
        'name'     => 'Name',
        'position' => 'Position',
        'route'    => 'Route',
        'add'      => [
            'title'   => 'Werbeplatz hinzufügen',
            'success' => 'Der Werbeplatz wurde erstellt.',
        ],
        'edit' => [
            'success' => 'Der Werbeplatz wurde gespeichert.',
        ],
    ],

    'advertisements' => [
        'advertisements' => 'Anzeigen',
        'name'           => 'Name',
        'body'           => 'Inhalt',
        'add'            => [
            'title'   => 'Anzeige erstellen',
            'success' => 'Die Anzeige wurde erstellt.',
        ],
        'edit' => [
            'success' => 'Die Anzeige wurde gespeichert.',
        ],
    ],

    'tips' => [
        'tips'        => 'Tipps',
        'body'        => 'Text',
        'status'      => 'Status',
        'add'         => [
            'title'   => 'Tipp hinzufügen',
            'success' => 'Der Tipp wurde hinzuegfügt.',
            'message' => 'Es sind noch keine Tipps vorhanden.',
        ],
        'edit' => [
            'title'   => 'Tipp bearbeiten',
            'success' => 'Der Tipp wurde gespeichert.',
        ],
        'delete' => [
            'success' => 'Tipp löschen',
            'failure' => 'Der Tipp konnte nicht gelöscht werden.',
        ],
    ],

    'locations' => [
        'locations'        => 'Orte',
        'name'             => 'Name',
        'add'              => [
            'title'   => 'Ort hinzufügen',
            'success' => 'Ort wurde erfolgreich hinzugefügt.',
            'message' => 'Es sind noch keine Orte vorhanden.',
        ],
        'edit' => [
            'title'   => 'Ort bearbeiten',
            'success' => 'Der Ort wurde gespeichert.',
        ],
        'delete' => [
            'success' => 'Ort löschen',
            'failure' => 'Der Ort konnte nicht gelöscht werden.',
        ],
    ],

    'users' => [
        'users'       => 'Benutzer',
        'user'        => ':email, Registriert: :date',
        'username'    => 'Benutzername',
        'email'       => 'E-Mail',
        'password'    => 'Passwort',
        'description' => 'Beschreibung',
        'add'         => [
            'title'   => 'Benutzer hinzufügen',
            'success' => 'Der Benutzer wurde erstellt.',
            'failure' => 'Der Benutzer konnte nicht erstellt werden.',
        ],
        'edit'     => [
            'title'   => 'Benutzer bearbeiten',
            'success' => 'Der Benutzer wurde erfolgreich gespeichert.',
        ],
    ],

    'links' => [
        'links'       => 'Links',
        'title'       => 'Titel',
        'url'         => 'URL',
        'cover'       => 'Logo',
        'description' => 'Beschreibung',
        'status'      => 'Status',
        'add'         => [
            'title'   => 'Link hinzufügen',
            'success' => 'Der Link wurde hinzugefügt.',
            'message' => 'Es sind noch keine Links vorhanden.',
        ],
        'edit' => [
            'title'   => 'Link bearbeiten',
            'success' => 'Der Link wurde gespeichert.',
        ],
        'delete' => [
            'success' => 'Link löschen',
            'failure' => 'Der Link konnte nicht gelöscht werden.',
        ],
    ],

    // Settings
    'settings' => [
        'settings'    => 'Einstellungen',
        'general'     => [
            'general'                       => 'Allgemein',
            'images-only'                   => 'Es könnten nur Bilder hochgeladen werden.',
            'too-big'                       => 'Das Bild darf nicht größer sein als :size',
            'site_name'                     => 'Seitenname',
            'site_domain'                   => 'Seitendomain',
            'site_logo'                     => 'Seitenlogo',
            'site_cdn'                      => 'Seiten CDN',
            'site_about'                    => 'Über',
            'captcha_login_disabled'        => 'Captcha Login deaktiviert',
            'captcha_register_disabled'     => 'Captcha Registrierung deaktiviert',
            'logo'                          => 'Logo',
            'logo_help'                     => 'Das Logo darf nicht größer sein als 90*40 Pixel.',
        ],
        'localization' => [
            'localization' => 'Spracheinstellungen',
        ],
        'customization' => [
            'customization' => 'Startseiten-Routing',
            'controller'    => 'Controller',
            'method'        => 'Method',
        ],
        'stylesheet' => [
            'stylesheet' => 'Stylesheet',
            'custom_css' => 'Eigenes CSS',
        ],
        'aboutus' => [
            'aboutus'    => 'Über uns',
            'version'    => 'Software',
            'php'        => 'PHP',
            'webserver'  => 'Webserver',
            'db'         => 'Datenbank',
            'cache'      => 'Cache',
            'session'    => 'Session',
            'team'       => 'Das Team',
        ],
        'edit' => [
            'success' => 'Einstellungen wurden gespeichert.',
            'failure' => 'Einstellungen konnten nicht gespeichert werden',
        ],
    ],

    // Sidebar footer
    'help'        => 'Hilfe',
    'home'        => 'Home',
    'logout'      => 'Abmelden',

];
