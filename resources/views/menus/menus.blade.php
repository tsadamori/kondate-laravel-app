<div>
    <h1 class="h3 mb-3">My献立</h1>
    <div id="search-form mr-0">
        {!! Form::open(['class' => 'd-sm-flex justify-content-end']) !!}
            <div class="form-group mr-sm-2">
                {!! Form::search('keyword', '', [
                    'id' => 'keyword',
                    'class' => 'form-control',
                    'placeholder' => '検索'
                ]) !!}
            </div>
            <div class="form-group mr-sm-2">
                {!! Form::select('category1_id', [
                    '' => 'カテゴリ1',
                    '1' => '肉',
                    '2' => '卵',
                    '3' => '豆',
                    '4' => '魚',
                    '5' => 'その他',
                ], [], [
                    'id' => 'category1_id',
                    'class' => 'form-control'
                ]) !!}
            </div>
            <div class="form-group mr-sm-2">
                {!! Form::select('category2_id', [
                    '' => 'カテゴリ2',
                    '1' => '緑',
                    '2' => '豆',
                    '3' => '海藻',
                    '4' => 'きのこ',
                ], [], [
                    'id' => 'category2_id',
                    'class' => 'form-control'
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::button('検索', [
                    'id' => 'search-btn',
                    'class' => 'btn btn-pink py-0 form-control'
                ]) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <hr>
    <div id="menus-list" class="mt-3">
@if(count($menus) > 0)
        <ul class="list-unstyled mb-3">
@foreach($menus as $menu)
            <li class="mb-3">
                <div class="mb-3 text-left">
                    <h2 class="h5 head">
                        <a href="{{ route('menus.show', $menu->id) }}">
                            {{ $menu->name }}
                        </a>
                    </h2>
                    <br>
                    <span class="small">カテゴリ1: {{ $menu->category1_mod }}　カテゴリ2: {{ $menu->category2_mod }}</span>
                </div>
                <div>
                    <p>{{ $menu->content }}</p>
                </div>     
                <div class="row">
                    <div class="col-12 col-sm-4 mb-3 text-center text-sm-left">
                        <div>
                            @if ($menu->img_name)
                                <a href="img/upload/{{ $menu->img_name }}">
                                    <img class="mt-1 thumbnail-img" src="img/upload/{{ $menu->img_name }}" width="200" height="200" alt="{{ $menu->img_name }}">
                                </a>
                            @else
                                <a href="img/no-image.png">
                                    <img class="mt-1 thumbnail-img" src="img/no-image.png" width="200" height="200">
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="menu-btn col-12 col-sm-8 text-right">
                        {!! Form::model($menu, [
                            'route' => [
                                'menus.destroy', $menu->id
                            ], 
                            'method' => 'delete',
                            'id' => 'menu-form',
                            'class' => 'form-group',
                        ]) !!}
                            {!! Form::button('献立に入れる', [
                                'class' => 'add-menu-btn btn btn-sm btn-pink form-control mb-2',
                                'data-id' => $menu->id,
                                'data-name' => $menu->name
                            ]) !!}
                            {!! link_to_route('menus.edit', '編集', [$menu->id], [
                                'class' => 'btn btn-sm btn-pink2 form-control mb-2'
                            ]) !!}
                            {!! Form::button('削除', [
                                'class' => 'btn btn-sm btn-danger form-control menu-delete-btn'
                            ]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </li>
            <hr>
@endforeach
        </ul>
        {{ $menus->links('pagination::bootstrap-4') }}
@else
        <p>まだ献立はありません...</p>
@endif
    </div>
</div>