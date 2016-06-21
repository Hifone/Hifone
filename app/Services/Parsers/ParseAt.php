<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Services\Parsers;

use Hifone\Models\User;
use Html;

class ParseAt
{
    public $body_parsed;
    public $users = [];
    public $usernames;
    public $body_original;

    public function parse($body)
    {
        $this->body_original = $body;

        $this->usernames = $this->getUsernames();

        count($this->usernames) > 0 && $this->users = User::whereIn('username', $this->usernames)->get();

        $this->replace();

        return $this->body_parsed;
    }

    protected function replace()
    {
        $this->body_parsed = $this->body_original;

        foreach ($this->users as $user) {
            $search = '@'.$user->username;
            $place = Html::link('u/'.$user->username, $search);
            //$place = route('users.show', $user->id);
            //$place = $search.route('users.show', $user->id);

            $this->body_parsed = str_replace($search, $place, $this->body_parsed);
        }
    }

    protected function getUsernames()
    {
        preg_match_all("/(\S*)\@([^\r\n\s]*)/i", $this->body_original, $atlist_tmp);
        $usernames = [];
        foreach ($atlist_tmp[2] as $k => $v) {
            if ($atlist_tmp[1][$k] || strlen($v) > 25) {
                continue;
            }
            $usernames[] = $v;
        }

        return array_unique($usernames);
    }
}
