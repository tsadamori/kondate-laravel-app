<nav class="navbar navbar-expand-lg navbar-dark bg-orange fixed-top shadow">
    <a class="navbar-brand pl-3" href="/">献立アプリ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                {{ link_to_route('menus.create', '新規投稿', [], ['class' => 'nav-link']) }}    
            </li>
            <li class="nav-item">
                {{ link_to_route('kondate.history', '献立リスト', [], ['class' => 'nav-link']) }}
            </li>
            <li class="nav-item">
                {{ link_to_route('logout', 'ログアウト', [], ['class' => 'nav-link']) }}
            </li>
        </ul>
        <a href="{{ route('users.show') }}" class="d-none d-lg-block">{{ Session::get('user_name') }}</a>
    </div>
</nav>





