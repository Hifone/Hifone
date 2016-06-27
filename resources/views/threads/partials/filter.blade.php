<ul class="pull-right list-inline remove-margin-bottom thread-filter">
    <li>
        <a {!! thread_filter('recent') !!}>
            <i class="fa fa-history"></i> {{ trans('hifone.threads.recent') }}
        </a>
    </li>
    <li>
        <a {!! thread_filter('excellent') !!}>
            <i class="fa fa-diamond"> </i> {{ trans('hifone.threads.excellent') }}
        </a>
    </li>
    <li>
        <a {!! thread_filter('like') !!}>
            <i class="fa fa-thumbs-o-up"> </i> {{ trans('hifone.threads.like') }}
        </a>
    </li>
    <li>
        <a {!! thread_filter('unanswered') !!}>
            <i class="fa fa-eye"></i> {{ trans('hifone.threads.unanswered') }}
        </a>
    </li>
</ul>
