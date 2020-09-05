var selected = []; 
var members = [];
var imgs = [];
var ids = [];
var src = "/search/professors/";
var selected_name = "professors";

$(document).ready(function(){
    $('#search_input').on('input', function () {
        var val = $(this).val().trim().toLowerCase();
        var list_ui = $('#results_list').empty();
        if (val != "")
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var empty = true;
                    members = JSON.parse(this.responseText).names;
                    ids = JSON.parse(this.responseText).ids;
                    imgs = JSON.parse(this.responseText).imgs;
                    for (x in members)
                    {
                        if (!selected.includes(ids[x]))
                        {
                            list_ui.append(
                                '<button type="button" id="professor_" class="free-list item-full row" onclick="addItem(' + x + ')">' +
                                    '<div class="d-flex p-3 align-items-center">' +
                                        '<div class="pr-3">' +
                                            '<img src="' + imgs[x] + '" class="img-fluid rounded-circle" width="48px"/>' +
                                        '</div>' +
                                        '<div class="flex-grow-1 d-flex flex-column">' +
                                            '<h6>' + members[x] + '</h6>' +
                                        '</div>' +
                                    '</div>' +
                                '</button>'
                            );
                            empty = false;
                        }
                    }
                    if (empty)
                        document.getElementById("empty_list").classList.remove("d-none");
                }
            };
            xhttp.open("GET", src + val, true);
            xhttp.send();
        }
        document.getElementById("empty_list").classList.add("d-none");
    });
    $('#send_members').on('click', function () {
        $.ajax({
            type: "POST",
            url: "/members",
            data:JSON.stringify(selected),
            success: function(html){
                alert( "Submitted");
            }
        });
        alert("Sent");
    });
});

function removeItem(id){
    document.getElementById("selected_list").removeChild(document.getElementById("selected_prof_" + id));
    selected = arrayRemove(selected, id);
}

function addItem(i){
    if (!selected.includes(ids[i]))
    {
        var btn = document.createElement("BUTTON");
        btn.id = "selected_prof_" + ids[i];
        btn.setAttribute("type", "button");
        btn.classList.add('free-list');
        btn.classList.add('border');
        btn.classList.add('rounded-pill');
        btn.classList.add('mr-3');
        var input = document.getElementById('search_input');
        btn.addEventListener("click", function() { removeItem(ids[i]); });
        btn.innerHTML = '<div class="d-flex p-1 align-items-center">' + 
                            '<input type="hidden" name="' + selected_name + '" value="' + ids[i] + '"/>' + 
                            '<div class="pr-3">' + 
                                '<img src="' + imgs[i] + '" class="img-fluid rounded-circle" width="28px"/>' + 
                            '</div>' + 
                            '<span class="small text-muted pr-2">' + members[i] + '</span>' + 
                        '</div>';
        document.getElementById("selected_list").insertBefore(btn, input);
        selected.push(ids[i]);
    }
    input.value = "";
    $('#results_list').empty();
}