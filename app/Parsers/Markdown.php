<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Parsers;

use Hifone\Parsers\Parsedown\Parsedown;
use League\HTMLToMarkdown\HtmlConverter;
use Purifier;

class Markdown
{
    protected $htmlParser;
    protected $markdownParser;

    public function __construct()
    {
        $this->htmlParser = new HtmlConverter();
        $this->htmlParser->getConfig()->setOption('header_style', 'setext');

        $this->markdownParser = new Parsedown();
    }

    public function convertHtmlToMarkdown($html)
    {
        return $this->htmlParser->convert($html);
    }

    public function convertMarkdownToHtml($markdown)
    {
        $convertedHmtl = $this->markdownParser->text($markdown);

        return Purifier::clean($convertedHmtl, 'user_thread_body');
    }
}
