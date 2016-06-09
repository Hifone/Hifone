<footer class="footer">
    <div class="container">
        <div class="copyright">
            <blockquote class="pull-left">
                <p>{!! Config::get('setting.site_about') !!}</p>
                <p>{!! trans('hifone.powered_by') !!} {{ HIFONE_VERSION }} <span class="pipe">|</span>Inspired by ruby-china & phphub.</p>
            </blockquote>
        </div>
        <div class="pull-right hidden-sm hidden-xs">
            <p>
                <a href="/about">关于我们</a>
                <span class="pipe">|</span>
                <a href="/contact">联系我们</a>
                <span class="pipe">|</span>
                <a href="/faq">常见问题解答</a>
            </p>
            <p>
                <a href="http://hifone.com/" target="_blank"><img src="/images/hifone-logo.png" border="0" height="40" data-toggle="tooltip" data-placement="top" title="Powered by Hifone" /></a>
            </p>
        </div>
    </div>
</footer>