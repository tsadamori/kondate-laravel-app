<div id="kondate-list" class="mb-5">
    {!! Form::model($kondate, ['route' => ['menus.list'], 'method' => 'post']) !!}
    <div class="d-sm-flex">
        <h1 class="h3 mr-3 mb-3">今週の献立一覧</h2>
        {!! Form::submit('買い物リストをつくる', ['id' => 'generate-kondate-btn', 'class' => 'btn btn-sm btn-pink mb-3']) !!}
    </div>
    <hr>
    <div class="mb-3">
        <ul id="added-list">
        </ul>
    </div>
    {!! Form::close() !!}
    <hr>
</div>