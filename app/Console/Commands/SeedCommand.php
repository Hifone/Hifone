<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Console\Commands;

use Hifone\Models\Node;
use Hifone\Models\Permission;
use Hifone\Models\Role;
use Hifone\Models\Section;
use Hifone\Models\Setting;
use Hifone\Models\User;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;

class SeedCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'hifone:seed';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds Hifone with demo data.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (!$this->confirmToProceed()) {
            return;
        }

        $this->seedSettings();
        $this->seedSections();
        $this->seedNodes();
        $this->seedEntrust();

        $this->info('Database seeded with demo data successfully!');
    }

    protected function seedSections()
    {
        $sections = [
            [
                'id'    => '1',
                'name'  => 'Comunity',
                'order' => 2,
            ], [
                'id'    => '2',
                'name'  => 'Geek',
                'order' => 1,
            ], [
                'id'    => '3',
                'name'  => 'Lifestyle',
                'order' => 0,
            ],
        ];
        Section::truncate();
        Section::insert($sections);
    }

    protected function seedNodes()
    {
        $nodes = [
            [
                'name'         => 'Announcements',
                'icon'         => '',
                'section_id'   => 1,
            ], [
                'name'         => 'Internet',
                'icon'         => '',
                'section_id'   => 2,
            ], [
                'name'         => 'Discovery',
                'icon'         => '',
                'section_id'   => 3,
            ],
        ];

        Node::truncate();
        Node::insert($nodes);
    }

    /**
     * Seed the settings table.
     *
     * @return void
     */
    protected function seedSettings()
    {
        $footerHtml = <<<'FOOTER'
<div class="copyright">
    <blockquote class="pull-left">
        <p>{!! Config::get('setting.site_about') !!}</p>
        <p>{!! trans('hifone.powered_by') !!} {{ HIFONE_VERSION }} <span class="pipe">|</span>Inspired by ruby-china & phphub.</p>
    </blockquote>
</div>
<div class="pull-right hidden-sm hidden-xs">
    <p>
        <a href="/about">{{ trans('hifone.footer.about') }}</a>
        <span class="pipe">|</span>
        <a href="/contact">{{ trans('hifone.footer.contact') }}</a>
        <span class="pipe">|</span>
        <a href="/faq">{{ trans('hifone.footer.faq') }}</a>
    </p>
    <p>
        <a href="http://hifone.com/" target="_blank"><img src="/images/hifone-logo.png" border="0" height="40" data-toggle="tooltip" data-placement="top" title="Powered by Hifone" /></a>
    </p>
</div>
FOOTER;

        $defaultSettings = [
            [
                'name'  => 'site_name',
                'value' => 'Hifone Demo',
            ], [
                'name'  => 'site_domain',
                'value' => 'https://demo.hifone.com',
            ], [
                'name'  => 'site_locale',
                'value' => 'zh-CN',
            ], [
                'name'  => 'site_timezone',
                'value' => 'UTC',
            ], [
                'name'  => 'site_about',
                'value' => 'This is the demo instance of [Hifone](https://hifone.com?ref=demo). The open source forum software.',
            ], [
                'name'  => 'footer_html',
                'value' => $footerHtml,
            ], [
                'name'  => 'captcha_register_disabled',
                'value' => '0',
            ], [
                'name'  => 'captcha_login_disabled',
                'value' => '0',
            ],
        ];
        Setting::truncate();
        foreach ($defaultSettings as $setting) {
            Setting::create($setting);
        }
    }

    protected function seedEntrust()
    {
        // Create Roles
        $founder = new Role();
        $founder->name = 'Founder';
        $founder->display_name = 'Founder';
        $founder->save();

        $admin = new Role();
        $admin->name = 'Admin';
        $admin->display_name = 'Admin';
        $admin->save();

        // Create User
        $salt = str_random(6);
        $user = User::create([
                'username' => 'hifone',
                'email'    => 'hifone@hifone.com',
                'password' => md5(md5('hifone').$salt),
                'salt'     => $salt,
            ]);

        // Attach Roles to user
        $user->roles()->attach($founder->id);

        // Create Permissions
        $manageThreads = new Permission();
        $manageThreads->name = 'manage_threads';
        $manageThreads->display_name = 'Manage Threads';
        $manageThreads->save();

        $manageUsers = new Permission();
        $manageUsers->name = 'manage_users';
        $manageUsers->display_name = 'Manage Users';
        $manageUsers->save();

        // Assign Permission to Role
        $founder->perms()->sync([$manageThreads->id, $manageUsers->id]);
        $admin->perms()->sync([$manageThreads->id]);
    }
}
