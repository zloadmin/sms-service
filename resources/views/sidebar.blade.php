<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">

        <li class={!! Request::path() == 'smslist/create' ? 'active' : ''; !!}>
            <a href="/smslist/create">Новая рассылка</a>
        </li>
        <li class={!! Request::path() == 'smslist/list' ? 'active' : ''; !!}>
            <a href="/smslist/list">Списки рассылки ({{ Auth::user()->smslist()->notdraft()->count() }})</a>
        </li>
        <li class={!! Request::path() == 'smslist/list_draft' ? 'active' : ''; !!}>
            <a href="/smslist/list_draft">Черновики рассылки ({{ Auth::user()->smslist()->draft()->count() }})</a>
        </li>
    </ul>
    <ul class="nav nav-sidebar">
        <li class={!! Request::path() == 'number_group/create' ? 'active' : ''; !!}>
            <a href="/number_group/create">Добавить список</a>
        </li>
        <li class={!! Request::path() == 'number_group/list' ? 'active' : ''; !!}>
            <a href="/number_group/list">Мои абоненты ({{ Auth::user()->numbersgroup()->count() }})</a>
        </li>
        <li class={!! Request::path() == 'number_group/system_list' ? 'active' : ''; !!}>
            <a href="/number_group/system_list">Абоненты сервиса ({{ App\NumbersGroup::syslist()->count() }})</a>
        </li>
    </ul>
</div>
