<div class="editor-toolbar">
  <div class="opts pull-right">
    <span class="dropdown dropdown-small" id="editor-toolbar-insert-code">
      <a href="#editor-toolbar-insert-code" data-toggle="dropdown" title="{{ trans('hifone.threads.insert_code') }}"><i class="fa fa-code"></i></a>
      <ul class="dropdown-menu  insert-codes" role="menu">
        <li><a data-lang="php" href="#">PHP</a></li>
        <li><a data-lang="html" href="#">HTML</a></li>
        <li><a data-lang="scss" href="#">CSS / SCSS</a></li>
        <li><a data-lang="js" href="#">JavaScript</a></li>
        <li><a data-lang="yml" href="#">YAML <i>(.yml)</i></a></li>
        <li><a data-lang="coffee" href="#">CoffeeScript</a></li>
        <li><a data-lang="conf" href="#">Nginx / Redis <i>(.conf)</i></a></li>
        <li><a data-lang="python" href="#">Python</a></li>
        <li><a data-lang="java" href="#">Java</a></li>
        <li><a data-lang="ruby" href="#">Ruby</a></li>
        <li><a data-lang="erlang" href="#">Erlang</a></li>
        <li><a data-lang="shell" href="#">Shell / Bash</a></li>
      </ul>
    </span>
    <a class="btn-upload" href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="{{ trans('hifone.threads.upload_image') }}"><i class="fa fa-image"></i> </a>
    <input type="file" name="file" class="input-file" style="display: none;" />
  </div>
  <ul class="nav nav-pills" style="clear:none;">
    <li class="edit active"><a href="#">{{ trans('forms.edit') }}</a></li>
    <li class="preview"><a href="#">{{ trans('forms.preview') }}</a></li>
  </ul>
</div>