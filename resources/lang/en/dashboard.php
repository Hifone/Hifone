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
            'title'      => 'System State',
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

    'content' => [
        'content'       => 'Content',
        'thread_title'  => 'Thread Title',
        'node'          => 'Node',
        'created_by'    => 'Created by',
        'reply_count'   => 'Reply Count',
        'created_at'    => 'Created at',
        'actions'       => 'Actions',
        'reply'         => 'Reply',
    ],

    'pages' => [
        'pages'   => 'Page',
        'slug'    => 'Slug',
        'title'   => 'Title',
        'body'    => 'Content',
        'add'     => [
            'title'   => 'New Page',
            'success' => 'Page is created successfully.',
        ],
        'edit'     => [
            'title'   => 'Edit Page',
            'success' => 'Page is successfully updated.',
        ],
    ],
    'photos' => [
        'photos' => 'Photo',
    ],
    'threads'  => [
        'threads' => 'Threads',
        'add'     => [
            'title'   => 'New Thread',
            'success' => 'Thread is created successfully.',
        ],
        'edit' => [
            'title'   => 'Edit Thread',
            'success' => 'Thread Information is successfully updated.',
        ],
    ],
    'replies' => [
        'replies' => 'Replies',
        'edit'    => [
            'title' => 'Edit Reply',
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
        'nodes'           => 'Nodes',
        'name'            => 'Name',
        'parent'          => 'Parent Node',
        'root'            => 'Root Node',
        'status_name'     => 'Status',
        'description'     => 'Description',
        'icon'            => 'Node Icon',
        'slug'            => 'Slug',
        'slug_help'       => 'Slug Help',
        'select_category' => 'Select Category',
        'add'             => [
            'title'   => 'New Node',
            'success' => 'Node is created successfully.',
            'failure' => 'Node creation failed',
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
    ],

    'adblocks' => [
        'adblocks' => 'Adblocks',
        'name'     => 'Name',
        'slug'     => 'Slug',
        'add'      => [
            'title'   => 'New Adblock',
            'success' => 'Adblock is created successfully.',
        ],
        'edit' => [
            'success' => 'Adblock information is updated.',
        ],
    ],
    'adspaces' => [
        'adspaces' => 'Adspaces',
        'name'     => 'Name',
        'position' => 'Slug',
        'route'    => 'Route',
        'add'      => [
            'title'   => 'New Adspace',
            'success' => 'Adspace is created successfully.',
        ],
        'edit' => [
            'success' => 'Adspace information is updated.',
        ],
    ],

    'advertisements' => [
        'advertisements' => 'Advertisements',
        'name'           => 'Name',
        'body'           => 'Body',
        'add'            => [
            'title'   => 'New Advertisement',
            'success' => 'Advertisement is created successfully.',
        ],
        'edit' => [
            'success' => 'Advertisement information is updated.',
        ],
    ],

    'tips' => [
        'tips'        => 'Tips',
        'body'        => 'Body',
        'status'      => 'Show?',
        'add'         => [
            'title'   => 'New Tip',
            'success' => 'Tip is created successfully.',
            'message' => 'There aren\'t any tips.',
        ],
        'edit' => [
            'title'   => 'Edit Tip',
            'success' => 'Tip information is updated.',
        ],
        'delete' => [
            'success' => 'The tip has been deteted.',
            'failure' => 'The tip could not be deleted, please try again.',
        ],
    ],

    'locations' => [
        'locations'        => 'Hot Cities',
        'name'             => 'Name',
        'add'              => [
            'title'   => 'New city',
            'success' => 'City is created successfully.',
            'message' => 'There aren\'t any cities.',
        ],
        'edit' => [
            'title'   => 'Edit city',
            'success' => 'City information is updated.',
        ],
        'delete' => [
            'success' => 'The city has been deleted.',
            'failure' => 'The location could not be deleted, please try again.',
        ],
    ],

    'users' => [
        'users'       => 'Users',
        'user'        => ':email, registed on :date',
        'username'    => 'Username',
        'email'       => 'Email',
        'password'    => 'Password',
        'description' => 'User list',
        'search'      => 'Search',
        'roles'       => 'Roles',
        'add'         => [
            'title'   => 'Create',
            'success' => 'User is created successfully.',
            'failure' => 'The user could not be created, please try again.',
        ],
        'edit'     => [
            'title'   => 'Edit User',
            'success' => 'User information is updated.',
        ],
    ],

    'links' => [
        'links'       => 'Userful links',
        'title'       => 'Site name',
        'url'         => 'Url',
        'cover'       => 'LOGO',
        'description' => 'Description',
        'status'      => 'Show?',
        'add'         => [
            'title'   => 'New Link',
            'success' => 'Link is created successfully.',
            'message' => 'There aren\'t any links.',
        ],
        'edit' => [
            'title'   => 'Edit Link',
            'success' => 'Link is created successfully.',
        ],
        'delete' => [
            'success' => 'The link has been deleted.',
            'failure' => 'The link could not be deleted, please try again.',
        ],
    ],

    // Settings
    'settings' => [
        'settings'    => 'Settings',
        'general'     => [
            'general'                      => 'General',
            'images-only'                  => 'Only images may be uploaded.',
            'too-big'                      => 'The image you upload is too large. Images should be smaller than :size',
            'site_name'                    => 'Site Name',
            'site_domain'                  => 'Site Domain',
            'site_logo'                    => 'Site logo',
            'site_cdn'                     => 'CDN Address',
            'site_about'                   => 'About Us',
            'new_thread_dropdowns'         => 'New thread dropdowns',
            'footer_html'                  => 'Footer(Support HTML)',
            'captcha_login_disabled'       => 'Disable Captcha for Login',
            'captcha_register_disabled'    => 'Disable Captcha for Registration',
            'logo'                         => 'Logo',
            'logo_help'                    => 'The size of 90*40 is recommended.',
        ],
        'localization' => [
            'localization' => 'Site Language',
            'language'     => 'Select Language',
            'timezone'     => 'Select Timezone',
        ],
        'customization' => [
            'customization' => 'Homepage Route',
            'controller'    => 'Controller',
            'method'        => 'Method',
        ],
        'stylesheet' => [
            'stylesheet' => 'Stylesheet',
            'custom_css' => 'Custom Stylesheet',
        ],
        'aboutus' => [
            'aboutus'    => 'About Us',
            'version'    => 'Hifone version',
            'php'        => 'PHP version',
            'webserver'  => 'Webserver',
            'db'         => 'Database driver',
            'cache'      => 'Cache driver',
            'session'    => 'Session driver',
            'team'       => 'Development Team',
        ],
        'edit' => [
            'success' => 'Settings are updated.',
            'failure' => 'Settings could not be saved.',
        ],
    ],

    // Sidebar footer
    'help'        => 'Help',
    'home'        => 'Home',
    'logout'      => 'Sign out',

];
