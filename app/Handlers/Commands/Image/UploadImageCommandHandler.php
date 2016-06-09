<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Image;

use Auth;
use Hifone\Commands\Image\UploadImageCommand;
use Hifone\Events\Image\ImageWasUploadedEvent;
use Intervention\Image\ImageManagerStatic as Image;

class UploadImageCommandHandler
{
    public function handle(UploadImageCommand $command)
    {
        $file = $command->file;

        $allowed_extensions = ['png', 'jpg', 'gif'];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }

        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension() ?: 'png';
        $folderName = '/uploads/images/'.date('Ym', time()).'/'.date('d', time()).'/'.Auth::user()->id;
        $destinationPath = public_path().'/'.$folderName;
        $safeName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $safeName);

        // If is not gif file, we will try to reduse the file size
        if ($file->getClientOriginalExtension() != 'gif') {
            // open an image file
            $img = Image::make($destinationPath.'/'.$safeName);
            // prevent possible upsizing
            $img->resize(1440, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            // finally we save the image as a new file
            $img->save();
        }

        $data['filename'] = upload_url().$folderName.'/'.$safeName;


        event(new ImageWasUploadedEvent($data));

        return $data;
    }
}
