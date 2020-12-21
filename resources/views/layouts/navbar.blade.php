<nav class="navbar navbar-expand-sm navbar-light bg-orange fixed-top shadow">
    <a class="navbar-brand pl-3" href="/">献立アプリ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                {{ link_to_route('menus.create', '新規投稿', [], ['class' => 'nav-link']) }}    
            </li>
            <li class="nav-item">
                {{ link_to_route('kondate.history', '献立リスト', [], ['class' => 'nav-link']) }}
            </li>
            <li class="nav-item">
                {{ link_to_route('users.show', 'マイページ', [], ['class' => 'nav-link']) }}
            </li>
            <li class="nav-item">
                {{ link_to_route('logout', 'ログアウト', [], ['class' => 'nav-link']) }}
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    マイページ
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->
        </ul>
    </div>
</nav>