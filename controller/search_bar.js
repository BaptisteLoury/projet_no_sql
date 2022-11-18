var availableTags = [];
var availableIds = [];

function majAvailablePseudos() {
    availableTags = [];
    availableIds = [];
    var matchs = $("#search-bar").val()
    let post = {
        match : ''
    } 
    post = JSON.stringify(post)
    url = "../controller/api/get_matching_pseudos.php"

    let xhr = new XMLHttpRequest()

    xhr.open('POST', url)
    xhr.responseType = 'text';

    xhr.onload = function() {
        var allPseudos = JSON.parse(xhr.response);
        for(var i =0; i < allPseudos.length; i++) {
            availableTags.push(allPseudos[i]['usr_pseudo'])
            availableIds.push(allPseudos[i]['usr_id'])
        }
        $( "#search-bar" ).autocomplete('option', 'source', availableTags);
    };

    xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
    xhr.send(post)
}

$( function() {
    $( "#search-bar" ).autocomplete({
      source: availableTags
    });
    $("#search-bar").keyup(majAvailablePseudos());
  } );

function goToUser() {
    var user = $( "#search-bar" ).val()
    var index = availableTags.indexOf(user);
    if(index != -1) {
        window.location.href = '../view/view_other.php?searched_usr='+availableIds[index];
    }
}