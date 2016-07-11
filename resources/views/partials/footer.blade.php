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
    </div>
</footer>