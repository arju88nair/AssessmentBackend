$(function () {
    //BEGIN MENU SIDEBAR


    $('#editFeed').on('show.bs.modal', function (event) {
		
            var button = $(event.relatedTarget);
            // Button that triggered the modal
            var title = button.data('title');
            var image = button.data('image');
            var image_lw = button.data('image_lw');
            var source = button.data('source');
            var content = button.data('content');
            var sourceTag = button.data('sourcetag');
            var idTag = button.data('idtag');
            var audio = button.data('audio');
            var cat = button.data('cat');
            var trend = button.data('trend');
            var type = button.data('type');
            var loc = button.data('loc');
            var schedule = button.data('schedule');
            var date = button.data('date');
            var summ = button.data('summ');
            var added = button.data('added');
            var remark = button.data('remark');
            var uId = button.data('uid');
            // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('#feedTitle').val(title);
            modal.find('#feedImages').val(image);
            modal.find('#feedImage_lw').val(image_lw);
            modal.find('#sourceUrl').val(source);
            modal.find('#feedContent').val(content);
            modal.find('#sourceTitle').val(sourceTag);
            modal.find('#idTag').val(idTag);
            modal.find('#category').val(cat);
            modal.find('#type').val(type);
            modal.find('#trend').val(trend);
            modal.find('#loc').val(loc);
            modal.find('#feedAudioTag').val(audio);
            modal.find('#feedDate').val(date);
            modal.find('#feedSchedule').val(schedule);
            modal.find('#summarised').val(summ);
            modal.find('#added').val(added);
            modal.find('#feedRemarks').val(remark);
            modal.find('#feedId').text("Unique Id is " + uId);
            var user = localStorage.getItem('user');
            modal.find('#owner').val(user);

        }
    )


    $('#firstPreview').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget);
            // Button that triggered the modal
            var title = button.data('title');
            var image = button.data('image');
            var image_lw = button.data('image_lw');
            var source = button.data('source');
            var content = button.data('content');
            var sourceTag = button.data('sourcetag');
            var idTag = button.data('idtag');
            var audio = button.data('audio');
            var cat = button.data('cat');
            var trend = button.data('trend');
            var type = button.data('type');
            var loc = button.data('loc');
            var schedule = button.data('schedule');
            var date = button.data('date');
            var status = button.data('status');
            var remark = button.data('remark');
            var added = button.data('added');
            var rating = button.data('rating');
            localStorage.setItem('remark', remark);
            localStorage.setItem('id', idTag);
            localStorage.setItem('star', rating);
            $('source#sourcetag').attr('src', audio).detach().appendTo($("#myAudio"));
            if (audio == "" || audio == null) {
                $('img#play').hide();

            }
            else {
                $('img#play').show();

            }

            // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);

            var user = localStorage.getItem('user');

            if (status == "Approved") {

                $('button#acceptRate').hide();
            }
            else {
                $('button#acceptRate').show();
            }
            if (status == "Published" || status == "Approved" || status == "Major Pending Edits" || status == "Minor Pending Edits") {

                $('button#acceptRate').hide();
            }
            else {
                if (user == "ssharma@clearlyblue.in") {
                    $('button#acceptRate').hide();
                }
                else {
                    $('button#acceptRate').show();
                }

            }


            modal.find('#feedTitle').text(title);
            modal.find('#accept').data('remark', remark);
            modal.find('#feedImage').attr('src', image);
            modal.find('#feedContent').text(content);
            modal.find('#source').text(sourceTag + " >");
            modal.find('#category').text(cat);
            modal.find('#added').text("Shot by  " + added + "  1 day ago");

        }
    )


    $('#editPreview').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            // Button that triggered the modal
            var title = $('#feedTitle').val();
            var image = $('#feedImages').val();
            var content = $('#feedContent').val();
            var added = $('#summarised').val();
            var sourceTag = $('#sourceTitle').val();
            var audio = $('#feedAudioTag').val();
            console.log(audio)
            $('source#sourcetag').attr('src', audio).detach().appendTo($("#myAudio"));
            if (audio == "" || audio == null) {
                $('img#play').hide();

            }
            else {
                $('img#play').show();

            }
            var val = localStorage.getItem('val');

            var cata = $('#category option:selected').text()
            var modal = $(this);
            if (image == "" || image == null) {
                modal.find('#feedImage').attr('src', val);

            }
            else {
                modal.find('#feedImage').attr('src', image);

            }
            modal.find('#feedTitle').text(title);
            modal.find('#feedContent').text(content);
            modal.find('#source').text(sourceTag + " >");
            modal.find('#category').text(cata);
            modal.find('#added').text("Shot by  " + added + "  1 day ago");
        }
    );


    $('#savePreview').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            // Button that triggered the modal
            var title = $('#feedTitles').val();
            var image = $('#feedImaged').val();
            var content = $('#contents').val();
            var added = $('#addedtext').val();
            var sourceTag = $('#title').val();
            var val = localStorage.getItem('val');
            var audio = $('#feedAudio').val();
            $('source#sourcetag').attr('src', audio).detach().appendTo($("#myAudio"));
            if (audio == "" || audio == null) {
                $('img#play').hide();

            }
            else {
                $('img#play').show();

            }
            var cata = $('#categories option:selected').text()

            var modal = $(this);
            modal.find('#feedTitle').text(title);
            modal.find('#feedImage').attr('src', val);
            modal.find('#feedContent').text(content);
            modal.find('#source').text(sourceTag + " >");
            modal.find('#category').text(cata);
            modal.find('#added').text("Shot by  " + added + "  1 day ago");
        }
    );


    $('#acceptModal').on('show.bs.modal', function (event) {
//                var button = $(event.relatedTarget);
//                // Button that triggered the modal
//                 var remark = button.data('remark');
//                // Extract info from data-* attributes
//                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
//                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
//                var modal = $(this);
//                modal.find('#head').text(remark);
            var remark = localStorage.getItem('remark');
            var id = localStorage.getItem('id');
            var type = localStorage.getItem('clicked');
            var rating = localStorage.getItem('star');
            var user = localStorage.getItem('user');
            $('#clickedType').val(type);
            $('#tag').val($('#cat').val());
            $('#tag2').val($('#own').val());
            $('#tag3').val($('#statusTag').val());
            $('#feed').val(feed);
            $('#acceptId').val(id);
            $('#acceptUser').val(user);
            $('#rating-input').val(rating);
            $('#remarkArea').val(remark);

            $(document).ready(function () {
                $('#rating-input').rating({
                    min: 0,
                    max: 5,
                    step: 1,
                    size: 'lg',
                    showClear: true
                });


                $('#rating-input').on('rating.change', function () {
                });


            });


        }
    )

});
function confSubmit2() {
    var li = confirm('Are you sure you want to delete??');
    return r;
}
function confSubmit() {
    var input = document.getElementById("audioSave");
    var image = document.getElementById("image");
    var textArea = document.getElementById("contents").value;
    if (textArea.length < 1) {
        alert("The content should not be empty");
        return false;
    }
    if (image.files && image.files.length == 1) {

        if (image.files[0].size > 1048576) {
            alert("The file must be less than 1 MB");
            return false;
        }
    }
    // check for browser support (may need to be modified)
    if (input.files && input.files.length == 1) {

        if (input.files[0].size > 2097152) {
            alert("The file must be less than 2 MB");
            return false;
        }
    }
    if (document.getElementById("image").files.length == 0) {
        alert("Please add an image file ");
        return false;


    }
    else {
        var r = confirm('Are you sure you want to save??');
        return r;
    }


}
function editSubmit() {

    var input = document.getElementById("audioTag");
    var imageedit = document.getElementById("imaged");
    var textArea = document.getElementById("feedContent").value;
    if (textArea.length < 1) {
        alert("The content should not be empty");
        return false;
    }
    // check for browser support (may need to be modified)
    if (input.files && input.files.length == 1) {

        if (input.files[0].size > 2097152) {
            alert("The file must be less than 2 MB");
            return false;
        }
    }
    if (imageedit.files && imageedit.files.length == 1) {

        if (imageedit.files[0].size > 1048576) {
            alert("The file must be less than 1 MB");
            return false;
        }
    }
    if (document.getElementById("imaged").files.length == 0) {
        if ($("#feedImages").val().length == 0) {
            alert("Please add an image file");
            return false;
        }
        else {
            var r = confirm('Are you sure you want to save??');
            return r;
        }

    }
    else {

        var r = confirm('Are you sure you want to save??');
        return r;
    }


}



