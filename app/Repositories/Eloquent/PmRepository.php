<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Repositories\Eloquent;

use Carbon\Carbon;
use Hifone\Repositories\Contracts\PmRepositoryInterface;
use Hifone\Models\Pm;
use Hifone\Models\Pm\Meta;

class PmRepository extends Repository implements PmRepositoryInterface
{
    /**
     * @return \Hifone\Models\Pm
     */
    public function model()
    {
        return 'Hifone\Models\Pm';
    }

    public function inbox($userId)
    {
       return $this->model->forUser($userId)->orderBy('created_at', 'desc')->paginate(10);
    }

    public function outbox($userId)
    {
        return $this->model->where('author_id',$userId)->orderBy('created_at', 'desc')->paginate(10);
    }

	public function submit($userId, $authorId, $body, $rootId = null)
	{
		
		$rootId = $rootId ?: dechex(mt_rand(0, 0x7fffffff));

        // Create the pm meta
        $meta = Meta::create([
            'body' => $body,
        ]);

        $data = [
			'root_id'			=> $rootId,
            'meta_id'           => $meta->id,
            'created_at'        => Carbon::now()->toDateTimeString(),
        ];

		// we need to create two records. one for recipient and one for message author.
		Pm::create($data + ['user_id' => $userId, 'author_id'=> $authorId, 'folder' => Pm::INBOX]);
		$pm = Pm::create($data + ['user_id' => $authorId, 'author_id' => $userId, 'folder' => Pm::OUTBOX]);

		return $pm;

	}
}
