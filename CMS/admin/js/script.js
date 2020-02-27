//Auto fill modal box by article title and id
var defaults = $('a.delArtUrl').attr("href");
$('.delete-art').click(function() {
    var idArticle = $(this).attr("id");
    var objArt = $(".artId_" + idArticle + " td");
    var nameArt = objArt["1"].innerHTML;
    $('p.idArticle').text("");

    $('p.idArticle').append(nameArt + "<br><br>O numerze: " + idArticle);

    //Pobieranie adresu
    var a_href = $('a.delArtUrl').attr("href");
    a_href = a_href + idArticle;
    $('a.delArtUrl').prop("href", a_href);
});

$('#modal-id').on('hidden.bs.modal', function(e) {
    $('a.delArtUrl').attr("href", defaults);
})

//Auto show modal on load page
$(window).on('load', function() {
    $('#infoModal').modal('show');
});