function favorite(discussion_id) {
    if (document.getElementById("fa_" + discussion_id + "_fav").classList.contains("active")) {
        document.getElementById("likes_" + discussion_id).innerHTML =
            Number(document.getElementById("likes_" + discussion_id).innerHTML) - 1;
    } else {
        document.getElementById("likes_" + discussion_id).innerHTML =
            Number(document.getElementById("likes_" + discussion_id).innerHTML) + 1;
    }
    document.getElementById("fa_" + discussion_id + "_fav").classList.toggle("active");
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/discussions/" + discussion_id + "/favorite", true);
    xhttp.send();
}

function bookmark(discussion_id) {
    if (document.getElementById("fa_" + discussion_id + "_book").classList.contains("active")) {
        document.getElementById("fa_" + discussion_id + "_book").classList.remove("fa");
        document.getElementById("fa_" + discussion_id + "_book").classList.add("far");
    } else {
        document.getElementById("fa_" + discussion_id + "_book").classList.remove("far");
        document.getElementById("fa_" + discussion_id + "_book").classList.add("fa");
    }
    document.getElementById("fa_" + discussion_id + "_book").classList.toggle("active");
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/discussions/" + discussion_id + "/bookmark", true);
    xhttp.send();
}

function deletePost() {
    var discussion_id = document.getElementById("d-post-id").value;
    document.getElementById('p_' + discussions_id).innerHTML = 
        '<div class="alert alert-danger alert-dismissible fade show shadow-sm mb-3" role="alert">' +
        'Une post a été supprimé!' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + 
            '<span aria-hidden="true">&times;</span>' + 
        '</button>' + 
        '</div>';
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", '/discussions/d/' + discussion_id, true);
    xhttp.send();
}

$(document).ready(function(){
    $('#delete_discussion').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('#d-post-id').val(id);
    });
});

// Show new post form and hide the new post button
function openPostForm(){
    document.getElementById("newPost").classList.add("d-none");
    document.getElementById("postForm").classList.remove("d-none");
}

// Hide new post form and show the new post button
function closePostForm(){
    document.getElementById("postForm").classList.add("d-none");
    document.getElementById("newPost").classList.remove("d-none");
}

// Full post page
function addComment(discussion_id, img, fullname) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("count").innerHTML = Number(document.getElementById("count").innerHTML) + 1;
            var comt = JSON.parse(this.responseText);
            var d = new Date(comt.date_publication);
            var dateString =
                ("0" + d.getUTCDate()).slice(-2) + "-" +
                ("0" + (d.getUTCMonth()+1)).slice(-2) + "-" +
                d.getUTCFullYear() + " " +
                ("0" + d.getUTCHours()).slice(-2) + ":" +
                ("0" + d.getUTCMinutes()).slice(-2);
            document.getElementById("comments").innerHTML += '<li id="c_' + comt.id + '"><div class="media mb-3">' +
                '<img src="' + img + '" class="mr-3 com-avatare rounded-circle" alt="avatar"/>' +
                '<div class="media-body d-flex justify-content-between"><div>' +
                    '<h6 class="text-muted mt-0 mb-3">' + fullname + '</h6>' +
                    '<p>' + comt.content + '</p>' +
                    '<small class="text-muted">' + dateString + '</small></div>' +
                    '<div class="d-flex mb-4 pr-5 align-items-center dropdown">' + 
                        '<span class="icon-mute-2" id="post_' + comt.id + '_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></span>' + 
                        '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="cmt_' + comt.id + '_options">' + 
                            '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#edit_comment" data-id="' + comt.id + '">Éditer</button>' + 
                            '<button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_comment" data-id="' + comt.id + '">Supprimer</a>' + 
                        '</div>' + 
                    '</div>' + 
                '</div>' +
                '</div></li>';
        }
    };
    xhttp.open("GET", "/comments/?discussion=" + discussion_id + "&content=" + document.getElementById("cmt_content").value, true);
    xhttp.send();
    document.getElementById("cmt_content").value = '';
}

function deleteComment() {
    document.getElementById("count").innerHTML = Number(document.getElementById("count").innerHTML) - 1;
    var id = document.getElementById("d-comment-id").value;
    document.getElementById('c_' + id).innerHTML = 
        '<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">' +
        'Un commentaire a été supprimé!' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + 
            '<span aria-hidden="true">&times;</span>' + 
        '</button>' + 
        '</div>';
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/comments/d/" + id, true);
    xhttp.send();
}
//This is my first edited comment
function editComment() {
    var id = document.getElementById("comment-id").value;
    document.getElementById("cmt_" + id + "_content").innerHTML =  document.getElementById("comment-text").value;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/comments/" + id + "/update?content=" + document.getElementById("comment-text").value, true);
    xhttp.send();
}

$(document).ready(function(){
    $('#edit_comment').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        //modal.find('#ctext').text($('#cmt_' + id + '_content').text());
        modal.find('#comment-id').val(id);
        modal.find('#comment-text').val($('#cmt_' + id + '_content').text());
    });
    $('#delete_comment').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('#d-comment-id').val(id);
    });
});