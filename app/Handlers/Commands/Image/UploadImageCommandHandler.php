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
        // Create Randomstring for Filename
        $random_string = str_random(10);
        //Path to Thread Size
        $safeName = $random_string.'.'.$extension;
        //Path to Original Size
        $safeNameOrig = $random_string.'_orig.'.$extension;
        //Path to LightBox Size
        $safeNameLightbox = $random_string.'_lightbox.'.$extension;
        // Copy the File for Preserving the Original Image
        copy($file, $destinationPath.'/'.$safeNameOrig);
        copy($file, $destinationPath.'/'.$safeNameLightbox);
        $file->move($destinationPath, $safeName);

        // If is not gif file, we will try to reduse the file size
        // This is for the Lightbox Version.
        if ($file->getClientOriginalExtension() != 'gif') {
            // open an image file
            $imgLb = Image::make($destinationPath.'/'.$safeNameLightbox);
            // prevent possible upsizing
            $imgLb->resize(1440, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            // finally we save the image as a new file
            $imgLb->save();
        }

        // If is not gif file, we will try to reduse the file size
        // This is for the Thread Version
        if ($file->getClientOriginalExtension() != 'gif') {
            // open an image file
            $img = Image::make($destinationPath.'/'.$safeName);
            // prevent possible upsizing
            $img->resize(783, null, function ($constraint) {
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
