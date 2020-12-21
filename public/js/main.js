// $(function() {
//     var pos = 0;
//     $(window).on('scroll' ,function() {
    
//         if($(this).scrollTop() < pos) {
//             $('nav').slideDown();
//         } else {
//             $('nav').slideUp();
//         }
//         pos = $(this).scrollTop();
//     });
// })

$(document).on('click', '.menu-btn .add-menu-btn', function() {
    $('#kondate-list').show();
    kondateList = $('#kondate-list ul');

    $('#added-list p:first').remove();
    id = $(this).data('id');
    name = $(this).data('name');
    kondateList.append(
        `<li class="mb-1 d-flex justify-content-between" data-id=` + id + `>
            <div>`
             + name + 
            `</div>
            <div>
                <button type="button" class="btn btn-sm btn-danger ml-3 kondate-remove">
                    献立から外す
                </button>
            </div>
            <input type="hidden" class="mr-0" name="kondate-id[]" value="` + id + `">
        </li>`
    );
    data = {id: id};

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'menus/add_kondate',
        data: data,
        dataType: 'json',
    }).done(function(res) {
        console.log('done');
    }).fail(function(res) {
        console.log('fail');
    });
    window.sessionStorage.setItem('menuId', id);
    console.log(window.sessionStorage.getItem('menuId'));
});

$(document).on('click', '.kondate-remove', function() {
    $(this).parent().parent().remove();
    if ($('#added-list').children('li').length == 0) {
        $('#added-list').append('<p>献立を追加して下さい！</p>');
    }
});

$(document).on('click', '#search-btn', function() {
    console.log($('#keyword').val());
    var data = {
        keyword: $('#keyword').val(),
        category1_id: $('#category1_id').val(),
        category2_id: $('#category2_id').val(),
    };
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'menus/search',
        data: data,
        dataType: 'json',
    }).done(function(res) {
        var target = $('#menus-list ul');
        while(target[0].firstChild) {
            target[0].removeChild(target[0].firstChild);
        }
        if(res.length !== 0) {
            $.each(res, function(index, value){
                if (value.img_name == null) {
                    img_name = 'no-image.png'
                } else {
                    img_name = value.img_name;
                }
                html =
                    `<li class="mb-3">
                        <div class="mb-3 text-left">
                            <a href="menus/` + value.id + `">
                                <h2 class="h5 head">` + value.name + `</h2>
                            </a>
                            <br>
                            <span class="small">カテゴリ1: ` + value.category1_mod + `　カテゴリ2: ` + value.category2_mod + `</span>
                        </div>
                        <div>
                            <p>` + value.content + `</p>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-4 mb-3 text-center text-sm-right">
                                <div class="mt-1">
                                    <a href="img/` + img_name + `">
                                        <img src="img/` + img_name + `" width="200" height="200">
                                    </a>
                                </div>
                            </div>
                            <div class="menu-btn col-12 col-sm-8 text-right">
                                <form method="POST" action="menus` + value.id + `" accept-charset="UTF-8" class="form-group">
                                    <input class="form-control" name="_method" type="hidden" value="DELETE">
                                    <button class="add-menu-btn btn btn-sm btn-pink form-control mb-2" type="button" data-id="` + value.id + `" data-name="` + value.name + `">献立に入れる</button>
                                    <a href="menus/` + value.id + `/edit" class="btn btn-sm btn-pink2 form-control mb-2">編集</a>
                                    <input class="btn btn-sm btn-danger form-control" type="submit" value="削除">
                                </form>
                            </div>
                        </div>
                    </li>
                    <hr>`;
                target.append(html);
            });
        } else {
            html = '<p>条件に一致する献立はありません。</p>';
            target.append(html);
        }
        $('ul.pagination').hide();
    }).fail(function(res) {
        console.log('fail');
    });
});

$(document).on('click', '#create-form .add-btn, #edit-form .add-btn', function() {
    $('#ingredient-form')
        .append(
            `<div class="form-inline mb-2">
            <input type="text" name="ingredients[]" class="ml-1 form-control">
            <input type="text" name="ingredients_count[]" class="ml-1 form-control">
            <input type="button" value="＋", class="ml-3 add-btn btn btn-sm">
            <input type="button" value="ー", class="minus-btn btn btn-sm">
            </div>`
        );
});

$(document).on('click', '.minus-btn', function() {
    $(this).parent().remove();
});

function onChangeFileInput(fileInput) {
    var file = fileInput.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function() {
            $('#thumbnail').show();
            $('#thumbnail-img').attr('src', reader.result);
        };
        reader.onerror = function() {
            console.log('画像アップロードエラー');
        }
        reader.readAsDataURL(file);
    }
}

$(document).on('click', '#btn-area #edit-btn', function() {
    $('#kondate_list li').each(function(index) {
        $(this).append('<input type="text" value="' +
            $(this).children('label').children('span').text() +
        '">');
        $(this).children('label').children('span').remove();
    });
    $('#btn-area #edit-btn').hide();
    $('#btn-area #complete-btn').show();
});
$(document).on('click', '#btn-area #complete-btn', function() {
    $('li').each(function(index) {
        $(this).children('label').append('<span>' +
            $(this).children('input').val() +
        '</span>');
        $(this).children('input').remove();
    });
    $('#btn-area #edit-btn').show();
    $('#btn-area #complete-btn').hide();
});

$(document).on('click', '.kondate_delete_btn', function() {
    var id = $(this).data('id');
    $(this).parent().parent('li').remove();
    if ($('#kondate-history-list').children().length == 0) {
        $('#kondate-history').append('<p>献立リストはまだありません</p>')
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'delete',
        data: {
            'id': id,
        },
        dataType: 'json',
    }).done(function(res) {
        console.log('done');
    }).fail(function(res) {
        console.log('fail');
    });
});

// bootstrapのハンバーガーメニュー不具合対応(ハンバーガーメニューが閉じない)
$('.navbar-toggler').on('click', function(){
    $('#navbarSupportedContent').toggle();
});

// 献立削除
$('#menus-list .menu-delete-btn').on('click', function() {
    if (confirm('削除してもよろしいですか？') == true) {
        $('#menu-form').submit();
    }
});

// アカウント削除
$('#user-delete-btn').on('click', function() {
    if (confirm('削除してもよろしいですか？') == true) {
        $('#user-form').submit();
    }
});