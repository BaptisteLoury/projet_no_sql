function change_state_like(usr_id,pst_id,that) {
    if(!$(that).hasClass("active")) {
        url = "../controller/api/add_like.php"
        $(that).addClass("active")
    }
    else {
        url = "../controller/api/del_like.php"
        $(that).removeClass("active")
    }
    change_state_global(usr_id,pst_id,url)
}

function change_state_discovered(usr_id,pst_id,that) {
    if(!$(that).hasClass("active")) {
        url = "../controller/api/add_discovered.php"
        $(that).addClass("active")
    }
    else {
        url = "../controller/api/del_discovered.php"
        $(that).removeClass("active")
    }
    change_state_global(usr_id,pst_id,url)
}

function change_state_flaged(usr_id,pst_id,that) {
    if(!$(that).hasClass("active")) {
        url = "../controller/api/add_flag.php"
        $(that).addClass("active")
    }
    else {
        url = "../controller/api/del_flaged.php"
        $(that).removeClass("active")
    }
    change_state_global(usr_id,pst_id,url)
}

function change_state_global(usr_id,pst_id,url) {
    let post = {
        usr : usr_id,
        pst : pst_id
    }
    post = JSON.stringify(post)


    let xhr = new XMLHttpRequest()

    xhr.open('POST', url)
    xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
    xhr.send(post)
}

function add_comment(usr_id,pst_id,usr) {
    comment = $("#text-comment-"+pst_id).val()
    if(comment == "") {
        return;
    }
    $("#text-comment-"+pst_id).val('')
    let post = {
        usr : usr_id,
        pst : pst_id,
        cmt : comment
    }
    post = JSON.stringify(post)
    url = "../controller/api/add_comment.php"

    let xhr = new XMLHttpRequest()

    xhr.open('POST', url)
    xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
    xhr.send(post)

    $("#cmt-box-"+pst_id).prepend(
        '<div class=\"post-comments-list-elem\"> <span class=\"post-comments-list-elem-usr\">'+usr+'</span> : '+comment+'</div>'
    )
}

function follow(usr,other,that) {
    if(!$(that).hasClass("active")) {
        url = "../controller/api/follow.php"
        $(that).addClass("active")
    }
    else {
        url = "../controller/api/unfollow.php"
        $(that).removeClass("active")
    }
    let post = {
        usr : usr,
        other : other
    }
    post = JSON.stringify(post)

    let xhr = new XMLHttpRequest()

    xhr.open('POST', url)
    xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
    xhr.send(post)
}