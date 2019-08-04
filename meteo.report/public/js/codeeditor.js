function errorSaving(msg) {
    $("#saveStatus").removeClass('alert-success');
    $("#saveStatus").addClass('alert-danger');
    if (!msg)
        msg = 'Unknown error..';
    $("#saveStatus").html(msg);
    $('#saveStatus').show();
    $('#saveStatus').fadeOut(3000);
}
function enableBeforeUnload() {
    $('#saveButton').css('visibility', 'visible');
    window.onbeforeunload = function (e) {
        return "Discard changes?";
    };
}

function disableBeforeUnload() {
    $('#saveButton').css('visibility', 'hidden');
    window.onbeforeunload = null;
}

var editorObj = CodeMirror.fromTextArea(document.getElementById("codeEditor"), {
    mode: "javascript",
    lineNumbers: true,
    styleActiveLine: true,
    matchBrackets: true,
    dragDrop: true,
    spellcheck: true,
    autoCloseBrackets: true,
    gutters: ["CodeMirror-lint-markers"],
    lint: true,
    extraKeys: {
        'Ctrl-S': function (instance) {
            $('#saveButton').click();
        },
        'Ctrl-/': "undo"
    }
});
editorObj.setSize('100%', document.documentElement.clientHeight - 420);
editorObj.on("change", function () {
   // $('#lineCount').text(editorObj.lineCount());
    enableBeforeUnload();
});

function loadCode() {
    $.ajax({
        url: 'https://meteo.report/admin/editor/code/get/',
        method: 'POST',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        contentType: 'application/json',
        success: function (response) {
            console.log(response);
            if (response.result)
            {
                editorObj.setValue(response.data);
                disableBeforeUnload();
//                $('#fileSize').text(response.fileSize);
//                $('#fileSizeCompressed').text(response.fileSizeCompressed);
//                $('#lastModifiedDate').text(response.lastModifiedDate);
//                $('#lastModifiedTime').text(response.lastModifiedTime);
            }
        }
    })
            .done(function () {

            })
            .fail(function (xhr, textStatus, errorThrown) {
                console.log(textStatus);
            })
            .always(function () {

            });
}

$().ready(function ()
{
//    $('#loader-1').hide();
//    $(document).ajaxStart(function () {
//        $('#loader-1').show();
//    });
//
//    $(document).ajaxComplete(function () {
//        $('#loader-1').hide();
//    });

    $('#saveStatus').hide();


    disableBeforeUnload();
    loadCode();


    saveButton.onclick = function(){
    $.ajax({
        url: 'https://meteo.report/admin/editor/code/set/',
        method: 'POST',
        data: {"codeValue": editorObj.getValue()},            
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log(response);
            
            if (response.result)
            {
                $('#modalContent').html('Saved succesfully');
                $('#modalWin').modal('show');
                editorObj.setValue(response.data);
                disableBeforeUnload();
//                $('#fileSize').text(response.fileSize);
//                $('#fileSizeCompressed').text(response.fileSizeCompressed);
//                $('#lastModifiedDate').text(response.lastModifiedDate);
//                $('#lastModifiedTime').text(response.lastModifiedTime);
            }
            else{
                $('#modalContent').html(response.data);
                $('#modalWin').modal('show');               
            }
        }
    })
            .done(function () {

            })
            .fail(function (xhr, textStatus, errorThrown) {
                $('#modalContent').html(textStatus);
                $('#modalWin').modal('show');                
                console.log(textStatus);
            })
            .always(function () {

            });        
    }
    
    
//    $('#saveButton').click(function () {
//        $.post('http://api.rixnews.com/source/jwt=' + jwt, {codeValue: editorObj.getValue()}, function (response) {
//            console.log(response.result);
//            if (response.result === true) {
//                $("#saveStatus").removeClass('alert-danger');
//                $("#saveStatus").addClass('alert-success');
//                $('#saveStatus').text('Saved successfully');
//                $('#saveStatus').show();
//                loadCode();
//                $('#saveStatus').fadeOut(3000);
//                disableBeforeUnload();
//            } else {
//                console.log(response.message);
//                errorSaving(response.message);
//            }
//
//        })
//                .fail(function () {
//                    errorSaving();
//                })
//    });

});